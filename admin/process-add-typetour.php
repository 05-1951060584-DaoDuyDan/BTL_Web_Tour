<?php
include 'config/config.php';
//   session_start(); //Dịch vụ bảo vệ
  if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
      header("Location:login.php");
  }

    $nametypetour = $_POST['nametypetour'];
    

    // Bước 02:
    $sql = "INSERT INTO tb_typetour (nametypetour) VALUES ('$nametypetour')";

    echo $sql;
    $result = mysqli_query($conn,$sql);
    // Bước 03:
    if($result > 0){
        header("Location: typetour.php");
    }else{
        echo "Lỗi!";
    }

    //Bước 04: Đóng kết nối
    mysqli_close($conn);


?>