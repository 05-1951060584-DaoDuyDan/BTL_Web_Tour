<?php
    session_start();

// Bước 01; Kết nối tới CSDL:
    define('HOST','localhost');
    define('USER','root');
    const PASS  = '';
    const DB    = 'db_tournew'; 
    $conn = mysqli_connect(HOST,USER, PASS,DB);
    if(!$conn){
        die('Không thể kết nối');
    }
    if (isset($_SESSION['LoginOK'])) {
        $user = substr($_SESSION['LoginOK'], 1, 60);
        $user = rtrim($user);
    }
    $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
?>