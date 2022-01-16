<?php
    include 'config/config.php';
    //   session_start(); //Dịch vụ bảo vệ
      if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
          header("Location:login.php");
      }
    $nametypetour_new = $_POST['nametypetour_new'];
    $id_typetour = $_POST['id_typetour'];

    $sql = "UPDATE tb_typetour set nametypetour = '$nametypetour_new' where id_typetour = '$id_typetour'";  
    $ressult = mysqli_query($conn, $sql);
    if($ressult > 0) {
        header("Location: typetour.php");
        // echo $sql;
    }
    else {
        header("Location: errortypetour.php");
        // echo "Loi";
    }
    mysqli_close($conn);
?>