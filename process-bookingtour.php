<?php
    if(isset($_POST['name'])){
        //$code_bookingtour = strtoupper(substr(md5(rand()), 0, 10));
        echo isset($_POST['checkbox1']);
    }else{
        header("location: index.php");
    }
?>