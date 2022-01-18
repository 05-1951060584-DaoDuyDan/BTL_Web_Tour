<?php
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
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
}else{
    header('location: ../index.php');
}
?>