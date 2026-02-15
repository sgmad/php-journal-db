<?php
include 'connection.php';

$id = $_GET['id'];
$sql = "SELECT * FROM journal WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE journal SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Edit Journal Entry</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control" rows="5" required><?php echo $row['content']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Update Entry</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>