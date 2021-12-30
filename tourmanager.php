<?php
session_start();
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: index.php');
}else{
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
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom02" class="form-label">Tên</label>
                                        <input type="text" class="form-control" readonly id="validationCustom02" value="<?php echo $row['nameuser'] ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" readonly id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['email'] ?>">
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom03" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" readonly id="validationCustom03" value="<?php echo $row['phonenumber'] ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom04" class="form-label">Tên tour quản lý</label>
                                        <input type="text" class="form-control" readonly id="validationCustom04" value="<?php echo $row['nametouroperator'] ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="validationCustom05" class="form-label">Loại hình kinh doanh</label>
                                        <input type="text" class="form-control" readonly id="validationCustom05" value="<?php echo $row['businesstype'] ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row bg-white">
                            <div class="col-md-12 mb-3" style="margin-left: -12px;">
                                <a href="add-tour.php"><button type="button" class="btn btn-primary mt-3">Thêm Tour Du Lịch</button></a>
                            </div>
                            <?php
                                $sqltour = "Select* from tb_user, tb_touroperator, tb_tour where tb_user.id_user = tb_touroperator.id_user and tb_touroperator.id_touroperator = tb_tour.id_touroperator and tb_user.email = '{$user}'";
                                $resulttour =  mysqli_query($conn, $sqltour);
                                if (mysqli_num_rows($resulttour) > 0) {
                                    while($rowtour = mysqli_fetch_assoc($resulttour)){
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
                                        <img src="images/Tour/TuanDung/1.png" class="card-img-top" alt="...">
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
                                            if($tourstatus==1){
                                        ?>
                                        <div class="card-body">
                                            <a href="#" class="card-link text-decoration-none">Xem Thông Tin Tour</a>
                                            <a href="#" class="card-link text-decoration-none">Chỉnh sửa Tour</a>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if($tourstatus==0){
                                        ?>
                                        <div class="card-body">
                                            <form action="process-addtour.php" class="form-control" method="GET">
                                                <input type="text" name="tour_code_update" value=<?php echo $tour_code ?> style="display: none;">
                                                <button class="btn btn-primary" name="themthongtintour">Thêm thông tin về tour</button>
                                            </form>
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
</body>

</html>