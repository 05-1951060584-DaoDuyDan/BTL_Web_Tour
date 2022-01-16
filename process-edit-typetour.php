<?php
    include 'config/config.php';
    //   session_start(); //Dịch vụ bảo vệ
      if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
          header("Location:login.php");
      }
    $name_service_new = $_POST['name_service_new'];
    $id_service = $_POST['id_service'];

    $sql = "UPDATE tbl_service set name_service = '$name_service_new' where id_service = '$id_service'";  
    $ressult = mysqli_query($conn, $sql);
    if($ressult > 0) {
        header("Location: ./DichVu.php");
        // echo $sql;
    }
    else {
        header("Location: ./errorService.php");
        // echo "Loi";
    }
    mysqli_close($conn);
?>