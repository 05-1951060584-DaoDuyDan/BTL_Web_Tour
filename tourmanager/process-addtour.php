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

                    </div>
                    <!-- Chỉnh sửa file của Tour -->
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