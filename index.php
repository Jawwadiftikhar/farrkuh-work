<?php 

require("db_connect.php");

$showData = $db->query("SELECT * from books");
$fetchData = $showData->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
    <link rel="stylesheet" href="index.css">
</head>

<body>

<nav id="navbar">
        <div id="nav-img"><img src="download.jfif" alt="logo"></div>
        <div class="nav-text">Home</div>
        <div class="nav-text">Contact Us</div>
        <div class="nav-text">About Us</div>
    </nav>


    <div>
        <table>
            <thead>
                <tr>
                    <th scope="col">Serial no.</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author Name</th>
                </tr>
            </thead>
        
            <tbody>
                <?php if(!empty($fetchData)): ?>
                    <?php foreach($fetchData as $index => $row): ?>
                        <tr>
                            <td id="serial-id"><?=$index + 1;?></td>
                            <td><?=htmlspecialchars($row['book_name']);?></td>
                            <td><?=htmlspecialchars($row['author_name']);?></td>
                        </tr>
                
                    <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No books were found in the database</td>
                    </tr>
                <?php endif;?>      
            </tbody>
        </table>


        <div id="button-div">
        <a href="add.php">
            <button class="add button-container" id="add-button" type="button">Add</button>
        </a>    
        
        <a href="update.php">
            <button class="update button-container" type="button">Update</button>
        </a>

        <a href="delete.php">
            <button class="delete button-container" type="button">Delete</button>
        </a>
        </div>            
    </div>    


<script src="index.js"></script>
</body>
</html>