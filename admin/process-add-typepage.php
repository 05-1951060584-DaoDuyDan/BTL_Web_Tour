<?php
include 'config/config.php';
//   session_start(); //Dịch vụ bảo vệ
  if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
      header("Location:login.php");
  }

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


?>