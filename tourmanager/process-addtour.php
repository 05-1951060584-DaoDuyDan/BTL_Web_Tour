<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST['btnaddtour'])) {
        require('partials-front/header.php');
        $sqlstatustour = "Select* from tb_touroperator, tb_user where tb_user.id_user = tb_touroperator.id_user and tb_user.email = '{$user}'";
        $resultstatustour =  mysqli_query($conn, $sqlstatustour);
        if (mysqli_num_rows($resultstatustour) > 0) {
            $row = mysqli_fetch_assoc($resultstatustour);
        }
        $tour_code = $_POST['tour_code'];
        $typetour = $_POST['typetour'];
        $nametour = $_POST['nametour'];
        $startlocation = $_POST['startlocation'];
        $endlocation = $_POST['endlocation'];
        $numberofdays = $_POST['numberofdays'];
        $tourinfo = $_POST['tourinfo'];
        if ($tourtragop = $_POST['inlineRadioOptions'] == "option1") {
            $tourinstallemnt = 1;
        } else {
            $tourinstallemnt = 0;
        }
        $tourdiscount = $_POST['tourdiscount'];
        $quydinhtour = $_POST['quydinhtour'];
        $khuyenmaitour = $_POST['khuyenmaitour'];
        $chinhsachtour = $_POST['chinhsachtour'];
        $sqladdtour = "Insert into tb_tour Values('{$tour_code}','{$nametour}','{$startlocation}','{$endlocation}',{$numberofdays},{$tourdiscount}, '{$tourinfo}', {$tourinstallemnt} ,'{$quydinhtour}','{$khuyenmaitour}','{$chinhsachtour}', 0, 0, {$_POST['typetour']}, {$row['id_touroperator']})";
        if (mysqli_query($conn, $sqladdtour)) {
        } else {
            // header("location: add-tour.php");
        }

        $sqlstatustour = "Select* from tb_touroperator, tb_user, tb_tour where tb_user.id_user = tb_touroperator.id_user and tb_user.email = '{$user}' and tour_code = '{$tour_code}'";
        $resultstatustour =  mysqli_query($conn, $sqlstatustour);
        if (mysqli_num_rows($resultstatustour) > 0) {
            $row = mysqli_fetch_assoc($resultstatustour);
        }
        mkdir("../images/Tour/" . $tour_code);
    } else if (isset($_POST['themthongtintour']) || isset($_GET['tourcode'])) {
        require('partials-front/header.php');
        require_once "../classprocessSQL.php";
        require_once "../process-string.php";
        $ps = new Process();
        if (isset($_POST['themthongtintour']))
            $tour_code = $_POST['tour_code_update'];
        else
            $tour_code = $_GET['tourcode'];
        $sqlinfotour = "Select* from tb_tour, tb_typetour where tour_code = '{$tour_code}' and tb_tour.id_typetour = tb_typetour.id_typetour";
        $resultinfotour =  mysqli_query($conn, $sqlinfotour);
        $rowinfotour = mysqli_fetch_assoc($resultinfotour);
    } else {
        header("location: tourmanager.php");
    }
