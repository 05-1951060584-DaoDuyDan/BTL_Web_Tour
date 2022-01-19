<?php 
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    if(isset($_GET['codetour'])){
        $sql = "UPDATE tb_tour set `lock` = 1 where tour_code = '{$_GET['codetour']}'";
        echo $sql;
        if(mysqli_query($conn, $sql)){
            header("location: tour.php");
        }
    }
} else {
    header('location: ../index.php');
}
?>