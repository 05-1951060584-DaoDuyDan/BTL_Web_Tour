<?php 
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    if(isset($_GET['codetour'])){
        $id_touroperator = $_GET['idMa'];
        $sqlcheck = "Select* from tb_touroperator where id_touroperator = {$id_touroperator} and `lock` = 0";
        $resultcheck = mysqli_query($conn, $sqlcheck);
        if(mysqli_num_rows($resultcheck)>0){
            $sql = "UPDATE tb_tour set `lock` = 0 where tour_code = '{$_GET['codetour']}'";
            if(mysqli_query($conn, $sql)){
                header("location: tour.php");
            }else{
                header("location: tour.php");
            }
        }else{
            header("location: tour.php");
        }
    }
} else {
    header('location: ../index.php');
}
?>