?>
    <div class="container" style="margin-top: 72px;">
        <div class="mt-2 mb-2">
            <a href="process-addtour.php" class="text-decoration-none d-flex align-items-center"><span class="material-icons">
                    arrow_back
                </span> <span>Quay lại</span> </a>
        </div>
        <div class="bg-secondary rounded shadow-sm p-2 mb-2 text-white">
            <h5>Mã tour: <?php echo $tour_code ?></h5>
            <input type="text" readonly style="display: none;" id="tourcodemainde" value="<?php echo $tour_code ?>">
            <h5>Tên Tour: <?php echo $rowinfotour['nametour'] ?></h5>
            <h5>Số ngày du lịch: <?php echo $rowinfotour['numberofdays'] ?></h5>
            <?php
            if ($rowinfotour['status_tour'] == 1) {
            ?>
                <form action="process-statustour.php?tourcode=<?php echo $tour_code ?>&statuslock=1" method="POST">
                    <button class="btn btn-primary" type="submit">Ngừng Hoạt Động Du Lịch Cho Tour</button>
                </form>
            <?php
            } else {
            ?>
                <form action="process-statustour.php?tourcode=<?php echo $tour_code ?>&status=0" method="POST">
                    <button class="btn btn-primary" type="submit">Mở Hoạt Động Du Lịch Cho Tour</button>
                </form>
            <?php
            }
            ?>

        </div>
        <div class="row">
            <div class="col-md">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="true">Thông tin tour du lịch</button>
                        <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Thông tin ngày du lịch</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ảnh tour</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Ngày khởi hành của tour</button>
                        <button class="nav-link" id="nav-service-tab" data-bs-toggle="tab" data-bs-target="#nav-service" type="button" role="tab" aria-controls="nav-service" aria-selected="false">Dịch vụ của Tour</button>
                        <button class="nav-link" id="nav-booking-tab" data-bs-toggle="tab" data-bs-target="#nav-booking" type="button" role="tab" aria-controls="nav-booking" aria-selected="false">Quản lý đặt Tour</button>
                        <button class="nav-link" id="nav-booking-tab" data-bs-toggle="tab" data-bs-target="#nav-tablebooking" type="button" role="tab" aria-controls="nav-tablebooking" aria-selected="false">Danh sách người đặt Tour</button>
                    </div>
                </nav>
                <!-- Chỉnh sửa hoạt động từng ngày của tour -->
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                        <form action="process-updatetour.php" method="POST" class="form-control mt-3" accept-charset="utf-8" onsubmit="return accept()">
                            <div>
                                <button class="btn btn-primary rounded-pill" id="capnhatthongtin" type="button">Cập nhật thông tin</button>
                                <button class="btn btn-primary rounded-pill" id="cancelupdate" type="button">Hủy Cập Nhật</button>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <span class="me-2 fw-bold fs-1">Mã tour của bạn: </span>
                                <input class="form-control mt-2" name="tour_codeupdate" value="<?php echo $tour_code; ?>" style="max-width: 150px;" readonly>
                            </div>
                            <div class="mt-3 tourdisplaynone" style="display: none;">
                                <select class="form-select" aria-label="Default select example" id="typetour" name="typetour" required>
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
                            </div>
                            <div>
                                <div class="displayblocktour">
                                    <div class="col-md me-1 mt-3">
                                        <label for="exampleInputEmail1" class="form-label fw-bold">Loại tour của bạn</label>
                                        <input type="text" class="form-control" id="typetournotupdate" value="<?php echo $rowinfotour['nametypetour'] ?>" aria-describedby="emailHelp" name="typetournotupdate" required readonly>
                                    </div>
                                </div>
                                <div class="col-md me-1 mt-3">
                                    <label for="exampleInputEmail1" class="form-label fw-bold">Tên tour của bạn</label>
                                    <input type="text" class="form-control informationtourupdate" id="" aria-describedby="emailHelp" value="<?php echo $rowinfotour['nametour'] ?>" name="nametourupdate" required readonly>
                                </div>
                            </div>
                            <div class="col-md d-flex flex-row mt-3">
                                <div class="col-md-6 me-1">
                                    <label for="exampleInputEmail1" class="form-label fw-bold">Địa Điểm Bắt Đầu</label>
                                    <input type="text" class="form-control informationtourupdate" name="startlocationupdate" value="<?php echo $rowinfotour['startinglocation'] ?>" aria-describedby="emailHelp" required readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label fw-bold">Địa Điểm Kết Thúc</label>
                                    <input type="text" class="form-control informationtourupdate" name="endlocationupdate" value="<?php echo $rowinfotour['endinglocation'] ?>" id="" aria-describedby="emailHelp" required readonly>
                                </div>
                            </div>
                            <div class="col-md mt-3">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label fw-bold">Số ngày thực hiện chuyến đi</label>
                                    <input type="text" class="form-control informationtourupdate" name="numberofdaysupdate" value="<?php echo $rowinfotour['numberofdays'] ?>" aria-describedby="emailHelp" required readonly>
                                </div>
                                <div class="mt-3">
                                    <div class="form-floating">
                                        <p class="fw-bold">Mô tả tour của bạn</p>
                                        <textarea class="form-control informationtourupdate" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 250px;" name="tourinfoupdate" required readonly><?php echo $rowinfotour['tourinfo'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mt-3 tourdisplaynone" style="display: none;">
                                    <label class="fw-bold">Tour có cho phép trả góp hay không?</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptionse" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Trả góp</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptionse" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Không trả góp</label>
                                    </div>
                                </div>
                                <?php
                                if ($rowinfotour['installment']) {
                                    $infoinstallemnt = "Tour cùa bạn có hỗ trợ trả góp";
                                } else {
                                    $infoinstallemnt = "Tour cùa bạn không hỗ trợ trả góp";
                                }
                                ?>
                                <div class="col-md-6 mt-3 displayblocktour">
                                    <label for="exampleInputEmail1" class="form-label fw-bold">Tour Trả Góp</label>
                                    <input type="text" class="form-control" name="tourtragop" aria-describedby="emailHelp" value="<?php echo $infoinstallemnt ?>" required readonly>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="exampleInputEmail1" class="form-label fw-bold">Khuyến mãi của Tour</label>
                                    <input type="text" class="form-control informationtourupdate" name="tourdiscountupdate" value="<?php echo $rowinfotour['tourdiscount'] ?>" aria-describedby="emailHelp" required readonly>
                                </div>
                                <div class="mt-3">
                                    <div class="form-floating">
                                        <p class="fw-bold">Quy định riêng về tour của bạn(Mỗi câu cách nhau bằng 1 dấu chấm)</p>
                                        <textarea class="form-control informationtourupdate" style="height: 250px;" name="quydinhtourupdate" required readonly><?php echo $rowinfotour['tourregulations'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="form-floating">
                                        <p class="fw-bold">Khuyến mãi tour của bạn(Mỗi câu cách nhau bằng 1 dấu chấm)</p>
                                        <textarea class="form-control informationtourupdate" readonly placeholder="Leave a comment here" id="floatingTextarea2" style="height: 250px;" name="khuyenmaitourupdate" required><?php echo $rowinfotour['conditiontour'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="form-floating">
                                        <p class="fw-bold">Chính sách riêng tư tour của bạn(Mỗi câu cách nhau 1 dấu chấm)</p>
                                        <textarea class="form-control informationtourupdate" readonly placeholder="Leave a comment here" id="floatingTextarea2" style="height: 250px;" name="chinhsachtourupdate" required><?php echo $rowinfotour['tourdepartureschedule'] ?></textarea>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="text-danger mt-3 mb-2" id="errorInput"></h6>
                                </div>
                                <div class="mt-3 d-flex justify-content-center">
                                    <button class="btn btn-primary" type="submit" id="smUpdateTour" name="smUpdateTour" style="display: none;">Xác Nhận Cập Nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="bg-white rounded shadow-sm mt-5 col-md-12">
                            <?php
                            $sql1 = "SELECT day, location, morning, noon, afternoon, night, numberofdays, imgday from tb_tourday, tb_tour where tb_tour.tour_code = '{$tour_code}' and tb_tourday.tour_code = tb_tour.tour_code";
                            $result =  mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result) >= 0) {
                                if (mysqli_num_rows($result) > 0) {
                            ?>
                                    <div class="infotourday">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Ngày thứ</th>
                                                    <th scope="col">Địa điểm</th>
                                                    <th scope="col">Buổi sáng</th>
                                                    <th scope="col">Buổi trưa</th>
                                                    <th scope="col">Buổi chiều</th>
                                                    <th scope="col">Buổi tối</th>
                                                    <th scope="col">Ảnh</th>
                                                    <th scope="col">Sửa</th>
                                                    <th scope="col">Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <td scope="row"><?php echo $row['day']; ?></td>
                                                        <td><?php echo $row['location']; ?></td>
                                                        <td><?php echo $row['morning']; ?></td>
                                                        <td><?php echo $row['noon']; ?></td>
                                                        <td><?php echo $row['afternoon']; ?></td>
                                                        <td><?php echo $row['night']; ?></td>
                                                        <td><img src="data:image/png;base64, <?php echo base64_encode($row['imgday']) ?>" style="max-height: 100px; width: 100px" alt=""></td>
                                                        <td><a data-bs-toggle="modal" data-bs-target="#edittourday" class="edittourday" id_service="<?php echo $row['day']; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                                        <td><a data-bs-toggle="modal" data-bs-target="#deletetourday" class="deletetourday" id_service="<?php echo $row['day']; ?>"><i class="bi bi-trash"></i></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Chỉnh sửa thông tin những ngày của tour -->
                                    <!-- Button trigger modal -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="edittourday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin cho địa điểm dừng chân</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="process-updatetourday.php" method="POST" class="form-control">
                                                        <input type="text" class="tourcodeupdate" value="<?php echo $tour_code ?>" style="display: none;">
                                                        <div class="col-md me-1 mt-3">
                                                            <label for="exampleInputEmail1" class="form-label fw-bold">Ngày du lịch thứ</label>
                                                            <input type="text" class="form-control" id="dayupdate" aria-describedby="emailHelp" name="dayupdate" readonly required>
                                                        </div>
                                                        <div class="col-md me-1 mt-3">
                                                            <label class="form-label fw-bold">Nhập địa điểm dừng chân bạn muốn chỉnh sửa</label>
                                                            <input type="text" class="form-control" id="nametourdayupdate" aria-describedby="emailHelp" name="nametourdayupdate" required>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="form-floating">
                                                                <b>Chỉnh sửa thông tin buổi sáng tại địa điểm(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="morningtourupdate" style="height: 100px" name="morningtourupdate" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="form-floating">
                                                                <b>Chỉnh sửa thông tin buổi trưa tại địa điểm(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="noonupdate" style="height: 100px" name="noonupdate" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="form-floating">
                                                                <b>Chỉnh sửa thông tin buổi chiều tại địa điểm(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="afternoonupdate" style="height: 100px" name="afternoonupdate" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="form-floating">
                                                                <b>Chỉnh sửa thông tin buổi tối tại địa điểm(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="nightupdate" style="height: 100px" name="nightupdate" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="form-floating">
                                                                <input type="file" class="form-control-file d-block" id="imgDayUpdate" name="imgDayUpdate">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <button class="btn btn-primary mt-1 rounded-pill" data-bs-dismiss="modal" id="btnupdatedayoftour" type="button" name="btnupdatedayoftour">Chỉnh sửa thông tin</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->

                                    <!-- Modal xóa ngày du lịchs -->
                                    <div class="modal fade" id="deletetourday" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title daydeleted" id="staticBackdropLabel">Xóa thông tin ngày du lịch của Tour</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="process-deletetourday.php" method="POST">
                                                    <div class="modal-body">
                                                        <span>Bạn có chắc chắn muốn xóa thông tin ngày du lịch thứ </span>
                                                        <span class="daydelete"></span>
                                                        <input type="text" name="daydeleteout" class="daydeleteout" readonly style="display: none;">
                                                        <input type="text" name="tourcodedelete" value="<?php echo $tour_code ?>" readonly style="display: none;">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                                        <button type="submit" name="btnDeleteDay" class="btn btn-primary">Xóa</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                        </div>
                        <?php
                                $sql1 = "SELECT numberofdays from tb_tour where tour_code = '{$tour_code}'";
                                $result1 =  mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_assoc($result1);
                                if (mysqli_num_rows($result) < $row1['numberofdays'] || !mysqli_num_rows($result)) {
                        ?>
                            <!-- Thêm thông tin -->
                            <div class="col-md-8">
                                <h4 class="mt-5">Thông tin về ngày tour của bạn đang bị thiếu vui lòng nhập thêm để hoàn tất thông tin!</h4>
                                <form action="process-addtourday.php?tourcode=<?php echo $tour_code; ?>" enctype="multipart/form-data" method="POST" class="form-control">

                                    <div class="col-md me-1 mt-3">
                                        <label for="exampleInputEmail1" class="form-label fw-bold">Ngày bạn muốn nhập</label>
                                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="day" required>
                                    </div>
                                    <div class="col-md me-1 mt-3">
                                        <label class="form-label fw-bold">Nhập địa điểm dừng chân tại ngày bạn đang thiếu</label>
                                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="nametourday" required>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-floating">
                                            <b>Buổi sáng tại địa điểm của ngày bạn đang thiếu(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="morningtour" required></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-floating">
                                            <b>Buổi trưa tại địa điểm của ngày bạn đang thiếu(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="noonofday" required></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-floating">
                                            <b>Buổi chiều tại địa điểm của ngày bạn đang thiếu(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="afternoonofday" required></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-floating">
                                            <b>Buổi tối tại địa điểm thứ của ngày bạn đang thiếu(Mỗi câu cách nhau bằng 1 dấu chấm)</b>
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="nightofday" required></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-floating">
                                            <input type="file" class="form-control-file d-block" id="imgDayNM" name="imgDayNM">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button class="btn btn-primary mt-1 rounded-pill" type="submit" name="btndayoftour">Thêm thông tin</button>
                                    </div>
                                </form>
                            </div>

                    <?php
                                }
                            }
                    ?>
                    <!-- Chỉnh sửa file của Tour -->
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" name="fileInfo">
                        <form method="POST" enctype="multipart/form-data" action="process-uploadimages.php">
                            <div class="col-md-6 mb-3 mt-2">
                                <h4 for="formFileMultiple" class="form-label">Tải lên nhiều ảnh cho Tour</h4>
                                <div class="form-group mb-3">
                                    <label for="image_hotel" class="form-label">Example file input</label>
                                    <input type="file" class="form-control-file d-block" id="tour_images" name="tour_images">
                                </div>
                                <input type="text" class="form-control" value="<?php echo $tour_code; ?>" style="display: none;" id="my_name_tour" name="my_name_tour">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="button" name="btnuploadimages" id="btnuploadimages">Tải lên</button>
                            </div>
                            <div class="status alert alert-success"></div>
                        </form>
                        <div class="col-md-9 mt-5">
                            <h5 id="title-images">Thư viện ảnh tour của bạn</h5>
                            <div class="row me-auto" id="my_images_tour">
                                <?php
                                $sql2 = "Select* from tb_tourimages where tour_code = '" . $tour_code . "'";
                                $result1 =  mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result1) > 0) {
                                    for ($i = 0; $i < mysqli_num_rows($result1); $i++) {
                                        $row1 = mysqli_fetch_assoc($result1);
                                        $images = $row1['images_part'];
                                ?>
                                        <div class="col-md-3 me-2 mb-3">
                                            <div class="card">
                                                <img src="data:image/png;base64, <?php echo base64_encode($images) ?>" class="card-img-top img-fluid" alt="...">
                                                <div class="card-body">
                                                    <a data-bs-toggle="modal" data-bs-target="#deleteimagesday" class="btn btn-primary deleteimages">Xóa ảnh ID:<?php echo $row1['id_imagestour'] ?></a>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="modal fade" id="deleteimagesday" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Xóa ảnh của Tour</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form>
                                            <div class="modal-body">
                                                <span>Bạn có chắc chắn muốn xóa ảnh này của Tour? ID ảnh: </span>
                                                <span class="imgdelete"></span>
                                                <!-- <input type="text" name="idImagesDelete" class="idImagesDelete" readonly style="display: none;"> -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                                <button type="button" name="btnDeleteImages" data-bs-dismiss="modal" id="btnDeleteImages" class="btn btn-primary">Xóa</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $sqlx = "SELECT numberofdays from tb_tour where tour_code = '{$tour_code}'";
                    $resultx =  mysqli_query($conn, $sqlx);
                    $rowx = mysqli_fetch_assoc($resultx);
                    ?>
                    <!-- Chỉnh sửa những chuyến tour của tour -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row mt-5 rounded shadow-sm" style="margin-left: -4px; margin-right: -4px;">
                            <div class="col-md-12 bg-white rounded shadow-sm mb-2 p-1">
                                <h5>Thêm thông tin những chuyến đi của tour</h5>
                            </div>
                            <div class="col-md-12 bg-white rounded shadow-sm mb-2 p-1">
                                <h5>Danh sách những chuyến đi sắp tới của Tour</h5>
                                <form class="row g-3" method="POST" action="process-addstartendday.php" onsubmit="return false">
                                    <!-- method="POST" action="process-addstartendday.php" onsubmit=""-->
                                    <div class="col-md-6">
                                        <label for="startDay" class="form-label">Nhập ngày khởi hành:</label>
                                        <input type="date" name="startDay" class="form-control" id="startDay" value="" required>
                                        <small id="check-startday"></small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="endDay" class="form-label">Nhập ngày kết thúc:</label>
                                        <input type="date" name="endDay" class="form-control" id="endDay" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="adultPrice" class="form-label">Nhập giá vé cho người lớn:</label>
                                        <input type="text" name="adultPrice" class="form-control" id="adultPrice" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="childPrice" class="form-label">Nhập giá vé cho trẻ em:</label>
                                        <input type="text" name="childPrice" class="form-control" id="childPrice" value="" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="vat" class="form-label">Nhập VAT:</label>
                                        <input type="text" name="vat" class="form-control" id="vat" value="" required>
                                    </div>
                                    <input type="text" style="display: none;" value="<?php echo $rowx['numberofdays'] ?>" id="nbofdays">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary" name="btnAddSEDay" id="btnAddSEDay">Hoàn Tất Đăng Ký</button>
                                    </div>
                                </form>
                                <p class="informationadd"></p>
                                <div class="inforeturn">
                                    <table class="table bg-secondary text-warning mt-3 mb-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">Mã ngày du lịch</th>
                                                <th scope="col">Ngày khởi hành</th>
                                                <th scope="col">Ngày kết thúc</th>
                                                <th scope="col">Giá vé cho người lớn</th>
                                                <th scope="col">Giá vé cho trẻ em</th>
                                                <th scope="col">VAT</th>
                                                <th scope="col">Sửa</th>
                                                <th scope="col">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sqltourseday = "Select* from tb_startendday where tour_code = '{$tour_code}' and startday >= CURDATE() and status_startendday = 1 ORDER by startday";
                                            //$sqltourseday = "Select* from tb_startendday where tour_code = '{$tour_code}' order by startday;";
                                            $resultseday = mysqli_query($conn, $sqltourseday);
                                            if (mysqli_num_rows($resultseday)) {
                                                for ($i = 0; $i < mysqli_num_rows($resultseday); $i++) {
                                                    $rowseday = mysqli_fetch_assoc($resultseday);
                                            ?>
                                                    <tr>
                                                        <td><?php echo $rowseday['id_startendday'] ?></td>
                                                        <td scope="row"><?php echo $rowseday['startday'] ?></td>
                                                        <td><?php echo $rowseday['endday'] ?></td>
                                                        <td><?php echo $rowseday['adultprice'] ?></td>
                                                        <td><?php echo $rowseday['childprice'] ?></td>
                                                        <td><?php echo $rowseday['vat'] ?></td>
                                                        <td><a data-bs-toggle="modal" data-bs-target="#editSEDay" class="editSEDay"><i class="bi bi-pencil-square text-warning"></i></a></td>
                                                        <td><a data-bs-toggle="modal" data-bs-target="#deleteSEDay" class="deleteSEDaybtn"><i class="bi bi-trash text-warning"></i></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Modal edit chuyến đi của Tour -->
                            <div class="modal fade" id="editSEDay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Sửa thông tin chuyến đi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST" action="process-updatestartendday.php">
                                                <div class="col-md-12">
                                                    <label for="idSEDayUpdate" class="form-label">Mã ngày du lịch sẽ được cập nhật:</label>
                                                    <input type="text" name="idSEDayUpdate" id="idSEDayUpdate" class="form-control" readonly value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="startDayUpdate" class="form-label">Cập nhật ngày khởi hành:</label>
                                                    <input type="date" name="startDayUpdate" class="form-control" id="startDayUpdate" value="" required>
                                                    <small id="check-startdayUpdate"></small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="endDayUpdate" class="form-label">Cập nhật ngày kết thúc:</label>
                                                    <input type="date" name="endDayUpdate" class="form-control" id="endDayUpdate" value="" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="adultPriceUpdate" class="form-label">Cập nhật giá vé cho người lớn:</label>
                                                    <input type="text" name="adultPriceUpdate" class="form-control" id="adultPriceUpdate" value="" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="childPriceUpdate" class="form-label">Cập nhật giá vé cho trẻ em:</label>
                                                    <input type="text" name="childPriceUpdate" class="form-control" id="childPriceUpdate" value="" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="vatUpdate" class="form-label">Cập nhật VAT:</label>
                                                    <input type="text" name="vatUpdate" class="form-control" id="vatUpdate" value="" required>
                                                </div>
                                                <p class="infomationupdate"></p>
                                                <input type="text" style="display: none;" value="<?php echo $rowx['numberofdays'] ?>" id="nbofdays">
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <button type="button" class="btn btn-primary" name="btnUpdateSEDay" id="btnUpdateSEDay">Hoàn Tất Cập Nhật</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary closeupdate" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary closeupdate" data-bs-dismiss="modal">Xong</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal xóa chuyến đi của tour -->
                            <div class="modal fade" id="deleteSEDay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Xóa thông tin chuyến đi của Tour</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="process-deletetourday.php" method="POST">
                                            <div class="modal-body">
                                                <span>Bạn có chắc chắn muốn xóa thông tin chuyến đi có id: </span>
                                                <span class="SEDayDelete"></span>
                                                <input type="text" name="seddelete" class="seddelete" readonly style="display: none;">
                                                <input type="text" name="tourcodedelete" value="<?php echo $tour_code ?>" readonly style="display: none;">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                                                <button type="button" name="btnDeleteSEDay" data-bs-dismiss="modal" id="btnDeleteSEDay" class="btn btn-primary">Xóa</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab">
                        <form class="row g-3 bg-white p-2 mt-3 rounded shadow-sm" method="POST" action="process-updatestartendday.php">
                            <h4>Thêm dịch vụ cho Tour của bạn</h4>
                            <div class="col-md-6">
                                <label for="nameService" class="form-label">Tên dịch vụ</label>
                                <input type="text" name="nameService" class="form-control" id="nameService" value="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="priceService" class="form-label">Giá dịch vụ</label>
                                <input type="text" name="priceService" class="form-control" id="priceService" value="" required>
                            </div>
                            <div class="col-md-6">
                                <small class="inforAddService"></small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary addTourService">Thêm dịch vụ</button>
                            </div>
                        </form>
                        <div id="tourServiceTable">
                            <table class="table mt-2 bg-white shadow-sm rounded">
                                <h4 class="mt-2">Danh sách các dịch vụ của Tour</h4>
                                <thead>
                                    <tr>
                                        <th scope="col">Mã dịch vụ</th>
                                        <th scope="col">Tên dịch vụ</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Sửa</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <?php
                                $tourservice = $ps->getTourServive($tour_code);
                                ?>
                                <tbody>
                                    <?php
                                    if ($tourservice != false) {
                                        for ($i = 0; $i < count($tourservice); $i++) {
                                            $rowservice = $tourservice[$i];
                                    ?>
                                            <tr>
                                                <td scope="row"><?php echo $rowservice['id_tourservice'] ?></td>
                                                <td><?php echo $rowservice['nameservice'] ?></td>
                                                <td><?php echo $rowservice['priceservice'] ?></td>
                                                <td><i class="bi bi-pencil-square text-warning updateTourServiceClick" data-bs-toggle="modal" data-bs-target="#editServiceTour"></i></td>
                                                <td><i class="bi bi-trash text-warning deleteTourServiceClick" data-bs-toggle="modal" data-bs-target="#deleteTourService"></i></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="editServiceTour" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Chỉnh sửa dịch vụ của Tour</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3 bg-white p-2 mt-3 rounded shadow-sm" method="POST" action="process-updatestartendday.php">
                                            <div class="col-md-12">
                                                <label for="nameService" class="form-label">Mã dịch vụ</label>
                                                <input type="text" name="idTourServiceUpdate" class="form-control" readonly id="idTourServiceUpdate" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nameService" class="form-label">Tên dịch vụ</label>
                                                <input type="text" name="nameServiceUpdate" class="form-control" id="nameServiceUpdate" value="" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="priceService" class="form-label">Giá dịch vụ</label>
                                                <input type="text" name="priceServiceUpdate" class="form-control" id="priceServiceUpdate" value="" required>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                        <button type="button" class="btn btn-primary updateTourService" data-bs-dismiss="modal">Chỉnh sửa</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteTourService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa dịch vụ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có muốn xóa dịch vụ có mã dịch vụ = <span class="idservicedelete"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                        <button type="button" class="btn btn-primary commitDeleteService" data-bs-dismiss="modal">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-booking" role="tabpanel" aria-labelledby="nav-booking-tab">
                        <div class="listTourBookingCho">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã đặt tour</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Ngày đặt Tour</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Mã Tour</th>
                                        <th scope="col">Ngày khởi hành</th>
                                        <th scope="col">Phê duyệt</th>
                                        <th scope="col">Xem chi tiết</th>
                                        <th scope="col">Hủy Booking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($ps->getBookingTourChoOperator($tour_code) != false) {
                                        $rowBookingTourUser = $ps->getBookingTourChoOperator($tour_code);
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
                                                <td class="text-center text-primary PDBKT" data-bs-toggle="modal" data-bs-target="#approveBookingTour"><i class="bi bi-check2"></i></td>
                                                <td class="text-center text-primary clickinformation1" data-bs-toggle="modal" data-bs-target="#informationBookingTour"><a href="#"><i class="bi bi-info-circle"></i></a></td>
                                                <td class="text-center text-primary deleteBKTE" data-bs-toggle="modal" data-bs-target="#deleteBookingTour"><i class="bi bi-x-lg"></i></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <small id="helpinfo"></small>
                        <!-- Chấp nhận đơn đặt Tour -->
                        <div class="modal fade" id="approveBookingTour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Phê duyệt đặt Tour</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <p>Bạn có muốn phê duyệt đơn đặt Tour <span class="idBookingTour"></span>này không?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" name="submitapproveBKT" data-bs-dismiss="modal" id="submitapproveBKT" class="btn btn-primary">Phê duyệt</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Hủy đặt Tour -->
                        <div class="modal fade" id="deleteBookingTour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hủy đặt Tour</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <p>Bạn có muốn hủy đơn đặt tour <span class="idBookingTours"></span> này không?</p>
                                            <input type="text" name="idBookingTourVal" class="idBookingTourVal" style="display: none;">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="button" name="submitDeleteBKT" id="submitDeleteBKT" data-bs-dismiss="modal" class="btn btn-primary">Hủy</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-tablebooking" role="tabpanel" aria-labelledby="nav-tablebooking-tab">
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
                                if ($ps->getBookingTourHTOperator($tour_code) != false) {
                                    $rowBookingTourUser = $ps->getBookingTourHTOperator($tour_code);
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
                                            <td class="text-center text-primary clickinformation1" data-bs-toggle="modal" data-bs-target="#informationBookingTour"><a href="#"><i class="bi bi-info-circle"></i></a></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="inforbook">
                        <div class="modal fade" id="informationBookingTour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết đơn đặt Tour</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
    </body>

    </html>
<?php
}
?>