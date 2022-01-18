<?php
require "config/config.php";
if(isset($_POST['submitDeleteBKT'])){
    $codebookingtour = $_POST['idBookingTourVal'];
    $stmt = $dbh->prepare("Delete from tb_tourservicebookingtour where code_bookingtour = ?");
    $stmt->bindParam(1, $codebookingtour);
    $stmt->execute();
    $stmt = $dbh->prepare("Delete from tb_tourbooking where code_bookingtour = ?");
    $stmt->bindParam(1, $codebookingtour);
    $stmt->execute();
    header('location: userinformation.php');
}else{
    header('location: userinformation.php');
}
?>