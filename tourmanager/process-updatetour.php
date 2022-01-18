<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if(isset($_POST['smUpdateTour'])){
        $tour_code = $_POST['tour_codeupdate'];
        $typetour = $_POST['typetour'];
        $nametour = $_POST['nametourupdate'];
        $startlocation = $_POST['startlocationupdate'];
        $endlocation = $_POST['endlocationupdate'];
        $numberofdays = $_POST['numberofdaysupdate'];
        $tourinfo = $_POST['tourinfoupdate'];
        if ($tourtragop = $_POST['inlineRadioOptionse'] == "option1") {
            $tourinstallemnt = 1;
        } else {
            $tourinstallemnt = 0;
        }
        $tourdiscount = $_POST['tourdiscountupdate'];
        $quydinhtour = $_POST['quydinhtourupdate'];
        $khuyenmaitour = $_POST['khuyenmaitourupdate'];
        $chinhsachtour = $_POST['chinhsachtourupdate'];
        //$typetour = $_POST['typetour'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("UPDATE `tb_tour` SET nametour = ?, startinglocation = ?, endinglocation = ?, 
        numberofdays = ?, tourdiscount = ?, tourinfo = ?, installment = ?, tourregulations = ?, conditiontour = ?
        , tourdepartureschedule = ?, id_typetour = ? where `tour_code` = ?");
        $stmt->bindParam(1, $nametour);
        $stmt->bindParam(2, $startlocation);
        $stmt->bindParam(3, $endlocation);
        $stmt->bindParam(4, $numberofdays);
        $stmt->bindParam(5, $tourdiscount);
        $stmt->bindParam(6, $tourinfo);
        $stmt->bindParam(7, $tourinstallemnt);
        $stmt->bindParam(8, $quydinhtour);
        $stmt->bindParam(9, $khuyenmaitour);
        $stmt->bindParam(10, $chinhsachtour);
        $stmt->bindParam(11, $typetour);
        $stmt->bindParam(12, $tour_code);
        if($stmt->execute()){
            header("location: process-addtour.php?tourcode={$tour_code}");
        }else{
            header("location: tourmanager.php");
        }
    }else{
        header("location: process-addtour.php");
    }
}
?>