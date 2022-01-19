<?php 
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    if(isset($_GET['id'])){
        $sql = "UPDATE tb_tourservice set `lock_service` = 1 where id_tourservice = {$_GET['id']}";
        if(mysqli_query($conn, $sql)){
            header("location: service.php");
        }
    }
} else {
    header('location: ../index.php');
}
?>