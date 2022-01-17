<?php
if(isset($_POST['codebooktour'])&&isset($_POST['reviewBC']) && isset($_POST['submitReview'])){
    require "config/config.php";
    $sqlReview = "Update tb_tourbooking set complte = 1 ,review = {$_POST['reviewBC']} where code_bookingtour = '{$_POST['codebooktour']}'";
    if(mysqli_query($conn, $sqlReview)){
        ?>
        
        <?php
    }
}
?>