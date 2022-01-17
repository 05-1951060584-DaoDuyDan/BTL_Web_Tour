<?php
session_start();
if (!isset($_SESSION['LoginOK'])) {
    header('location: index.php');
} else {
    // session_destroy();
    session_write_close();
    require('.//partials-front/header.php');
    $ps = new Process();
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
                        <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done" type="button" role="tab" aria-controls="done" aria-selected="false">Hoàn thành</button>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đặt tour</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Ngày đặt Tour</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Mã Tour</th>
                                    <th scope="col">Ngày khởi hành</th>
                                    <th scope="col">Xem chi tiết</th>
                                    <th scope="col">Hủy đặt Tour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ps->getBookingTourChoUser($row['id_user']) != false) {
                                    $rowBookingTourUser = $ps->getBookingTourChoUser($row['id_user']);
                                    for ($i = 0; $i < count($rowBookingTourUser); $i++) {
                                        $rowbooking = $rowBookingTourUser[$i];
                                        $rowseday = $ps->getStartEndDay($rowbooking['id_startendday']);
                                ?>
                                        <tr>
                                            <td scope="row"><?php echo $rowbooking['code_bookingtour'] ?></td>
                                            <td><?php echo ps_price($rowbooking['totalmoney']) ?></td>
                                            <td><?php echo $rowbooking['tourbookingdate'] ?></td>
                                            <td>Chờ phê duyệt</td>
                                            <td><?php echo $rowbooking['tour_code'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($rowseday['startday'])) ?></td>
                                            <td class="text-center text-primary"><i class="bi bi-info-circle"></i></td>
                                            <td class="text-center deleteBKT"><a href="" data-bs-toggle="modal" data-bs-target="#deleteBookingTour"><i class="bi bi-x-lg"></i></a></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteBookingTour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hủy đặt Tour</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="process-deleteBookingTour.php" method="post">
                                        <div class="modal-body">
                                            <p>Bạn có muốn hủy đơn đặt tour <span class="idBookingTour"></span></p>
                                            <input type="text" name="idBookingTourVal" class="idBookingTourVal" style="display: none;">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" name="submitDeleteBKT" class="btn btn-primary">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đặt tour</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Ngày đặt Tour</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Mã Tour</th>
                                    <th scope="col">Ngày khởi hành</th>
                                    <th scope="col">Xem chi tiết</th>
                                    <th scope="col">Hoàn thành và đánh giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ps->getBookingTourDPVUser($row['id_user']) != false) {
                                    $rowBookingTourUser = $ps->getBookingTourDPVUser($row['id_user']);
                                    for ($i = 0; $i < count($rowBookingTourUser); $i++) {
                                        $rowbooking = $rowBookingTourUser[$i];
                                        $rowseday = $ps->getStartEndDay($rowbooking['id_startendday']);
                                ?>
                                        <tr>
                                            <td scope="row"><?php echo $rowbooking['code_bookingtour'] ?></td>
                                            <td><?php echo ps_price($rowbooking['totalmoney']) ?></td>
                                            <td><?php echo $rowbooking['tourbookingdate'] ?></td>
                                            <td>Đang phục vụ</td>
                                            <td><?php echo $rowbooking['tour_code'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($rowseday['startday'])) ?></td>
                                            <td class="text-center text-primary"><i class="bi bi-info-circle"></i></td>
                                            <?php
                                            if (date('d/m/Y', strtotime($rowseday['endday'])) < date("d/m/Y")) {
                                            ?>
                                                <td class="text-center text-primary"><i class="bi bi-pencil-square"></i></i></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Mã đặt tour</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Ngày đặt Tour</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Mã Tour</th>
                                    <th scope="col">Ngày khởi hành</th>
                                    <th scope="col">Xem chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ps->getBookingTourHTUser($row['id_user']) != false) {
                                    $rowBookingTourUser = $ps->getBookingTourHTUser($row['id_user']);
                                    for ($i = 0; $i < count($rowBookingTourUser); $i++) {
                                        $rowbooking = $rowBookingTourUser[$i];
                                        $rowseday = $ps->getStartEndDay($rowbooking['id_startendday']);
                                ?>
                                        <tr>
                                            <td scope="row"><?php echo $rowbooking['code_bookingtour'] ?></td>
                                            <td><?php echo ps_price($rowbooking['totalmoney']) ?></td>
                                            <td><?php echo $rowbooking['tourbookingdate'] ?></td>
                                            <td>Đã hoàn thành</td>
                                            <td><?php echo $rowbooking['tour_code'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($rowseday['startday'])) ?></td>
                                            <td class="text-center text-primary"><i class="bi bi-info-circle"></i></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('.//partials-front/footer.php');
?>