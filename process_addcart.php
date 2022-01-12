<?php
if(isset($_SESSION['LoginOK'])){
    if(!isset($_GET['tourcode'])&& !isset($_GET['idse'])){
        header("location: index.php");
    }else{
        $tour_code = $_GET['tourcode'];
        $id_startendday = $_GET['idse'];
    }
}else{
    $tour_code = $_GET['tourcode'];
    $id_startendday = $_GET['idse'];
    header("bookingtour.php?idse=$id_startendday&tourcode=$tour_code");
}

?>