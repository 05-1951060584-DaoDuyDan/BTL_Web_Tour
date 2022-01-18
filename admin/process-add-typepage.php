<?php
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {

    $nametypepage = $_POST['nametypepage'];
    

    // Bước 02:
    $sql = "INSERT INTO tb_typepage (nametypepage) VALUES ('$nametypepage')";

    echo $sql;
    $result = mysqli_query($conn,$sql);
    // Bước 03:
    if($result > 0){
        header("Location: typepage.php");
    }else{
        echo "Lỗi!";
    }

    //Bước 04: Đóng kết nối
    mysqli_close($conn);
}else{
    header('location: ../index.php');
}


?>