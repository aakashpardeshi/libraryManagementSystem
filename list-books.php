<?php
    include('header.html');
   include('config.php');
   
   function getBookName(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('SELECT b_id, b_name, b_price, publish_year, total_copies, b_author FROM book NATURAL JOIN book_category NATURAL JOIN publisher');

        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){
            echo "<tr>";      
            echo "<td>".$result["b_id"]."</td>";
            echo "<td>".$result["b_name"]."</td>";
            echo "<td>".$result["b_price"]."</td>";
            echo "<td>".$result["publish_year"]."</td>";
            echo "<td>".$result["total_copies"]."</td>";
            echo "<td>".$result["b_author"]."</td>";
            echo "</tr>";
        }

   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="col-sm-3">    
                <h5>List of Books</h5>
            </div>
            <div class="col">
                <a href="add-book-panel.php" style="float:right; height:40px" class="btn btn-success">Add Book</a>
                <input style="float:right; margin-right:20px" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..">
            </div>
        </div>
    <br/>
    <div class="row">

        <table class="table" id="myTable">
        <thead class="thead-dark">
         <th> Book Id </th>
         <th> Book Name </th>
         <th> Book Price </th>
         <th> Publish Year </th>
          <th> Total Copies </th>
         <th> Author </th>
        </thead>

        <tbody>
            <?php getBookName()?>
        </tbody>

        </table>
    </div>
</div>
<script src="assets/search-table.js"></script>
</body>
</html>