<?php include('partials-front/header.php')
    // session_start(); //Dịch vụ bảo vệ
    // if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
    //     header("Location:../login.php");
    // }
    //     include '../config.php';
?>

<body >
    <div class="container ">
        <a href="add-room.php" class="btn btn-success m-2">Thêm Tour</a>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên người điều hành</th>
                        <th scope="col">Loại hình kinh doanh</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ảnh người điều hành</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Email liên kết</th>
                        <th scope="col">Liên kết vào</th>
                        <th scope="col">Trang</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Mở</th>
                    </tr>