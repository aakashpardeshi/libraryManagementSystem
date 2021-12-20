<?php
    include('header.html');
   include('config.php');
   
   function getBook(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('SELECT b_id, b_name, b_author FROM book where b_id ='.$_GET["book_id"]);

        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){
            echo "<tr>";      
            echo "<td>".$result["b_id"]."</td>";
            echo "<td>".$result["b_name"]."</td>";
            echo "<td>".$result["b_author"]."</td>";
            echo "<td>".date('Y-m-d H:i:s')."</td>";
            echo "<td>1</td>";
            echo "</tr>";
        }
   }

   function populateMembersDropDown(){
        $pdo = $GLOBALS['pdo'];

        //prepare a call
        $query = $pdo->prepare('SELECT m_id FROM member');

        //execute the sql
        $query->execute();

        echo '<div class="form-group">';
        echo '<label for="memberId">Select a Member * </label> </br>';
        echo '<select class="form-control" name="memberId" id="category">';
        while($result = $query->fetch()){
            echo '<option value="'.$result["m_id"].'">'.$result["m_id"].'</option>';
        }
        echo '</select>';
        echo '</div>';

    }
    function getMemberName(){
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
<script src="assets/search-table.js"></script>
<body>
<div class="container">
    <div class="row">
            <div class="col-sm-4">    
                <h5>Issue Book</h5>
            </div>
    </div><br/>
    <div class="row">
            <div class="col-sm-4">    
                <h6>Book Details</h6>
            </div>
    </div>
    <br/>
    <div class="row">
        <table class="table">
        <thead class="thead-dark">
         <th> Book Id </th>
         <th> Book Name </th>
         <th> Author </th>
         <th> Date & Time </th>
          <th> Quantity </th>
        </thead>

        <tbody>
            <?php getBook()?>
        </tbody>

        </table>
    </div>
    <div  class="row">
        <form action="add-book-issue.php" method="GET">
            <div class="col-md-2" style="float:right;position: relative; margin-top : 24px;">
                 <button type="submit" class="btn btn-success"> Issue Book </button>
            </div>  
            <div class="col-md-9">
                <?php populateMembersDropDown() ?>
            </div>
            <input type="hidden" name="b_id" value="<?php echo $_GET['book_id']?>">
        </form>
    </div>
    <br/>
    <hr/>
    <div class="row">
            <div class="col-md-7">    
                <h6>List of Members</h6>
            </div>
            <div class="col-md-5" style="float:right;position: relative;">
                <input style="float:right;margin-right:20px" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..">
            </div>
    </div>
    <div class="row">

        <table class="table" id="myTable">
        <thead class="thead-dark">
         <th> Member Id </th>
         <th> Member Name </th>
         <th> Join Date </th>
        </thead>

        <tbody>
            <?php getMemberName()?>
        </tbody>

        </table>
    </div>
</div>
<script src="assets/search-table.js"></script>
</body>
</html>