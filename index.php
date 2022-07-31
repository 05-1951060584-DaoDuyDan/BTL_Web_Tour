<?php
include('.//partials-front/header.php');
require_once "process-string.php";
?>
<head>
    <title>Trang chủ</title>
</head>
<div class="container-fluid" style="margin-top: 66px">
    <div class="row mb-5">
        <!-- Sidebar -->
        <div class="col-md-3 position-fixed" id="sidebar-content">
            <div id="sidebar-index" class="mt-3" style="max-width: 300px">
                <div style="background-color: lightblue;" class="shadow-sm rounded">
                    <div class="sidebar-information mt-3 ms-3">
                        <?php
                        if (isset($_SESSION['LoginOK'])) {
                        ?>
                            <a href="userinformation.php" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-center">
                                    <span class="material-icons my_icon_header me-3">person</span>
                                    <p class="mt-3"><?php $tuser = explode('@', $user); echo $tuser[0].'@' ?></p>
                                </div>
                            </a>
                        <?php
                        } else {
                        ?>
                            <a href="login.php" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-center">
                                    <span class="material-icons my_icon_header me-3">monetization_on</span>
                                    <p class="mt-3">Tài khoản kinh doanh</p>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '1') {
                        ?>
                            <a href="tourmanager/index.php" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-center">
                                    <span class="material-icons my_icon_header me-3">monetization_on</span>
                                    <p class="mt-3">Tài khoản kinh doanh</p>
                                </div>
                            </a>
                        <?php
                        } else if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) != '1') {
                        ?>
                            <a href="tourmanager/business.php" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-center">
                                    <span class="material-icons my_icon_header me-3">monetization_on</span>
                                    <p class="mt-3">Tài khoản kinh doanh</p>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="bg-white wrapper weather-part rounded shawdow-sm mt-3 text-center">
                    <div class="time temp p-2">
                        <h6 class="text-center">Chúc bạn một ngày tốt lành! <?php  ?></h6>
                    </div>
                    <img src="./icon/cloud.svg" alt="">
                    <div class="temp ps-3 pt-3 pe-3 text-center">
                        <span class="numb">13</span>
                        <span class="deg">°C</span>
                    </div>
                    <div class="weather ps-3 pt-3 pe-3 text-center">
                        Cloud
                    </div>
                    <div class="location d-flex justify-content-center">
                        <span class="material-icons">
                            room
                        </span>
                        <span class="address">Ha Noi, Viet Nam</span>
                    </div>
                    <div class="bottom-details d-flex flex-row justify-content-between p-2 border border-radius m-1">
                        <div class="column feels d-flex flex-row align-items-center ">
                            <div>
                                <span class="material-icons text-danger icon-under">
                                    device_thermostat
                                </span>
                            </div>
                            <div class="details">
                                <div class="temp">
                                    <span class="numb-2"></span>
                                    <span class="deg_">°</span>
                                </div>
                                <p>Feels Like</p>
                            </div>
                        </div>
                        <div class="column humidity d-flex flex-row align-items-center">
                            <div>
                                <span class="material-icons text-primary icon-under">
                                    invert_colors
                                </span>
                            </div>
                            <div class="details">
                                <span class="humid">87%</span>
                                <p>Humidity</p>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="images\index\sidebar-img-right.png" alt="" class="img-fluid shadow-sm rounded mb-3 mt-3 sidebar-right-image">
                <div class="bg-white shadow-sm rounded p-2">
                    <p class="fw-bold ms-1 mt-2">Trải nghiệm nổi bật</p>
                    <hr style="max-width: 300px">
                    <img src="images/Tour/DaNang_BaNa_NguHanhSon_HoiAn.png" alt="" class="img-fluid sidebar-right-image shadow-sm rounded">
                </div>
                <div class="row bg-white shadow-sm rounded mt-3 p-2" style="max-width:300px; margin-left:1px">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="col-md-6">
                            <a href=""><img src="images/footer/dadangky.png" alt="" class="img-fluid" style="max-width: 100px; max-height:100%"></a>
                        </div>
                        <div class="col-md-6">
                            <a href=""><img src="images/footer/dathongbao.png" alt="" class="img-fluid" style="max-width: 100px; max-height:100%"></a>
                        </div>
                    </div>
                    <div class="col-md-6 ms-1">
                        <a href=""><img src="images/footer/usstoa.png" alt="" class="img-fluid" style="max-width: 100px; max-height:100%"></a>
                    </div>
                </div>
                <div class="bg-white shadow-sm rounded p-2 mt-3 mb-3">
                    <a href="" class="text-decoration-none text-dark fs-6">Giới thiệu</a>
                    <a href="" class="text-decoration-none text-dark">Quyền riêng tư</a>
                    <a href="" class="text-decoration-none text-dark">Điều khoản</a>
                    <a href="" class="text-decoration-none text-dark">Cookie</a>
                    <a href="" class="text-decoration-none text-dark fs-6">Tuyển dụng</a>
                    <a href="" class="text-decoration-none text-dark">Hỗ trợ</a><br>
                    <a href="" class="text-decoration-none text-dark">Tiếp thị liên kết</a>
                    <div class="d-flex justify-content-center mt-2">
                        <small>&#169; Hahalolo 2017. Đã đăng ký bản quyền</small>
                    </div>
                </div>
                <p class="mt-4">Hahalolo</p>
                <p>Hahalolo</p>
                <p>Hahalolo</p>

            </div>
        </div>
        <!-- Content -->
        <div class="col-md-6 main-content-index" id="content-index">
            <div class="search-tour mb-3 bg-white rounded shadow-sm">
                <form class="row g-3 needs-validation mt-3 me-3 ms-3" id="form-search" novalidate>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Bạn muốn đi đâu?</label>
                        <input type="text" class="form-control" id="searchlocation" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Ngày khởi hành</label>
                        <input type="date" class="form-control" id="searchstartday" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom03" class="form-label">Điểm khởi hành</label>
                        <input type="text" class="form-control" id="searchStartLocation" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom04" class="form-label">Điểm kết thúc</label>
                        <input type="text" class="form-control" id="searchEndLocation" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom05" class="form-label">Chủ đề tour</label>
                        <input type="text" class="form-control" id="searchcdTour" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom07" class="form-label">Số ngày đi tour</label>
                        <input type="text" class="form-control" id="searchnumberday" required>
                    </div>
                    <div class="col-md-12 advanced-search">
                        <label for="validationCustom08" class="form-label">Khoảng giá(Ví Dụ: 1000000-2000000)</label>
                        <input type="text" class="form-control" name="searchPrice" id="searchPrice" required>
                    </div>
                    <div class="col-md-6 form-check advanced-search">
                        <input class="form-check-input" id="checkbox1" name="checkbox1" type="checkbox" value="ApDungKhuyenMai">
                        <label class="form-check-label" for="flexCheckChecked">
                            Có áp dụng khuyến mãi
                        </label>
                    </div>
                    <div class="col-md-6 form-check advanced-search">
                        <input class="form-check-input" type="checkbox" name="checkbox2" id="checkbox2" value="TraGop">
                        <label class="form-check-label" for="flexCheckChecked">
                            Tour trả góp
                        </label>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-between">
                        <button type="button" id="display" class="btn btn-outline-secondary" onclick="displaysearch()">Tìm kiếm nâng cao</button>
                        <button class="btn btn-primary" id="btnsearchTour" type="button">Tìm kiếm</button>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-end">
                        <a href="" class="code-tour text-decoration-none" data-bs-toggle="modal" data-bs-target="#searchbookingtour">Tra cứu mã đặt toa</a>
                    </div>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="searchbookingtour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tra cứu mã đặt Tour</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 needs-validation" method="post" action="process-searchBookingTour.php" novalidate>
                                    <div class="col-md-12">
                                        <label for="validationCustom01" class="form-label">Tìm kiếm</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="codebookingtour" value="" required>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary" name="submitsearchbooking" type="submit">Tra cứu</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="listtour">
                <?php
                $sql1 = 'SELECT*
                    FROM tb_tour, tb_touroperator, tb_typetour, tb_user
                    WHERE tb_tour.id_touroperator = tb_touroperator.id_touroperator AND
                    tb_tour.id_typetour = tb_typetour.id_typetour and status_tour = 1 and tb_tour.lock = 0 
                    and tb_user.id_user = tb_touroperator.id_user and tb_user.lock = 0 and tb_touroperator.lock = 0;';
                $result =  mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $idtour = $row['tour_code'];
                        $image = $row['imagetouroperator'];
                        $nametouroperator = $row['nametouroperator'];
                        $nametour = $row['nametour'];
                        $days = $row['numberofdays'];
                        $nametypetour = $row['nametypetour'];
                        $start = $row['startinglocation'];
                        $end = $row['endinglocation'];
                        $content = $row['tourinfo'];
                        $discount = $row['tourdiscount'];
                        $idnew = substr(md5(rand()), 0, 4);
                        $sqlseday = "Select* from tb_startendday where tour_code = '{$idtour}' and startday >= CURDATE() and status_startendday = 1 ORDER by startday";
                        $resultseday = mysqli_query($conn, $sqlseday);
                        $wdstart = '';
                        $startday = '';
                        $adultprice = 0;
                        if(mysqli_num_rows($resultseday)>0){
                            $rowseday = mysqli_fetch_assoc($resultseday);
                            $wdstart = $rowseday['wdstart'];
                            $startday = $rowseday['startday'];
                            $adultprice = $rowseday['adultprice'];
                        }
                ?>
                        <div class="card shadow-sm">
                            <div class="p-3">
                                <div class="d-flex flex-inline align-items-center">
                                    <img src="data:image/png;base64, <?php echo base64_encode($image) ?>" alt="" class="ms-1 mb-2" style="width: 40px; height: 40px">
                                    <p class="ms-3 fw-bold"><?php echo $nametouroperator ?></p>
                                </div>
                                <!-- Images Tour -->
                                <div id="carouselExampleControlsNoTouching<?php echo $idnew; ?>" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                                    <div class="carousel-inner">
                                        <?php
                                        $sql2 = "Select* from tb_tourimages where tour_code = '" . $idtour . "'";
                                        $result1 =  mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result1) > 0) {
                                            for ($i = 0; $i < mysqli_num_rows($result1); $i++) {
                                                $row1 = mysqli_fetch_assoc($result1);
                                                $images = $row1['images_part'];
                                                if ($i == 0) {
                                        ?>
                                                    <div class="carousel-item active">
                                                        <img src="data:image/png;base64, <?php echo base64_encode($images) ?>" class="card-img-top d-block w-100" alt="..." style="max-height: 394px">
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="carousel-item">
                                                        <img src="data:image/png;base64, <?php echo base64_encode($images) ?>" class="card-img-top d-block w-100" alt="..." style="max-height: 394px">
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching<?php echo $idnew; ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching<?php echo $idnew; ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <?php
                                (int)$danhgia = $ps->getDGTour($idtour);
                                $danhgia = (int)$danhgia;
                                if($danhgia == NULL){
                                    $danhgia = "Chưa có đánh giá";
                                }
                                $danhgia = ($danhgia=="Chưa có đánh giá") ? "Chưa có đánh giá" : $danhgia.''.'/100 điểm';
                                ?>
                                <div class="d-flex flex-inline align-items-center text-center mt-1">
                                    <p class="mt-2 text-warning"><?php echo $nametypetour ?></p>
                                    <p class="p-1 bg-success ms-auto rounded text-light"><?php echo $days . ' ngày' ?></p>
                                </div>
                                <div class="d-flex flex-inline align-items-center text-center mt-1">
                                <p class="p-1 bg-success ms-auto rounded text-light"><?php echo $danhgia; ?></p>
                                </div>
                                
                                <h4 class="mb-4 fw-bold"><?php echo $nametour ?></h4>
                                <!-- Information Tour -->
                                <div class="d-flex flex-inline">
                                    <span class="material-icons text-primary">
                                        location_on
                                    </span>
                                    <p class="fw-bold ms-3"><?php echo $start . '-' . $end ?></p>
                                </div>
                                <div class="d-flex flex-inline">
                                    <span class="material-icons">
                                        calendar_month
                                    </span>
                                    <p class="fw-bold ms-3"><?php echo $wdstart.', '.ps_date($startday) ?></p>
                                </div>
                                <!-- Content Tour -->
                                <div>
                                    <p><?php echo $content ?></p>
                                </div>
                                <!-- Price Tour and Booking -->
                                <div class="d-flex flex-inline justify-content-between">
                                    <div>
                                        <p style="font-size: 14px;">Giá chỉ từ</p>
                                        <p class="fw-bold text-danger"><?php echo ps_price($adultprice) ?></p>
                                    </div>
                                    <div>
                                        <a href="informationtour.php?tourcode=<?php echo $idtour ?>"><button type="button" class="btn btn-info me-auto">Xem chi tiết</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End card -->
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom bg-white" id="button-displaysidebar">
    <div class="row">
        <div class="col-md d-flex justify-content-center">
            <button class="btn btn-primary rounded mb-1" id="btn-displaysidebar" onclick="mangshow()"><span class="material-icons">
                    filter_list
                </span>
            </button>
        </div>
    </div>
</div>
<!-- <script src="js/index.js"></script> -->
<script>
    function displaysearch() {
        var x = document.getElementsByClassName('advanced-search');
        var i;
        for (i = 0; i < x.length; i++) {
            if (x[i].style.display == "") {
                x[i].style.display = "block";
            } else {
                if (x[i].style.display == "none") {
                    x[i].style.display = "block";
                } else {
                    x[i].style.display = "none"
                }
            }
        }
    }
    var content = document.getElementById('content-index');
    var sidebar = document.getElementById('sidebar-content');

    function mangshow() {
        if (content.style.display == '') {
            content.style.display = 'none'
            sidebar.style.display = 'block'
        } else {
            if (content.style.display == 'none') {
                content.style.display = 'block'
                sidebar.style.display = 'none'
            } else {
                content.style.display = 'none'
                sidebar.style.display = 'block'
            }
        }
    }
</script>

<?php
include('.//partials-front/footer.php');
?>