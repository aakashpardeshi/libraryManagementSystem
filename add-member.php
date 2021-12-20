<?php 
    include('config.php');

    $query = $pdo->prepare("
    insert into member (m_name,dob,city,state,street_no,street_name,apt_no,pincode)
     VALUES (:mname,:dob,:city,:state,:streetNo,:streetName,:aptNo,:pin)"
    );

    
    $query->bindParam('mname', $_POST['mname']);
    $query->bindParam('dob', $_POST['dob']);
    $query->bindParam('city', $_POST['city']);
    $query->bindParam('state', $_POST['state']);
    $query->bindParam('streetNo', $_POST['streetNo']);
    $query->bindParam('streetName', $_POST['streetName']);
    $query->bindParam('aptNo', $_POST['aptNo']);
    $query->bindParam('pin', $_POST['pin']);
    $query->execute();
    header("location:list-member.php");
?> 