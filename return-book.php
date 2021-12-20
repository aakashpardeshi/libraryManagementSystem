<?php
    $book_id = $_GET["book_id"];
    $m_id = $_GET["m_id"];
    $isLost = $_GET["isLost"];
    include('config.php');
     $query = $pdo->prepare("select b_name from book where b_id=".$book_id);
     $query->execute();
     $book = $query->fetch();

    if($isLost == "1"){
        $query = $pdo->prepare("
        insert into losses_book(m_id, b_id) values(:m_id,:book_id)"
        );

    
        $query->bindParam('book_id', $book_id);
        $query->bindParam('m_id', $m_id);
        $query->execute();
        header("location:list-lost-book.php?book=".$book['b_name']);
    }
    else{
       
        $query = $pdo->prepare("
        insert into return_book(m_id, b_id) values(:m_id,:book_id)"
        );

    
        $query->bindParam('book_id', $book_id);
        $query->bindParam('m_id', $m_id);
        $query->execute();
        header("location:list-returned-books.php?book=".$book['b_name']);
    }
?>