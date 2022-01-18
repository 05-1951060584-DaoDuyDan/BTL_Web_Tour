<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if(isset($_GET['tourcode']) && isset($_GET['status'])){
        $sql = "UPDATE tb_tour set status_tour = 1 where tour_code = '{$_GET['tourcode']}'";
        mysqli_query($conn, $sql);
        $tour_code = $_GET['tourcode'];
        header("location: process-addtour.php?tourcode={$tour_code}");
    }else if(isset($_GET['tourcode']) && isset($_GET['statuslock'])){
        $sql = "UPDATE tb_tour set status_tour = 0 where tour_code = '{$_GET['tourcode']}'";
        mysqli_query($conn, $sql);
        $tour_code = $_GET['tourcode'];
        header("location: process-addtour.php?tourcode={$tour_code}");
    }else{

    }
}
?>