<?php
    include 'config/config.php';
    //   session_start(); //Dịch vụ bảo vệ
      if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
          header("Location:login.php");
      }
    $nametypepage_new = $_POST['nametypepage_new'];
    $id_typepage = $_POST['id_typepage'];

    $sql = "UPDATE tb_typepage set nametypepage = '$nametypepage_new' where id_typepage = '$id_typepage'";  
    $ressult = mysqli_query($conn, $sql);
    if($ressult > 0) {
        header("Location: typepage.php");
        // echo $sql;
    }
    else {
        header("Location: errortypepage.php");
        // echo "Loi";
    }
    mysqli_close($conn);
?>