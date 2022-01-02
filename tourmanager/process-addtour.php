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
        $sqladdtour = "Insert into tb_tour Values('{$tour_code}','{$nametour}','{$startlocation}','{$endlocation}',{$numberofdays},{$tourdiscount}, '{$tourinfo}', {$tourinstallemnt} ,'{$quydinhtour}','{$khuyenmaitour}','{$chinhsachtour}', 0, 1, {$row['id_touroperator']})";
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
        if (isset($_POST['themthongtintour']))
            $tour_code = $_POST['tour_code_update'];
        else
            $tour_code = $_GET['tourcode'];
        $sqlinfotour = "Select* from tb_tour where tour_code = '{$tour_code}'";
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
        <div class="bg-secondary rouned shadow-sm p-2 mb-2 text-white">
            <h5>Mã tour: <?php echo $tour_code ?></h5>
            <input type="text" readonly style="display: none" id="tourcodemainde" value="<?php echo $tour_code ?>">
            <h5>Tên Tour: <?php echo $rowinfotour['nametour'] ?></h5>
            <h5>Số ngày du lịch: <?php echo $rowinfotour['numberofdays'] ?></h5>
        </div>
        <div class="row">
            <div class="col-md">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Thông tin ngày du lịch</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ảnh tour</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Ngày khởi hành của tour</button>
                    </div>
                </nav>
                <!-- Chỉnh sửa hoạt động từng ngày của tour -->
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="bg-white rounded shadow-sm mt-5 col-md-12">
                            <?php
                            $sql1 = "SELECT day, location, morning, noon, afternoon, night, numberofdays from tb_tourday, tb_tour where tb_tour.tour_code = '{$tour_code}' and tb_tourday.tour_code = tb_tour.tour_code";
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
                                <form action="process-addtourday.php?tourcode=<?php echo $tour_code; ?>" method="POST" class="form-control">

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
                    </div>
                    <!-- Chỉnh sửa những chuyến tour của tour -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        
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