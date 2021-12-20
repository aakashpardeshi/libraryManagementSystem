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
        $result = $query->fetch();
            echo "<tr>";      
            echo "<td>".$result["b_id"]."</td>";
            echo "<td>".$result["b_name"]."</td>";
            echo "<td>".$result["b_author"]."</td>";
            echo "<td>".date('Y-m-d H:i:s')."</td>";
            echo "<td>1</td>";
            echo "</tr>";
   }

   function getMember(){
    $pdo = $GLOBALS['pdo'];

    //prepare a call
    $query = $pdo->prepare('SELECT m_id,m_name,join_date FROM `member` where m_id='.$_GET['m_id']);

    //execute the sql
    $query->execute();
    //fetch the result
    
    $result = $query->fetch();
    
        echo "<tr>";      
        echo "<td>".$result["m_id"]."</td>";
        echo "<td>".$result["m_name"]."</td>";
        echo "<td>".$result["join_date"]."</td>";
        echo "</tr>";
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
                <h5>Return Book</h5>
            </div>
    </div><br/>
    <div class="row">
            <div class="col-sm-4">    
                <h6>Book Details</h6>
            </div>
    </div>
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
    <br/>
    <div class="row">
            <div class="col-sm-4">    
                <h6>User Details</h6>
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
                <?php getMember()?>
            </tbody>

        </table>
    </div>
    <br/>
    <div class="row">
        <form action="return-book.php" method="GET">
            <label for="isLost">Is book lost?</label>
            <select class="form-control"  name="isLost" id="isLost">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <br/>
            <input type="hidden" name="book_id" value=<?php echo $_GET["book_id"] ?>>
            <input type="hidden" name="m_id" value=<?php echo $_GET["m_id"] ?>>
            <button type="submit" class="btn btn-success"> Return </button>
        </form>
    </div>
    
</div>
</body>
</html>