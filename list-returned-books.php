<?php
    include('header.html');
   include('config.php');
   
   function getLostBook(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('SELECT m_id, m_name, b_id, b_name, Return_Date, Late_Fees FROM book NATURAL JOIN return_book NATURAL JOIN member');

        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){
            echo "<tr>";      
            echo "<td>".$result["b_id"]."</td>";
            echo "<td>".$result["b_name"]."</td>";
            echo "<td>".$result["m_id"]."</td>";
            echo "<td>".$result["m_name"]."</td>";
            echo "<td>".$result["Return_Date"]."</td>";
            echo "<td>".$result["Late_Fees"]."</td>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="col-sm-3">    
                <h5>Returned Books Details</h5>
            </div>
            <div class="col">
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
                            <p><?php echo $_GET['book'] ?> book successfully returned </p>
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
          <th> Payment Date </th>
         <th> Late Fees Paid </th>
        </thead>

        <tbody>
            <?php getLostBook()?>
        </tbody>

        </table>
    </div>
</div>
<script src="assets/search-table.js"></script>
</body>
</html>