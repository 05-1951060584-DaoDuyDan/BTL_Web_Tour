<?php
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
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
}
else{
    header('location: ../index.php');
}
?>