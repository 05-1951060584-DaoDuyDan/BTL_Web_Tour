<?php
    include("partials-front/header.php")
// session_start(); //Dịch vụ bảo vệ
// if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
//     header("Location:../login.php");
// }
// include '../config.php';
?>



<div class="container">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên dịch vụ</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Sửa dịch vụ</th>