<?php
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
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
}else{
    header('location: ../index.php');
}

?>