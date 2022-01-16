<?php
session_start();
if (!isset($_SESSION['LoginOK'])) {
    header('location: index.php');
} else {
    // session_destroy();
    session_write_close();
    require('.//partials-front/header.php');
    $sqltourmanager = "Select* from tb_user where tb_user.email = '{$user}'";
    $result =  mysqli_query($conn, $sqltourmanager);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
}
?>
<div id="main" style="margin-top: 70px;">
    <div class="container">
        <div class="row">
            <div class="col-md-10 ms-auto me-auto">
                <h1 class="title-page">Xin chào: <?php echo $row['surnameuser'] . ' ' . $row['nameuser'] ?></h1>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Thông tin cá nhân</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Đang chờ xác nhận</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Đang phục vụ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="done" aria-selected="false">Hoàn thành</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row bg-white" style="margin-left: 1px">
                            <form class="row g-3 needs-validation" action="process-updateInforUser.php" method="POST" novalidate>
                                <div class="col-md-12">
                                    <!--   -->
                                    <div class="d-flex justify-content-center">
                                        <img src="data:image/png;base64, <?php echo base64_encode($row['imageuser']) ?>" alt="" class="img-fluid" style="max-width: 82px; max-height: 100%">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <b>Ảnh đại diện</b>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Tên</label>
                                    <input type="text" class="form-control" id="nameuser" name="nameuser" value="<?php echo $row['nameuser'] ?>" readonly required>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Họ</label>
                                    <input type="text" class="form-control" id="surnameuser" name="surnameuser" value="<?php echo $row['surnameuser'] ?>" readonly required>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustomUsername" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $row['email'] ?>" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row['phonenumber'] ?>" readonly required>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="button" id="updateInfoUser">Sửa thông tin cá nhân</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="mt-3" id="imgUserUpdate" style="display: none;">
                                        <div class="form-floating">
                                            <input type="file" class="form-control-file d-block" name="imgUserUpdate">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" type="submit" id="submitUpdateUser" name="submitUpdateUser" style="display: none;">Hoàn tất chỉnh sửa</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <?php
                        
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đặt tour</th>
                                    <!-- <th scope="col">Họ</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Giới tính</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Địa chỉ</th> -->
                                    <th scope="col">Số người lớn</th>
                                    <th scope="col">Số trẻ em</th>
                                    <th scope="col">Số trẻ con</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Ngày đặt Tour</th>
                                    <th scope="col">Phương thức thanh toán</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Mã Tour</th>
                                    <th scope="col">Ngày khởi hành</th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Xem chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('.//partials-front/footer.php');
?>