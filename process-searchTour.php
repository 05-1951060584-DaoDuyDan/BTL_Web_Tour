<?php
if(isset($_POST)){
    require "config/config.php";
    require "process-string.php";
    require "classprocessSQL.php";
    $ps = new Process();
    $sql0 = "SELECT Distinct tb_tour.tour_code FROM `tb_tour`, `tb_startendday`, `tb_typetour` WHERE tb_startendday.tour_code = tb_tour.tour_code AND tb_tour.id_typetour = tb_typetour.id_typetour AND startday >= CURDATE() ";
    $sql1 = "";
    $sql2 = "";
    $sql3 = "";
    $sql4 = "";
    $sql4 = "";
    $sql6 = "";
    $sql7 = "";
    $sql8 = "";
    $sql9 = "";
    if(isset($_POST['searchlocation'])){
        $sql1 = "AND LOCATE('{$_POST['searchlocation']}', nametour) ";
        $sql0 = $sql0.$sql1;
        //echo $sql0;
    }
    if(isset($_POST['searchstartday']))
    {
        $sql2 = "AND startday = '{$_POST['searchstartday']}' ";
        $sql0 = $sql0.$sql2;
        //echo $sql0;
    }
    if(isset($_POST['searchStartLocation'])){
        $sql3 = " AND LOCATE('{$_POST['searchStartLocation']}', startinglocation) ";
        $sql0 = $sql0.$sql3;
        //echo $sql0;
    }
    if(isset($_POST['searchEndLocation'])){
        $sql4 = " AND LOCATE('{$_POST['searchEndLocation']}', endinglocation) ";
        $sql0 = $sql0.$sql4;
        //echo $sql0;
    }
    if(isset($_POST['searchcdTour'])){
        $sql5 = " AND LOCATE('{$_POST['searchcdTour']}', nametypetour) ";
        $sql0 = $sql0.$sql5;
        //echo $sql0;
    }
    if(isset($_POST['searchnumberday'])){
        $sql6 = " AND numberofdays = {$_POST['searchnumberday']} ";
        $sql0 = $sql0.$sql6;
        //echo $sql0;
    }
    if(isset($_POST['khuyenmai'])){
        $sql7 = " AND tourdiscount > 0 ";
        $sql0 = $sql0.$sql7;
        //echo $sql0;
    }
    if(isset($_POST['tragop'])){
        $sql8 = "AND installment = 1 ";
        $sql0 = $sql0.$sql8;
        //echo $sql0;
    }
    if(isset($_POST['searchPrice'])){
        $price = explode('-',$_POST['searchPrice']);
        $sql9 = "GROUP BY tb_tour.tour_code HAVING AVG(adultprice) >= {$price[0]} AND AVG(adultprice) <= {$price[1]} ";
        $sql0 = $sql0.$sql9;
        //echo $sql0;
    }
    $re = mysqli_query($conn,$sql0);
    if(mysqli_num_rows($re)>0){
        $r = mysqli_fetch_assoc($re)
    ?>
                <?php
                $sql1 = $sql1 = "SELECT*
                FROM tb_tour, tb_touroperator, tb_typetour, tb_user
                WHERE tb_tour.id_touroperator = tb_touroperator.id_touroperator AND
                tb_tour.id_typetour = tb_typetour.id_typetour and status_tour = 1 and tb_tour.lock = 0 
                and tb_user.id_user = tb_touroperator.id_user and tb_user.lock = 0 and tb_touroperator.lock = 0 AND tour_code = '{$r['tour_code']}'";
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
            <?php
    }
}

?>