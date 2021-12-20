<?php
    include('header.html');
   include('config.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        #icon{
          border: 1px solid black;
         
          
          background-color: aliceblue;
        }
        #icon div p{
          text-align:center;
          text-decoration: none;
        }
    </style>
</head>
<body>
      <div class="container">
        <div class="row">
          <a href="list-books.php" class="btn btn-primary btn-lg btn-block">List Books</a>
          <a href="list-issued-book.php" class="btn btn-primary btn-lg btn-block">List of Issued Books</a>
          <a href="list-returned-books.php" class="btn btn-primary btn-lg btn-block">List of Returned Books</a>
          <a href="list-lost-book.php" class="btn btn-primary btn-lg btn-block">List of Lost Books</a>
          <a href="list-member.php" class="btn btn-primary btn-lg btn-block">List of Members</a>
        </div>
    </div>
</body>
