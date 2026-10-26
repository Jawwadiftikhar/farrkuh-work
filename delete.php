<?php

require("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    try {
        $delQuery = $db->prepare("DELETE FROM books WHERE id = :id");
        $delQuery->execute([":id" => $_POST["id"]]);
    } catch (PDOException $e) {
        // Redirect below; the delete simply won't happen.
    }
    header("Location: delete.php");
    exit();
}

$showData = $db->query("SELECT * FROM books");
$fetchData = $showData->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="container">
    <h1 class="page-title">Delete a Book</h1>

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
                                <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button class="btn btn-danger btn-small" type="submit">Delete</button>
                                </form>
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

    <div class="actions">
        <a href="index.php"><button class="btn" type="button">Back to Home</button></a>
    </div>
</main>

</body>
</html>
