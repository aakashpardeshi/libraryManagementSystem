<?php
    include('header.html');
   include('config.php');
   
   function getMembers(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('SELECT m_id,m_name,join_date FROM `member` ');

        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){
            echo "<tr>";      
            echo "<td>".$result["m_id"]."</td>";
            echo "<td>".$result["m_name"]."</td>";
            echo "<td>".$result["join_date"]."</td>";
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
                <h5>List of Members</h5>
            </div>
            <div class="col">
                <a href="add-member-panel.php" style="float:right; height:40px" class="btn btn-success">Add Member</a>
                <input style="float:right; margin-right:20px" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..">
            </div>
        </div>
    <br/>
    <div class="row">

        <table class="table" id="myTable">
        <thead class="thead-dark">
         <th> Member Id </th>
         <th> Member Name </th>
         <th> Join Date </th>
        </thead>

        <tbody>
            <?php getMembers()?>
        </tbody>

        </table>
    </div>
</div>
<script src="assets/search-table.js"></script>
</body>
</html>