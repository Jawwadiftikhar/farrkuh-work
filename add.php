<?php 

require("db_connect.php");
?>

<link rel="stylesheet" href="add.css">

<form method="POST" action="add.php">
    <div>
        <label for="book_name">Book Name:</label>
        <input type="text" id="book_name" name="book_name" required>
    </div>
    <div>
        <label for="author_name">Author Name:</label>
        <input type="text" id="author_name" name="author_name" required>
    </div>

    <button type="submit">Add Book</button>

</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $book_name = $_POST["book_name"];
    $author_name = $_POST["author_name"];
    
    try{
        $sql = "INSERT INTO books (book_name, author_name) VALUES (:book_name, :author_name)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':book_name' => $book_name,
            ':author_name' => $author_name
        ]);    
    
        sleep(1);
        header('Location: index.php');
    exit();
    }
    catch(PDOException $e){
        echo 'Error Adding Book'. $e->getMessage();  
    }
    
}
?>
    <a href="index.php">
    <button>Previous Page</button>
    </a>