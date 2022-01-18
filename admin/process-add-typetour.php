<?php
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {

    $nametypetour = $_POST['nametypetour'];
    $sql = "INSERT INTO tb_typetour (nametypetour) VALUES ('$nametypetour')";
    $result = mysqli_query($conn,$sql);
    // Bước 03:
    if($result > 0){
        header("Location: typetour.php");
    }else{
        echo "Lỗi!";
    }

    //Bước 04: Đóng kết nối
    mysqli_close($conn);
}else{
    header('location: ../index.php');
}

?>