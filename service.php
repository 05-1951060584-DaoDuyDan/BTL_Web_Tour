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
                    <th scope="col">Xóa dịch vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * from tb_tourservice";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {