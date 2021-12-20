<?php 
    include('config.php');

    $query = $pdo->prepare("
    INSERT INTO book_issue(m_id, b_id) VALUES(:memberId, :b_id)"
    );

    
    $query->bindParam('memberId', $_GET['memberId']);
    $query->bindParam('b_id', $_GET['b_id']);
    $query->execute();
    
    $query = $pdo->prepare("
    SELECT b.b_name, m.m_name from book b, member m where b.b_id = :b_id and m.m_id = :m_id"
    );
    $query->bindParam('m_id', $_GET['memberId']);
    $query->bindParam('b_id', $_GET['b_id']);
    $query->execute();
    $result = $query->fetch();
    header("location:list-issued-book.php?book=".$result['b_name']."&member=".$result['m_name']);
?> 