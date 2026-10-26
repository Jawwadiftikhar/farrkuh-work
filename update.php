<?php 

require("db_connect.php");

?>


<?php 

$showData = $db->query("SELECT * FROM books");
$fetchData = $showData->fetchAll(PDO::FETCH_ASSOC);

?>


<div>
    <table>
        <thead>
            <tr>
                <th >ID</th>
                <th >Book Name</th>
                <th >Author Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($fetchData)): ?>
                <?php foreach($fetchData as $index => $row): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($row['book_name'])?></td>
                <td><?= htmlspecialchars($row['author_name'])?></td>
                <td>
    <a href="update.php?id=<?=$row['id'];?>">
        <button type="button">Edit</button>
    </a>
</td>
            </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No Books were found in the Database.</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>

<div>
    <a href="index.php">
    <button type="button">Previous Page</button>
    </a>
</div>

<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
    
        $id =$_POST['id'];
        $book_name =$_POST['book_name'];
        $author_name =$_POST['author_name'];
    
        $sql = "UPDATE books SET book_name = :book_name, author_name = :author_name WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ":book_name" => $book_name,
            ":author_name" => $author_name,
            ":id" => $id
        ]);
    
        header("Location: update.php");

        }


    catch(Exception $e){
        echo $e->getMessage();
    }

}



$book = null;
if (isset($_GET['id'])) {
    $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute([":id" => $_GET['id']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
    
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?= $book['id']; ?>">

        <div>
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" name="book_name" value="<?= $book['book_name'] ?? ''; ?>" required>
        </div>

        <div>
            <label for="author_name">Author Name:</label>
            <input type="text" id="author_name" name="author_name" value="<?= $book['author_name'] ?? ''; ?>" required>
        </div>

        <button type="submit">Update Book</button>
    </form>

    <br>
    <div>
        <a href="update.php">
            <button type="button">Cancel</button>
        </a>
    </div>