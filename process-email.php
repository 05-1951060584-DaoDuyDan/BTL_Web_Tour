<?php
    include "config/config.php";
    $result = mysqli_query($conn,"SELECT * FROM tb_user WHERE email='" . $_POST['email'] . "'");
    if(mysqli_num_rows($result) <= 0)
    {
        echo "Email hợp lệ có thể đăng ký";
    }else{
        echo "Email đã tồn tại trong server.";
    }
?>