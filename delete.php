<?php 

require("db_connect.php");

?>


<?php
$showData = $db->query("SELECT * FROM Books");
$fetchData = $showData->fetchAll(PDO::FETCH_ASSOC);

?>



<form method="POST"action="delete.php">
    <div>
        <label for="id">Enter ID:</label>
        <input type="number" name="id" id="id" required>
        <button id="id" type="submit" name="delete">Delete</button>
    </div>

</form>



<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        $id = $_POST["id"];
     
        $sql = "DELETE FROM books WHERE id = :id";
     
        $delQuery = $db->prepare($sql);
        $delQuery->execute([":id"=> $id]);
    }
    

    catch(PDOException $e){
        echo "An Error Occured". $e->getMessage();
    }
    header("Location: delete.php");
}




if(isset($_GET["id2"])){
    try{
        $id2 = $_GET["id2"];

        $sql2 = "DELETE FROM books WHERE id = :id";

        $delQuery2 = $db->prepare($sql2);
        $delQuery2->execute([":id"=> $id2]);
    }
    catch(PDOException $e){
        echo "". $e->getMessage();
    }
    header('Location: delete.php');
}

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
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['book_name'])?></td>
                <td><?= htmlspecialchars($row['author_name'])?></td>
                <td>
    <a href="delete.php?id2=<?=$row['id'];?>" onclick="return confirm('Are you sure?');">
        <button type="button">Delete</button>
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