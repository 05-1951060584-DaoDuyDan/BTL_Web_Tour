<?php
ob_start();
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if(isset($_POST['submitUpdateUser'])){
        $nametouroperator = $_POST['nametouroperator'];
        $lhkd = $_POST['lhkd'];
        $imgOperatorUpdate = file_get_contents($_FILES['imgOperatorUpdate']['tmp_name']);
        $id_touroperator = $_POST['idtouroperator'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("UPDATE `tb_touroperator` SET `nametouroperator` = ?, `businesstype` = ?, `imagetouroperator` = ? WHERE `id_touroperator` = ?");
        $stmt->bindParam(1, $nametouroperator);
        $stmt->bindParam(2, $lhkd);
        $stmt->bindParam(3, $imgOperatorUpdate);
        $stmt->bindParam(4, $id_touroperator);
        if($stmt->execute()){
            header("location: tourmanager.php");
        }
    }
}
?>