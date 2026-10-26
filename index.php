<?php

require("db_connect.php");

$showData = $db->query("SELECT * FROM books");
$fetchData = $showData->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library — Book List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav id="navbar">
    <div id="nav-img"><img src="download.jfif" alt="logo"></div>
    <div class="nav-brand">My Library</div>
    <div class="nav-text">Home</div>
    <div class="nav-text">Contact Us</div>
    <div class="nav-text">About Us</div>
</nav>

<main class="container">
    <h1 class="page-title">Book List</h1>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author Name</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($fetchData)): ?>
                    <?php foreach ($fetchData as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($row['book_name']); ?></td>
                            <td><?= htmlspecialchars($row['author_name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="empty-message">No books were found in the database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="actions">
        <a href="add.php"><button class="btn btn-success" type="button">Add Book</button></a>
        <a href="update.php"><button class="btn btn-primary" type="button">Update</button></a>
        <a href="delete.php"><button class="btn btn-danger" type="button">Delete</button></a>
    </div>
</main>

</body>
</html>
