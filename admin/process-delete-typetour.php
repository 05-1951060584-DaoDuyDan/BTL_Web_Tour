<?php
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {

    
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
}else{
    header('location: ../index.php');
}

?>