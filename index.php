<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journal</title>
    <style>
        body {
            background-color: #1a1616;
            font-family: 'Georgia', serif;
            color: #d1c7bd;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 900px;
            background-color: #2b1d1d;
            border: 2px solid #4a2c2c;
            padding: 40px;
            box-shadow: 0 0 20px #0f0b0b;
        }
        h2 {
            margin-top: 0;
            color: #8c4b4b;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 1px solid #4a2c2c;
            padding-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 0.95rem;
        }
        th {
            text-align: left;
            padding: 15px;
            background-color: #3d2626;
            color: #a69b8f;
            border: 1px solid #523636;
            font-weight: normal;
        }
        td {
            padding: 15px;
            border: 1px solid #3d2626;
            background-color: #261a1a;
            color: #bfb3a4;
        }
        tr:hover td {
            background-color: #2e1f1f;
        }
        a.btn {
            text-decoration: none;
            padding: 8px 16px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background 0.2s;
            display: inline-block;
        }
        .btn-primary {
            background-color: #5e2f2f;
            color: #dcdcdc;
            border: 1px solid #753b3b;
        }
        .btn-primary:hover {
            background-color: #753b3b;
        }
        .btn-edit {
            background-color: #705536;
            color: #fff;
            margin-right: 5px;
        }
        .btn-edit:hover {
            background-color: #8a6a45;
        }
        .btn-delete {
            background-color: #5e2f2f;
            color: #fff;
        }
        .btn-delete:hover {
            background-color: #7d3e3e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>
            Journal Entries
            <a href="create.php" class="btn btn-primary">New Entry</a>
        </h2>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
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
                            <td>" . htmlspecialchars($row["title"]) . "</td>
                            <td>" . date('M d, Y', strtotime($row["entry_date"])) . "</td>
                            <td>
                                <a href='edit.php?id=" . $row["id"] . "' class='btn btn-edit'>Edit</a>
                                <a href='delete.php?id=" . $row["id"] . "' class='btn btn-delete' onclick='return confirm(\"Permanently delete this entry?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align:center; padding: 30px;'>No entries found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
