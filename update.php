<?php

require("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "UPDATE books SET book_name = :book_name, author_name = :author_name WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ":book_name" => $_POST['book_name'],
            ":author_name" => $_POST['author_name'],
            ":id" => $_POST['id'],
        ]);
        header("Location: update.php");
        exit();
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

$showData = $db->query("SELECT * FROM books");
$fetchData = $showData->fetchAll(PDO::FETCH_ASSOC);

$book = null;
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute([":id" => $_GET['id']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
    <h1 class="page-title">Update a Book</h1>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($fetchData)): ?>
                    <?php foreach ($fetchData as $row): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['book_name']); ?></td>
                            <td><?= htmlspecialchars($row['author_name']); ?></td>
                            <td>
                                <a href="update.php?id=<?= $row['id']; ?>">
                                    <button class="btn btn-primary btn-small" type="button">Edit</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty-message">No books were found in the database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($error)): ?>
        <p class="error-message"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($book): ?>
        <div class="card">
            <form method="POST" action="update.php">
                <input type="hidden" name="id" value="<?= $book['id']; ?>">
                <div class="field">
                    <label for="book_name">Book Name</label>
                    <input type="text" id="book_name" name="book_name" value="<?= htmlspecialchars($book['book_name']); ?>" required>
                </div>
                <div class="field">
                    <label for="author_name">Author Name</label>
                    <input type="text" id="author_name" name="author_name" value="<?= htmlspecialchars($book['author_name']); ?>" required>
                </div>
                <div class="actions">
                    <button class="btn btn-primary" type="submit">Update Book</button>
                    <a href="update.php"><button class="btn" type="button">Cancel</button></a>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <div class="actions">
        <a href="index.php"><button class="btn" type="button">Back to Home</button></a>
    </div>
</main>

</body>
</html>
