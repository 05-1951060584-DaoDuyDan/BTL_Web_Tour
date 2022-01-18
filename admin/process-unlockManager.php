<?php 
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    if(isset($_GET['id'])){
        $sqlcheck = "Select* from tb_user where id_user = {$_GET['idus']} and `lock` = 0";
        $resultcheck = mysqli_query($conn, $sqlcheck);
        if(mysqli_num_rows($resultcheck)>0){
            $sql = "UPDATE tb_touroperator set `lock` = 0 where id_touroperator = {$_GET['id']}";
            $sql1 = "UPDATE tb_tour set `lock` = 0 where id_touroperator = {$_GET['id']}";
            echo $sql;
            if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)){
                header("location: tourmanager.php");
            }
        }else{
            header("location: tourmanager.php");
        }
    }
} else {
    header('location: ../index.php');
}
?>