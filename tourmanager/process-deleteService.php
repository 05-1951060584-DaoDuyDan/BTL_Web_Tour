<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST)) {
        require_once "../classprocessSQL.php";
        require_once "../process-string.php";
        $ps = new Process();
        $id_tourservice = $_POST['idTourService'];
        $tour_code = $_POST['tourcode'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("DELETE FROM tb_tourservice where id_tourservice = ?");
        $stmt->bindParam(1, $id_tourservice);
        if ($stmt->execute()) {
            
        } else {
            echo "Không thành công!";
        }
    } else {
        header("location: tourmanager.php");
    }
}
