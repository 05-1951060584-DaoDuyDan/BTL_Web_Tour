<?php
include('.//partials-front/header.php');
?>

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
                                    <p class="mt-3"><?php echo $user ?></p>
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
                            <a href="tourmanager/tourmanager.php" class="text-decoration-none text-dark">
                                <div class="d-flex align-items-center">
                                    <span class="material-icons my_icon_header me-3">monetization_on</span>
                                    <p class="mt-3">Tài khoản kinh doanh</p>
                                </div>
                            </a>
                        <?php
                        } else if (isset($_SESSION['LoginOK'])) {
                        ?>
                            <a href="" class="text-decoration-none text-dark">
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
                <div class="bg-white wrapper rounded shawdow-sm mt-3">
                    <div class="time">
                        <h6 class="text-center">Chúc bạn một ngày tốt lành! <?php  ?></h6>
                    </div>
                    <div class="temp p-3 text-center">
                        <span class="numb">13</span>
                        <span class="deg">°</span>
                    </div>
                    <div class="weather p-3 text-center">
                        Cloud
                    </div>
                    <div class="location d-flex p-2 justify-content-center">
                        <span class="material-icons">
                            room
                        </span>
                        <span>Ha Noi, Viet Nam</span>
                    </div>
                    <div class="bottom-details d-flex flex-row justify-content-between p-2 border border-radius m-1">
                        <div class="column feels d-flex flex-row align-items-center ">
                            <span class="material-icons text-danger">
                                device_thermostat
                            </span>
                            <div class="details">
                                <div class="temp">
                                    <span class="numb-2"></span>
                                    <span class="deg">°</span>
                                </div>
                                <p>Feels Like</p>
                            </div>
                        </div>
                        <div class="column humidity d-flex flex-row align-items-center">
                            <span class="material-icons text-primary">
                                invert_colors
                            </span>
                            <div class="details">
                                <span>87%</span>
                                <p>Humidity</p>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="images\index\sidebar-img-right.png" alt="" class="img-fluid shadow-sm rounded mb-3 mt-3 sidebar-right-image">
                <div class="bg-white shadow-sm rounded">
                    <p class="fw-bold ms-1 mt-2">Trải nghiệm nổi bật</p>
                    <hr style="max-width: 300px">
                    <img src="images/Tour/DaNang_BaNa_NguHanhSon_HoiAn.png" alt="" class="img-fluid sidebar-right-image shadow-sm rounded">
                </div>
                <p>10</p>
                <p>10</p>
                <p>10</p>
                <p>10</p>
                <p>10</p>
                <p>10</p>
                <p>10</p>
                <p>10</p>
            </div>
        </div>
        <!-- Content -->
        <div class="col-md-6 main-content-index" id="content-index">
            <div class="search-tour mb-3 bg-white rounded shadow-sm">
                <form class="row g-3 needs-validation mt-3 me-3 ms-3" id="form-search" novalidate>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Bạn muốn đi đâu?</label>
                        <input type="text" class="form-control" id="validationCustom01" required>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Ngày khởi hành</label>
                        <input type="date" class="form-control" id="validationCustom02" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom03" class="form-label">Điểm khởi hành</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom04" class="form-label">Điểm kết thúc</label>
                        <input type="text" class="form-control" id="validationCustom04" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom05" class="form-label">Chủ đề tour</label>
                        <input type="text" class="form-control" id="validationCustom05" required>
                    </div>

                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom06" class="form-label">Chủ đề tour</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Tất cả các loại Tour</option>
                            <option value="1">Tour trong nước</option>
                            <option value="2">Tour nước ngoài</option>
                        </select>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom07" class="form-label">Số ngày đi tour</label>
                        <input type="text" class="form-control" id="validationCustom07" required>
                    </div>
                    <div class="col-md-6 advanced-search">
                        <label for="validationCustom08" class="form-label">Khoảng giá</label>
                        <input type="text" class="form-control" id="validationCustom08" required>
                    </div>

                    <!-- <div class="col-md-6">
                        <label for="validationCustom0" class="form-label"></label>
                        <input type="text" class="form-control" id="validationCustom0" required>
                    </div> -->
                    <div class="col-md-6 form-check advanced-search">
                        <input class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label" for="flexCheckChecked">
                            Có áp dụng khuyến mãi
                        </label>
                    </div>
                    <div class="col-md-6 form-check advanced-search">
                        <input class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label" for="flexCheckChecked">
                            Tour trả góp
                        </label>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="displaysearch()">Tìm kiếm nâng cao</button>
                        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                    </div>
                    <div class="col-12 mb-3 d-flex justify-content-end">
                        <a href="" class="code-tour text-decoration-none">Tra cứu mã đặt toa</a>
                    </div>
                </form>
            </div>
            <?php
            $sql1 = 'SELECT*
                FROM tb_tour, tb_touroperator, tb_typetour
                WHERE tb_tour.id_touroperator = tb_touroperator.id_touroperator AND
                tb_tour.id_typetour = tb_typetour.id_typetour and status_tour = 1;';

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
            ?>
                    <div class="card shadow-sm">
                        <div class="p-3">
                            <div class="d-flex flex-inline align-items-center">
                                <img src="data:image/png;base64, <?php echo base64_encode($image) ?>" alt="" class="ms-1 mb-2" style="width: 40px; height: 40px">
                                <p class="ms-3 fw-bold"><?php echo $nametouroperator ?></p>
                            </div>
                            <!-- Images Tour -->
                            <div id="carouselExampleControlsNoTouching<?php echo $idnew;?>" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
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
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching<?php echo $idnew;?>" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching<?php echo $idnew;?>" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="d-flex flex-inline align-items-center text-center mt-1">
                                <p class="mt-2 text-warning"><?php echo $nametypetour ?></p>
                                <p class="p-1 bg-success ms-auto rounded text-light"><?php echo $days . ' ngày' ?></p>
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
                                <p class="fw-bold ms-3">Thứ 2, 20/12/2021</p>
                            </div>
                            <!-- Content Tour -->
                            <div>
                                <p><?php echo $content ?></p>
                            </div>
                            <!-- Price Tour and Booking -->
                            <div class="d-flex flex-inline justify-content-between">
                                <div>
                                    <p style="font-size: 14px;">Giá chỉ từ</p>
                                    <p class="fw-bold text-danger"><?php echo $discount ?></p>
                                </div>
                                <div>
                                    <a href="informationtour.php?tourcode=<?php echo $idtour?>"><button type="button" class="btn btn-info me-auto">Xem chi tiết</button></a>
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
            }else{
                content.style.display = 'none'
                sidebar.style.display = 'block'
            }
        }
    }
</script>

<?php
include('.//partials-front/footer.php');
?>