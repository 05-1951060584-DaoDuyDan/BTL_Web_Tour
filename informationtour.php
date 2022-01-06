<?php
if ($_GET['tourcode']) {
    $tour_code = $_GET['tourcode'];
    include('partials-front/header.php');
    include('process-string.php');
    $sqlinfotour = "Select* from tb_tour, tb_typetour where tour_code = '{$tour_code}' and tb_tour.id_typetour = tb_typetour.id_typetour";
    $resultinfotour = mysqli_query($conn, $sqlinfotour);
    $rowinfotour = mysqli_fetch_assoc($resultinfotour);
    $sqlSeDay = "Select* from tb_startendday where tour_code = '{$tour_code}' ORDER by startday";
    $resultSeDay = mysqli_query($conn, $sqlSeDay);
    $rowSeDay = mysqli_fetch_assoc($resultSeDay);
    $startday = date('d-m-Y',strtotime($rowSeDay['startday']));
    $endday = date('d-m-Y',strtotime($rowSeDay['endday']));
} else {
    header("location: index.php");
}
?>
<main style="margin-top: 120px; margin-bottom: 200px;">
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 bg-white p-3" style="margin-left:12px">
                <div>
                    <div id="carouselExampleFade" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $sqlimagestour = "Select* from tb_tourimages where tour_code = '{$tour_code}'";
                            $resultimg = mysqli_query($conn, $sqlimagestour);
                            if (mysqli_num_rows($resultimg) > 0) {
                                for ($i = 0; $i < mysqli_num_rows($resultimg); $i++) {
                                    $rowimg = mysqli_fetch_assoc($resultimg);
                                    if ($i == 0) {
                            ?>
                                        <div class="carousel-item active">
                                            <img src="data:image/png;base64, <?php echo base64_encode($rowimg['images_part']) ?>" class="d-block w-100" alt="" />
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="carousel-item">
                                            <img src="data:image/png;base64, <?php echo base64_encode($rowimg['images_part']) ?>" class="d-block w-100" alt="" />
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div>
                    <h5 class="text-warning"><?php echo $rowinfotour['nametypetour'] ?></h5>
                    <h4><?php echo $rowinfotour['nametour'] ?></h4>
                    <div class="d-flex">
                        <div class="">
                            <div class="text-center text-success">
                                <p>Điểm khởi hành</p>
                                <i class="bi bi-geo-alt "></i>
                                <h6 class="text-dark">
                                    <?php echo $rowinfotour['startinglocation'] ?>
                                </h6>
                                <p class="text-secondary"><?php echo $startday ?></p>
                            </div>
                            <div>
                                <p>Mã tour:
                                    T-032558050121-50UZPR</p>
                                <p>Tổng số ngày:
                                    4</p>
                            </div>
                        </div>
                        <div class="f-end ms-auto ">
                            <div class="text-center text-danger">
                                <p>Điểm kết thúc</p>
                                <i class="bi bi-flag"></i>
                                <h6 class="text-dark">
                                    <?php echo $rowinfotour['endinglocation'] ?>
                                </h6>
                                <p class="text-secondary"><?php echo $endday ?></p>
                            </div>

                            <div class="d-flex">
                                <p>Ngày khởi hành:
                                    <?php echo $startday ?></p>
                                <a href="tao4">Thay đổi ngày</a>
                            </div>
                            <p>Ngày kết thúc:
                            <?php echo $endday ?></p>
                        </div>
                    </div>
                </div>
                <div>
                    <hr>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Chi tiết</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Quy định
                                riêng</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Khuyến mãi</button>
                            <button class="nav-link" id="nav-contact1-tab" data-bs-toggle="tab" data-bs-target="#nav-contact1" type="button" role="tab" aria-controls="nav-contact1" aria-selected="false">Chính sách riêng
                                tư</button>
                            <button class="nav-link" id="nav-contact2-tab" data-bs-toggle="tab" data-bs-target="#nav-contact2" type="button" role="tab" aria-controls="nav-contact2" aria-selected="false">Liện hệ</button>
                        </div>
                        <hr>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <?php
                                $sqltourday = "Select* from tb_tourday where tour_code = '{$tour_code}'";
                                $resulttourday = mysqli_query($conn, $sqltourday);
                                $mang = array('One', 'Two', 'Three', 'Four');
                                $i = 0;
                                if (mysqli_num_rows($resulttourday)) {
                                    while ($rowtourday = mysqli_fetch_assoc($resulttourday)) {
                                        $day = $rowtourday['day'];
                                        $location = $rowtourday['location'];
                                        $morning = $rowtourday['morning'];
                                        $noon = $rowtourday['noon'];
                                        $afternoon = $rowtourday['afternoon'];
                                        $night = $rowtourday['night'];
                                ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panelsStayOpen-heading<?php echo $mang[$i] ?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $mang[$i] ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?php echo $mang[$i] ?>">
                                                    <i class="bi bi-geo-alt me-2"></i> Ngày <?php echo $day ?>: <?php echo $location ?><span class="material-icons">
                                                        drive_eta
                                                    </span>
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapse<?php echo $mang[$i] ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?php echo $mang[$i] ?>">
                                                <div class="accordion-body">
                                                    <div class="card mb-3">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <img src="images/Tour/TuanDung/4.png" class="img-fluid rounded-start" alt="...">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body d-flex flex-column">
                                                                    <h6 class="card-title">Sáng:</h6>
                                                                    <p class="card-text"><?php echo $morning ?></p>
                                                                </div>
                                                                <div class="card-body d-flex flex-column">
                                                                    <h6 class="card-title">Trưa:</h6>
                                                                    <p class="card-text"><?php echo $noon ?></p>
                                                                </div>
                                                                <div class="card-body d-flex flex-column">
                                                                    <h6 class="card-title">Chiều:</h6>
                                                                    <p class="card-text"><?php echo $afternoon ?></p>
                                                                </div>
                                                                <div class="card-body d-flex flex-column">
                                                                    <h6 class="card-title">Tối:</h6>
                                                                    <p class="card-text"><?php echo $night ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade tour_information" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="text-center">
                                <img src="images/quydinhr.png" alt="">
                            </div>
                            <div>
                                <?php processString($rowinfotour['tourregulations']) ?>
                            </div>
                        </div>
                        <div class="text-center tour_information tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <img src="images/khuyenmaiformdanang.svg" alt="">
                            <p>Không tìm thấy khuyến mãi nào. Hãy thử lại với lịch trình khác.</p>
                        </div>
                        <div class="tab-pane fade tour_information" id="nav-contact1" role="tabpanel" aria-labelledby="nav-contact1-tab">
                            <div>
                                <?php processString($rowinfotour['tourdepartureschedule']) ?>
                            </div>
                        </div>

                        <div class="tab-pane fade tour_information" id="nav-contact2" role="tabpanel" aria-labelledby="nav-contact2-tab">
                            <p>Thông tin liên hệ đang cập nhật.</p>
                        </div>
                    </div>
                    <hr>
                </div>
                <div>
                    <?php
                    $sqlmonthoftour = "SELECT DISTINCT DATE_FORMAT(startday, '%m/%Y') AS MTour FROM `tb_startendday` WHERE tour_code = '{$tour_code}' ORDER by startday";
                    $resultmonthoftour = mysqli_query($conn, $sqlmonthoftour);
                    ?>
                    <div class="m-2 p-2">
                        <h4 class="mb-3">Chọn tháng khởi hành</h4>
                        <div>
                            <?php
                            while($rowmonthoftour = mysqli_fetch_assoc($resultmonthoftour)){
                            ?>
                                <button class="btn btn-info text-white"><?php echo $rowmonthoftour['MTour'] ?></button>
                            <?php
                            }
                            ?>
                        </div>
                        <h4 class="mt-3">Lịch khởi khành sắp tới</h4>
                    </div>
                    <?php
                    for($i = 0; $i < mysqli_num_rows($resultSeDay); $i++){
                    ?>
                    <div class="card m-2">
                        <div class="d-flex card-body align-items-center justify-content-between">
                            <div class="d-flex flex-row">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="me-4">
                                        <p>Khởi hành</p><!--Thứ 5, 23/12/2021-->
                                        <h6><?php echo $rowSeDay['wdstart'].', '.$startday ?></h6>
                                    </div>
                                    <div class="me-4 d-flex align-items-center">
                                        <span class="material-icons border rounded-pill fw-light">
                                            east
                                        </span>
                                    </div>
                                    <div class="me-5">
                                        <p>Kết thúc</p>
                                        <h6><?php echo $rowSeDay['wdend'].', '.$endday ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div>
                                    <div class="text-center mt-2">
                                        <p class="fs-4 fw-bold text-danger"><?php echo ps_price($rowSeDay['adultprice']) ?></p>
                                    </div>
                                </div>
                                <div class="f-end p-2 ms-auto">
                                    <button type="button" class="tao4 btn btn-info text-white">
                                        Đặt ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($i <= mysqli_num_rows($resultSeDay)-2){
                        $rowSeDay = mysqli_fetch_assoc($resultSeDay);
                        $startday = date('d-m-Y',strtotime($rowSeDay['startday']));
                        $endday = date('d-m-Y',strtotime($rowSeDay['endday']));
                    }
                    }
                    ?>
                </div>
                <div>

                </div>
            </div>
            <!-- Thang ben phai -->
            <div class="col-md-3">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="button" class="btn btn-info rounded-pill text-white">
                        Thay đổi tìm kiếm
                    </button>
                </div>
                <div class="bg-white mt-2 mb-2 p-2 shadow-sm rounded">
                    <h6>Tuấn Dũng Travel</h6>
                    <hr class="col-3" />
                    <span class="material-icons-outlined text-dark">80 người thích trang này
                    </span>
                </div>
                <div class="bg-white rounded p-2 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <h6>Giới thiệu</h6>
                        <a href="" class="text-decoration-none">Chi tiết trang</a>
                    </div>
                    <hr class="col-3" />
                    <i class="bi bi-grid"> Trang du lịch </i>
                </div>
            </div>
        </div>
    </div>
    <section class="container d-flex justify-content-center bg-light fixed-bottom align-items-center p-1">
        <div class="col-md-8">
            <h6>Giá chỉ từ</h6>
            <h3 class="text-danger">1.760.000 ₫</h3>
        </div>
        <div class="col-md-4">
            <button type="button" class="tao4 btn btn-info text-white">
                Đặt ngay
            </button>
            <button type="button" class="tao4 btn btn-secondary text-info">
                Các ngày khởi hành khác
            </button>
        </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>