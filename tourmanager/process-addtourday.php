<?php
    require "config/config.php";
    if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
        header('location: ../index.php');
    }else{
        if(isset($_POST['btndayoftour'])){
            $tour_code = $_GET['tourcode'];
            $day = $_POST['day'];
            $location = $_POST['nametourday'];
            $morning = $_POST['morningtour'];
            $noon = $_POST['noonofday'];
            $afternoon = $_POST['afternoonofday'];
            $night = $_POST['nightofday'];
            $sql = "Insert into tb_tourday values( '{$tour_code}', {$day}, '{$location}','{$morning}','{$noon}','{$afternoon}','{$night}')";
            if (!mysqli_query($conn, $sql)) {
                header("location: process-addtour.php?tourcode={$tour_code}");
            }else{
                header("location: process-addtour.php?tourcode={$tour_code}");
            }
        }else{
            header('location: tourmanager.php');
        }
    }
?>