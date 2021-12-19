<?php
    include('header.php');
   include('config.php');
   
   function getBookName(){
        $pdo = $GLOBALS['pdo'];
        
        $col = $_GET['column'];

        //prepare a call
        $query = $pdo->prepare('SELECT '.$col.' from book');

        //execute the sql
        $query->execute();
        //fetch the result
        
        while($result = $query->fetch()){      
            echo "<tr><td>".$result[$col]."</td></tr>";
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
<table class="table">

    <thead>
       <tr> Book Name </tr>
    </thead>

    <tbody>
        <?php getBookName()?>
    </tbody>
</div>
</table>
</body>
</html>