<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if(isset($_POST["btnDeleteDay"]) && isset($_POST)){
        $tour_code = $_POST['tourcodedelete'];
        $tourday = $_POST['daydeleteout'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("Delete from tb_tourday where tour_code = ? and day = ?");
        $stmt->bindParam(1, $tour_code);
        $stmt->bindParam(2, $tourday);
        if($stmt->execute()){
            header("location: process-addtour.php?tourcode={$tour_code}");
        }else{
            header("location: process-addtour.php?tourcode={$tour_code}");
        }
    }else{
        header('location: process-addtour.php');
    }
}
?>