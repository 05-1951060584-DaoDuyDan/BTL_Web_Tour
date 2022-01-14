<?php
require "config/config.php";
if(isset($_SESSION['LoginOK'])){
    if(!isset($_GET['tourcode']) || !isset($_GET['idse']) || !isset($_GET['iduser'])){
        header("location: index.php");
    }else{
        $tour_code = $_GET['tourcode'];
        $id_startendday = $_GET['idse'];
        $id_user = $_GET['iduser'];
        $sqlcart = "Select* from tb_tourcart where id_user = {$id_user}";
        $resultcart = mysqli_query($conn, $sqlcart);
        if(mysqli_num_rows($resultcart)>0){
            $sqlcartupdate = "Update tb_tourcart set tour_code = '{$tour_code}', id_startendday = {$id_startendday} where id_user = {$id_user}";
            echo $sqlcartupdate;
            mysqli_query($conn,$sqlcartupdate);
        }else{
            $sqlcartupdate = "INSERT INTO `tb_tourcart`(`id_user`, `tour_code`, `id_startendday`) VALUES ('$id_user','$tour_code','$id_startendday')";
            echo $sqlcartupdate;
            mysqli_query($conn,$sqlcartupdate);
        }
        //header("location: bookingtour.php?idse={$id_startendday}&tourcode={$tour_code}");
    }
}else{
    $tour_code = $_GET['tourcode'];
    $id_startendday = $_GET['idse'];
    header("location: bookingtour.php?idse={$id_startendday}&tourcode={$tour_code}");
}

?>