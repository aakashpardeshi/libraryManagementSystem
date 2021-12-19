<?php 
    include('config.php');

    $query = $pdo->prepare("
    INSERT INTO `book` (`b_name`, `b_price`, `publish_year`, `total_copies`, `b_author`, `c_id`, `p_id`)
    VALUES (:bname, :bprice, :pubYear, :copies, :bauthor, :cat, :pub)"
    );

    
    $query->bindParam('bname', $_POST['bname']);
    $query->bindParam('bprice', $_POST['bprice']);
    $query->bindParam('pubYear', $_POST['pubYear']);
    $query->bindParam('copies', $_POST['copies']);
    $query->bindParam('bauthor', $_POST['bauthor']);
    $query->bindParam('cat', $_POST['category']);
    $query->bindParam('pub', $_POST['pub']);
    $query->execute();
    header("location:list-books.php");
?> 