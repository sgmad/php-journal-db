<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO journal (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Entry</title>
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
            max-width: 700px;
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
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #a69b8f;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        input[type="text"], textarea {
            width: 100%;
            background-color: #1f1616;
            border: 1px solid #4a2c2c;
            color: #d1c7bd;
            padding: 15px;
            font-family: 'Georgia', serif;
            font-size: 1rem;
            box-sizing: border-box;
            margin-bottom: 25px;
            outline: none;
        }
        input[type="text"]:focus, textarea:focus {
            border-color: #8c4b4b;
            background-color: #261a1a;
        }
        button {
            background-color: #5e2f2f;
            color: #dcdcdc;
            border: 1px solid #753b3b;
            padding: 12px 24px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            font-family: 'Georgia', serif;
        }
        button:hover {
            background-color: #753b3b;
        }
        a.cancel {
            color: #8c7373;
            text-decoration: none;
            margin-left: 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        a.cancel:hover {
            color: #a69b8f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Write Entry</h2>
        <form method="POST" action="">
            <label>Subject</label>
            <input type="text" name="title" required autocomplete="off">
            
            <label>Entry</label>
            <textarea name="content" rows="12" required></textarea>
            
            <button type="submit">Save Record</button>
            <a href="index.php" class="cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
