<?php

require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    require('partials-front/header.php');
    $sqltourmanager = "Select* from tb_user, tb_touroperator where tb_user.id_user = tb_touroperator.id_user and tb_user.email = '{$user}'";
    $result =  mysqli_query($conn, $sqltourmanager);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
}

?>
<div id="main" style="margin-top: 66px;">
    <div class="container">
        <div class="row">
            <h1 class="title-page">Xin chào: <?php echo $row['surnameuser'] . ' ' . $row['nameuser'] ?></h1>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Thông tin cá nhân</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tour Của Bạn</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Quản Lý Người Đặt Tour</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md bg-white shawdow-sm mt-3" style="margin-left: -12px;">
                        <div class="col-md-8">
                            <form class="row g-3 needs-validation p-3" novalidate>
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Họ</label>
                                    <input type="text" class="form-control" readonly id="validationCustom01" value="<?php echo $row['surnameuser'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">Tên</label>
                                    <input type="text" class="form-control" readonly id="validationCustom02" value="<?php echo $row['nameuser'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" readonly id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['email'] ?>">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom03" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" readonly id="validationCustom03" value="<?php echo $row['phonenumber'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom04" class="form-label">Tên tour quản lý</label>
                                    <input type="text" class="form-control" readonly id="validationCustom04" value="<?php echo $row['nametouroperator'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom05" class="form-label">Loại hình kinh doanh</label>
                                    <input type="text" class="form-control" readonly id="validationCustom05" value="<?php echo $row['businesstype'] ?>" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row bg-white">
                        <!-- <div class="col-md-12 mb-3" style="margin-left: -12px;">
                                <a href="add-tour.php"><button type="button" class="btn btn-primary mt-3">Thêm Tour Du Lịch</button></a>
                            </div> -->
                        <div class="ms-2 mb-2 mt-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Thêm tour
                            </button>
                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <?php
                                $tourcodenew = strtoupper(substr(md5(rand()), 0, 10));
                                ?>
                                <!-- <div class="modal-dialog" role="document"> -->
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tuyệt vời giờ hãy thiết lập thông tin cho tour của bạn</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="process-addtour.php" method="POST" class="form-control" accept-charset="utf-8">
                                            <div class="d-flex flex-row align-items-center justify-content-between">
                                                <span class="me-2 fw-bold fs-1">Mã tour mới của bạn: </span>
                                                <input class="form-control mt-2" name="tour_code" value="<?php echo $tourcodenew; ?>" style="max-width: 150px;" readonly>
                                            </div>
                                            <div class="mt-3">
                                                <select class="form-select" aria-label="Default select example" name="typetour" required>
                                                    <option selected>Chọn loại tour của bạn</option>
                                                    <?php
                                                    $sqltypetour = "Select* from tb_typetour";
                                                    $resulttypetour = mysqli_query($conn, $sqltypetour);
                                                    if (mysqli_num_rows($resulttypetour)) {
                                                        while ($rowtypetour = mysqli_fetch_assoc($resulttypetour)) {
                                                    ?>
                                                            <option value="<?php echo $rowtypetour['id_typetour'] ?>"><?php echo $rowtypetour['nametypetour'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <option value="1">One</option> -->
                                                </select>
                                                <div class="col-md me-1 mt-3">
                                                    <label for="exampleInputEmail1" class="form-label fw-bold">Nhập tên tour của bạn</label>
                                                    <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="nametour" required>
                                                </div>
                                            </div>
                                            <div class="col-md d-flex flex-row mt-3">
                                                <div class="col-md-6 me-1">
                                                    <label for="exampleInputEmail1" class="form-label fw-bold">Địa Điểm Bắt Đầu</label>
                                                    <input type="text" class="form-control" name="startlocation" aria-describedby="emailHelp" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1" class="form-label fw-bold">Địa Điểm Kết Thúc</label>
                                                    <input type="text" class="form-control" name="endlocation" id="" aria-describedby="emailHelp" required>
                                                </div>
                                            </div>
                                            <div class="col-md mt-3">
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1" class="form-label fw-bold">Số ngày thực hiện chuyến đi</label>
                                                    <input type="text" class="form-control" name="numberofdays" aria-describedby="emailHelp" required>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="form-floating">
                                                        <p class="fw-bold">Mô tả tour của bạn</p>
                                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 250px;" name="tourinfo" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label class="fw-bold">Tour có cho phép trả góp hay không?</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Trả góp</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <label class="form-check-label" for="inlineRadio2">Không trả góp</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label for="exampleInputEmail1" class="form-label fw-bold">Khuyến mãi của Tour</label>
                                                    <input type="text" class="form-control" name="tourdiscount" aria-describedby="emailHelp" required>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="form-floating">
                                                        <p class="fw-bold">Quy định riêng về tour của bạn(Mỗi câu cách nhau bằng 1 dấu chấm)</p>
                                                        <textarea class="form-control" style="height: 250px;" name="quydinhtour" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="form-floating">
                                                        <p class="fw-bold">Khuyến mãi tour của bạn(Mỗi câu cách nhau bằng 1 dấu chấm)</p>
                                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 250px;" name="khuyenmaitour" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="form-floating">
                                                        <p class="fw-bold">Chính sách riêng tư tour của bạn(Mỗi câu cách nhau 1 dấu chấm)</p>
                                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 250px;" name="chinhsachtour" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center mt-3">
                                                <button class="btn btn-primary mt-1 rounded-pill" type="submit" name="btnaddtour">Tiếp Tục Đăng Ký</button>
                                            </div>
                                        </form>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" style="margin-left: 8px;">
                            <?php
                            $sqltour = "Select* from tb_user, tb_touroperator, tb_tour where tb_user.id_user = tb_touroperator.id_user and tb_touroperator.id_touroperator = tb_tour.id_touroperator and tb_user.email = '{$user}'";
                            $resulttour =  mysqli_query($conn, $sqltour);
                            if (mysqli_num_rows($resulttour) > 0) {
                                while ($rowtour = mysqli_fetch_assoc($resulttour)) {
                                    $tour_code = $rowtour['tour_code'];
                                    $nametour = $rowtour['nametour'];
                                    $tourinfo = $rowtour['tourinfo'];
                                    $tourstartinglocation = $rowtour['startinglocation'];
                                    $tourendinglocation = $rowtour['endinglocation'];
                                    $tourstatus = $rowtour["status_tour"];

                            ?>
                                    <div class="col-md-4">
                                        <div class="col-md" style="margin-left: -12px;">
                                            <div class="card">
                                                <img src="../images/Tour/TuanDung/1.png" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $nametour ?></h5>
                                                    <p class="card-text"><?php echo $tourinfo ?></p>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="d-flex flex-inline">
                                                            <span class="material-icons text-primary">
                                                                location_on
                                                            </span>
                                                            <p class="fw-bold ms-3"><?php echo $tourstartinglocation . ' - ' . $tourendinglocation ?></p>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="d-flex flex-inline">
                                                            <span class="material-icons">
                                                                calendar_month
                                                            </span>
                                                            <p class="fw-bold ms-3">Thứ 2, 20/12/2021</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <?php
                                                if ($tourstatus == 1) {
                                                ?>
                                                    <div class="card-body">
                                                        <a href="../informationtour.php?tourcode=<?php echo $tour_code ?>" class="card-link text-decoration-none">Xem Thông Tin Tour</a>
                                                        <a href="process-addtour.php?tourcode=<?php echo $tour_code ?>" class="card-link text-decoration-none">Chỉnh sửa Tour</a><br>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($tourstatus == 0) {
                                                ?>
                                                    <div class="card-body">
                                                        <a href="process-addtour.php?tourcode=<?php echo $tour_code ?>" class="card-link text-decoration-none">Thêm thông tin Tour</a><br>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="col-md bg-white" style="margin-left: -12px;">
                        Ngon
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>