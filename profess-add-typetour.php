<?php
    include '../config/config.php';
    // session_start(); //Dịch vụ bảo vệ
    if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
        header("Location:../login.php");
    }
    $name_service = $_POST['name_service'];
    

    // Bước 02:
    $sql = "INSERT INTO tbl_service (name_service) VALUES ('$name_service')";

    echo $sql;
    $result = mysqli_query($conn,$sql);
    // Bước 03:
    if($result > 0){
        header("Location: ./DichVu.php");
    }else{
        echo "Lỗi!";
    }

    //Bước 04: Đóng kết nối
    mysqli_close($conn);


?>