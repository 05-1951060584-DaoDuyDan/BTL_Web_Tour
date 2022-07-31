<?php
ob_start();
require "config/config.php";
require('partials-front/header.php');
require_once "../classprocessSQL.php";
require_once "../process-string.php";
$ps = new Process();
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST['btnaddtour'])) {
        require('partials-front/header.php');
        $sqlstatustour = "Select* from tb_touroperator, tb_user where tb_user.id_user = tb_touroperator.id_user and tb_user.email = '{$user}'";
        $resultstatustour =  mysqli_query($conn, $sqlstatustour);
        if (mysqli_num_rows($resultstatustour) > 0) {
            $row = mysqli_fetch_assoc($resultstatustour);
        }
        $tour_code = $_POST['tour_code'];
        $typetour = $_POST['typetour'];
        $nametour = $_POST['nametour'];
        $startlocation = $_POST['startlocation'];
        $endlocation = $_POST['endlocation'];
        $numberofdays = $_POST['numberofdays'];
        $tourinfo = $_POST['tourinfo'];
        if ($tourtragop = $_POST['inlineRadioOptions'] == "option1") {
            $tourinstallemnt = 1;
        } else {
            $tourinstallemnt = 0;
        }
        $tourdiscount = $_POST['tourdiscount'];
        $quydinhtour = $_POST['quydinhtour'];
        $khuyenmaitour = $_POST['khuyenmaitour'];
        $chinhsachtour = $_POST['chinhsachtour'];
        $sqladdtour = "Insert into tb_tour Values('{$tour_code}','{$nametour}','{$startlocation}','{$endlocation}',{$numberofdays},{$tourdiscount}, '{$tourinfo}', {$tourinstallemnt} ,'{$quydinhtour}','{$khuyenmaitour}','{$chinhsachtour}', 0, 0, {$_POST['typetour']}, {$row['id_touroperator']})";
        if (mysqli_query($conn, $sqladdtour)) {
            header("location: tourmanager.php?tourcode=$tour_code");
        } else {
            header("location: index.php");
        }

        $sqlstatustour = "Select* from tb_touroperator, tb_user, tb_tour where tb_user.id_user = tb_touroperator.id_user and tb_user.email = '{$user}' and tour_code = '{$tour_code}'";
        $resultstatustour =  mysqli_query($conn, $sqlstatustour);
        if (mysqli_num_rows($resultstatustour) > 0) {
            $row = mysqli_fetch_assoc($resultstatustour);
        }
        mkdir("../images/Tour/" . $tour_code);
    } else {
        header("location: index.php");
    }
?>

<?php
}
ob_end_flush();
?>