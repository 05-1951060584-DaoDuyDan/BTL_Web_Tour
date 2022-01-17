<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if(isset($_POST['codebookingtour'])){
        $count = 0;
        $codebookingtour = $_POST['codebookingtour'];
        $stmt = $dbh->prepare("Delete from tb_tourservicebookingtour where code_bookingtour = ?");
        $stmt->bindParam(1, $codebookingtour);
        $stmt->execute() ? $count++ : $count=0;
        $stmt = $dbh->prepare("Delete from tb_tourbooking where code_bookingtour = ?");
        $stmt->bindParam(1, $codebookingtour);
        $stmt->execute() ? $count++ : $count=0;
        if($count!=0){
            ?>
            
            <?php
        }
    }
}
?>