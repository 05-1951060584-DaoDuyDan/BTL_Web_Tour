<?php
    include 'config/config.php';
    //   session_start(); //Dịch vụ bảo vệ
      if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
          header("Location:login.php");
      }

    
    $id_typepage_delete = $_POST['id_typepage_delete'];
    
    $sql = "DELETE from tb_typepage where id_typepage = '$id_typepage_delete'";
    echo $sql;

    $result = mysqli_query($conn, $sql);

    if($result > 0) {
        header("Location: typepage.php");
    }
    else {
        header("Location: errortypepage.php");
        // echo "Loi";
    }

    mysqli_close($conn);

?>