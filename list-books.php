<?php
    include('header.html');
   include('config.php');
   
   function getBookName(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('SELECT b_id, b_name, b_price, publish_year, total_copies, b_author FROM book 
        NATURAL JOIN book_category NATURAL JOIN publisher order by b_id asc, b_name asc');


        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){

            if($result["total_copies"] <= 0){
                echo "<tr>"; 
                echo "<td>".$result["b_id"]."</td>";
                echo "<td>".$result["b_name"]."</td>";
                echo "<td>".$result["b_price"]."</td>";
                echo "<td>".$result["publish_year"]."</td>";
                echo "<td>".$result["total_copies"]."</td>";
                echo "<td>".$result["b_author"]."</td>";
                echo "<td> <a href=\"issue-book.php?book_id=".$result["b_id"]."\" class='btn disabled btn-secondary'>Issue</a> </td>";
                echo "</tr>";     
            }else{
                echo "<td>".$result["b_id"]."</td>";
                echo "<td>".$result["b_name"]."</td>";
                echo "<td>".$result["b_price"]."</td>";
                echo "<td>".$result["publish_year"]."</td>";
                echo "<td>".$result["total_copies"]."</td>";
                echo "<td>".$result["b_author"]."</td>";
                echo "<td> <a href=\"issue-book.php?book_id=".$result["b_id"]."\" class='btn btn-secondary'>Issue</a> </td>";
                echo "</tr>";
            }
           
           

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="col-xs-3">    
                <h5>List of Books</h5>
            </div>
            <div class="col-xs-4">
                <a href="add-book-panel.php" style="float:right; height:40px" class="btn btn-success">Add Book</a>
                <input style="float:right; margin-right:20px" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..">
            </div>
            <?php if(isset($_GET['book'])) { ?>
                <div class="col-xs-5" style="float:right">
                    <div class="toast show">
                        <div class="toast-header">
                            <strong class="me-auto">Success Message</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            <p><?php echo $_GET['book'] ?> successfully added to the list </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
         <th>Action</th>

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