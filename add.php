<?php

require("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $sql = "INSERT INTO books (book_name, author_name) VALUES (:book_name, :author_name)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':book_name' => $_POST["book_name"],
            ':author_name' => $_POST["author_name"],
        ]);
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        $error = 'Error adding book: ' . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container narrow">
    <h1 class="page-title">Add a New Book</h1>

    <?php if (isset($error)): ?>
        <p class="error-message"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <div class="card">
        <form method="POST" action="add.php">
            <div class="field">
                <label for="book_name">Book Name</label>
                <input type="text" id="book_name" name="book_name" required>
            </div>
            <div class="field">
                <label for="author_name">Author Name</label>
                <input type="text" id="author_name" name="author_name" required>
            </div>
            <div class="actions">
                <button class="btn btn-success" type="submit">Add Book</button>
                <a href="index.php"><button class="btn" type="button">Back</button></a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
