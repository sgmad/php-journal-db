<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journal App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>My Journal</h2>
            <a href="create.php" class="btn btn-primary">Add New Entry</a>
        </div>

        <table class="table table-bordered table-striped bg-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM journal ORDER BY entry_date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . htmlspecialchars($row["title"]) . "</td>
                            <td>" . htmlspecialchars(substr($row["content"], 0, 50)) . "...</td>
                            <td>" . $row["entry_date"] . "</td>
                            <td>
                                <a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No entries found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>