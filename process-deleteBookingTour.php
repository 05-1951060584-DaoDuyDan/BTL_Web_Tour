<?php
require "config/config.php";
if(isset($_POST['submitDeleteBKT'])){
    $codebookingtour = $_POST['idBookingTourVal'];
    $stmt = $dbh->prepare("Delete from tb_tourservicebookingtour where code_bookingtour = ?");
    
}
?>