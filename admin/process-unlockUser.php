<?php 
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    if(isset($_GET['id'])){
        $sql = "UPDATE tb_user set `lock` = 0 where id_user = {$_GET['id']}";
        $sqlManager = "Select* from tb_touroperator where id_user = {$_GET['id']}";
        $resultManager = mysqli_query($conn, $sqlManager);
        $rowManager = mysqli_fetch_assoc($resultManager);
        $id_Manager = $rowManager['id_touroperator'];
        $sql1 = "UPDATE tb_touroperator set `lock` = 0 where id_touroperator = {$id_Manager}";
        $sql2 = "UPDATE tb_tour set `lock` = 0 where id_touroperator = {$id_Manager}";
        if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
            header("location: user.php");
        }
    }
} else {
    header('location: ../index.php');
}
?>