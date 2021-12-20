<?php
    include('header.html');
   include('config.php');
  
   function getIssuedBooks(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('Select b_id, b_name, m_id, m_name, issue_date, due_date from member
         NATURAL JOIN book_issue NATURAL JOIN book
         ORDER BY issue_date desc, b_id asc');

        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){
            echo "<tr>";      
            echo "<td>".$result["b_id"]."</td>";
            echo "<td>".$result["b_name"]."</td>";
            echo "<td>".$result["m_id"]."</td>";
            echo "<td>".$result["m_name"]."</td>";
            echo "<td>".$result["issue_date"]."</td>";
            echo "<td>".$result["due_date"]."</td>";
            echo "<td> <a href=\"return-book-panel.php?book_id=".$result["b_id"]."&m_id=".$result["m_id"]."\" class='btn btn-secondary'>Return</a> </td>";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container">
    <div class="row">
            <div class="col-sm-3">    
                <h5>List of Issued Books</h5>
            </div>
            <div class="col-xs-4">
                <input style="float:right; margin-right:20px" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..">
            </div>
            <?php if(isset($_GET['member']) && isset($_GET['book'])) { ?>
                <div class="col-xs-5" style="float:right">
                    <div class="toast show">
                        <div class="toast-header">
                            <strong class="me-auto">Success Message</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            <p><?php echo $_GET['book'] ?> successfully issued to <?php echo $_GET['member'] ?> </p>
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
         <th> Member Id </th>
         <th> Member Name </th>
          <th> Issue date </th>
         <th> Due date </th>
         <th> Action</th>
        </thead>

        <tbody>
            <?php getIssuedBooks()?>
        </tbody>

        </table>
    </div>
<script src="assets/search-table.js"></script>
  
</body>
</html>