<?php
    include('header.html');
   include('config.php');
   
   function getLostBook(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('SELECT b_id, b_name, m_id, m_name, Payment_Date, Cost_Paid FROM book
         NATURAL JOIN losses_book NATURAL JOIN member order by Payment_Date desc, b_id asc');

        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){
            echo "<tr>";      
            echo "<td>".$result["b_id"]."</td>";
            echo "<td>".$result["b_name"]."</td>";
            echo "<td>".$result["m_id"]."</td>";
            echo "<td>".$result["m_name"]."</td>";
            echo "<td>".$result["Payment_Date"]."</td>";
            echo "<td>".$result["Cost_Paid"]."</td>";
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
            <div class="col-xs-3">    
                <h5>Lost Books Details</h5>
            </div>
            <div class="col-xs-8">
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
                            <p><?php echo $_GET['book'] ?> book successfully added to Lost book list </p>
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
         <th> Cost Paid </th>
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