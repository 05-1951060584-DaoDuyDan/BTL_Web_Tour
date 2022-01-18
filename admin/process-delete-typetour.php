<?php
    include 'config/config.php';
    //   session_start(); //Dịch vụ bảo vệ
      if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
          header("Location:login.php");
      }

    
    $id_typetour_delete = $_POST['id_typetour_delete'];
    
    $sql = "DELETE from tb_typetour where id_typetour = '$id_typetour_delete'";
    echo $sql;

    $result = mysqli_query($conn, $sql);

    if($result > 0) {
        header("Location: typetour.php");
    }
    else {
        header("Location: errortypetour.php");
        // echo "Loi";
    }

    mysqli_close($conn);

?>