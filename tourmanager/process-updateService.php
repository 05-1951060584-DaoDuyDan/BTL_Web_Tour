<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if(isset($_POST)){
        require_once "../classprocessSQL.php";
        require_once "../process-string.php";
        $ps = new Process();
        $id_tourservice = $_POST[''];
        $nameservice = $_POST[''];
        $priceservice = $_POST[''];
        $nameservice = $_POST['nameservice'];
        $priceservice = $_POST['priceservice'];
        $tour_code = $_POST['tourcode'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("UPDATE `tb_tourservice` SET (`nameservice`, `priceservice`, `tour_code`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nameservice);
        $stmt->bindParam(2, $priceservice);
        $stmt->bindParam(3, $tour_code);
        if ($stmt->execute()) {
            
        }
    }
}
?>