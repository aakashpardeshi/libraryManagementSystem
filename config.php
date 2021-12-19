<!--
    DB Connections
-->

<?php
    $ENCRYPTION_KEY = "RastgeleAnahtar";

    $DB_SERVER = 'localhost:3306';
    $DB_USERNAME = 'aakash';
    $DB_PASSWORD = 'admin';
    $DB_DATABASE = 'library_management_system';

    try {
        $pdo = new PDO("mysql:host=$DB_SERVER; dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Could not establish connection: " . $e->getMessage();
    }
?>