<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    require "partials-front/header-business.php";
    require "../classprocessSQL.php";
    $ps = new Process();
    $user = substr($_SESSION['LoginOK'], 1, 60);
    $user = rtrim($user);
    $sql = "SELECT * FROM tb_user WHERE email='{$user}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

?>
<head>
    <title>Đăng ký tài khoản kinh doanh</title>
</head>

<!-- <header>AAAA</header> -->
<div style="margin-top:70px">
    <main class="container-fuild text-center align-text-stretch">
        <h1>Tạo tài khoản kinh doanh</h1>
        <h5>
            Bạn chưa sở hữu tài khoản kinh doanh, khởi tạo ngay để bắt đầu quá trình
            hoạt động kinh doanh trên Hahalolo cho doanh nghiệp của bạn. Với một tài
            khoản kinh doanh trên Hahalolo, bạn có thể điều hành, quản lý và phát
            triển doanh nghiệp một cách toàn diện.
        </h5>
        <h6 class="h6a text-success">Tất cả trong một và hoàn toàn miễn phí.</h6>
        <button type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            TẠO TÀI KHOẢN KINH DOANH
        </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tạo tài khoản kinh doanh</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="process-regiterManager.php" method="post" enctype="multipart/form-data" onsubmit="return checkManager()">
                        <div class="modal-body text-start">
                            <h6>Chọn ảnh đại diện</h6>
                            <div class="form-floating">
                                <input type="file" class="form-control-file d-block" id="imgManager" name="imgManager">
                            </div>
                            <h6>Chọn loại hình doanh nghiệp</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="loaihinhkinhdoanh" id="inlineRadio1" value="Cá nhân">
                                <label class="form-check-label" for="inlineRadio1">Cá Nhân</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="loaihinhkinhdoanh" id="inlineRadio2" value="Doanh nghiệp">
                                <label class="form-check-label" for="inlineRadio2">Doanh Nghiệp</label>
                            </div>
                            <select class="form-select form-select-sm mt-2 mb-2" name="typepage" id="typepage" aria-label=".form-select-sm example">
                                <option selected>Loại trang</option>
                                <?php
                                $tp = $ps->getTypePage();
                                for ($i = 0; $i < count($tp); $i++) {
                                    $rowtp = $tp[$i];
                                    echo "<option value='{$rowtp['id_typepage']}'>{$rowtp['nametypepage']}</option>";
                                }
                                ?>
                            </select>
                            <h6>Tên doanh nghiệp</h6>
                            <input type="text" class="form-control" id="nameindustry" name="nameindustry" placeholder="Nhập tên doanh nghiệp" aria-label="Username" aria-describedby="addon-wrapping">
                            <small id="textHelp" class="form-text">Tên doanh nghiệp của bạn sẽ được nhìn thấy bởi tất cả nhân viên.</small>
                            <h6>Tên chủ sở hữu</h6>
                            <input type="text" class="form-control" id="nametouroperator" name="nametouroperator" placeholder="" value="<?php echo $row['surnameuser'] . ' ' . $row['nameuser'] ?>" aria-label="Username" aria-describedby="addon-wrapping">
                            <h6>Email</h6>
                            <input type="text" class="form-control" name="email" id="email" placeholder="" value="<?php echo $row['email'] ?>" aria-label="Username" aria-describedby="addon-wrapping">
                            <h6>Số điện thoại</h6>
                            <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="" value="<?php echo $row['phonenumber'] ?>" aria-label="Username" aria-describedby="addon-wrapping">
                            <input type="text" name="iduser" value="<?php echo $row['id_user'] ?>" style="display:none">
                            <small class="form-text">Chúng tôi sẽ gửi thông báo tới doanh nghiệp của bạn qua email này.</small> <br>
                            <small id="emailHelp"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">HỦY BỎ</button>
                            <button type="submit" name="btnSignUpManager" class="btn btn-primary">ĐỒNG Ý</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

</div>
<section class="tao3 d-flex justify-content-center p-2 bg-info fixed-bottom ">
    <hr />
    <p class="taocon">Hahalolo &copy; 2017</p>
    <a href="http://localhost/baitaplon/business.php" class="taocon text-decoration-none"> Giới thiệu</a>
    <a href="https://tuyendung.hahalolo.com/" class="taocon text-decoration-none"> Tuyển dụng</a>
    <a href="https://help.hahalolo.com/hc/vi/articles/360036293871" class="taocon text-decoration-none"> Quyền riêng tư</a>
    <a href="https://help.hahalolo.com/hc/vi/articles/360035943132" class="taocon text-decoration-none"> Cookies</a>
    <a href="https://help.hahalolo.com/hc/vi/articles/360036291411" class="taocon text-decoration-none"> Điều khoản</a>
    <a href="https://help.hahalolo.com/hc/vi/articles/360035841292" class="taocon text-decoration-none"> Tiêu chuẩn cộng đồng</a>
    <a href="https://help.hahalolo.com/hc/vi" class="taocon text-decoration-none"> Hỗ trợ</a>
</section>
<!-- <script src="jss/jquery-3.6.0.min.js"></script> -->
<!-- <script src="jss/script.js"></script> -->

<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/scriptManager.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>