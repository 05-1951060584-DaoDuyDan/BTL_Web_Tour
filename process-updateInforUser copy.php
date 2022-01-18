<?php
session_start();
if (!isset($_SESSION['LoginOK'])) {
    header('location: index.php');
} else {
    if(isset($_POST['submitUpdateUser'])){
        $nameUser = $_POST['nameuser'];
        $surnameUser = $_POST['surnameuser'];
        $data = file_get_contents($_FILES['imgUserUpdate']['tmp_name']);
        $email = $_POST['emailUpdate'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("UPDATE `tb_user` SET `nameuser` = ?, `surnameuser` = ?, `imageuser` = ? WHERE `email` = ?");
        $stmt->bindParam(1, $nameUser);
        $stmt->bindParam(2, $surnameUser);
        $stmt->bindParam(3, $data);
        $stmt->bindParam(4, $email);
        if($stmt->execute()){
            header("location: userinformation.php");
        }
    }
}
?>