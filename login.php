<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body id="body_login">
    <div class="container container_login mb-5">
        <div class="row">
            <div class="col-md-8 text-black">
                <div class="d-flex text-center align-items-center mb-4">
                    <a href=".//index.php" class="navbar-brand"><img src=".//images/logo_login.png" alt="" class="img-fluid img_login"></a>
                    <h1 class="text-primary opacity-75">Hahalolo</h1>
                </div>
                <div>
                    <h2>Bạn thích</h2>
                </div>
                <div class="mb-3">
                    <h1 class="fw-bolder">đi du lịch?</h1>
                </div>
                <div class="mb-3">
                    <h3>Bạn muốn tìm hiểu thông tin về những điểm đến?</h3>
                </div>
                <div>
                    <h5 class="lh-base">Chỉ với vài thao tác, hãy nhanh chóng đăng nhập để trải nghiệm <br> và cảm nhận các tiện ích tuyệt vời của chúng tôi.</h5>
                </div>
            </div>
            <div class="col-md-4 bg-white rounded">
                <div class="mt-3">
                    <h3 class="text-center">Đăng nhập</h3>
                </div>
                <form action="process-login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email hoặc Số điện thoại</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phoneoremail">
                        <div id="emailHelp" class="form-text">Thông tin của bạn luôn được bảo mật.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <div class="d-grid gap-2 mb-4">
                        <button class="btn btn-primary rounded-pill" type="submit" name="btnsignin">Đăng nhập</button>
                    </div>
                    <?php
                        if(isset($_GET['error'])){
                            echo "<p style='color: red'>{$_GET['error']}</p>";
                        }
                    ?>
                </form>
                <div class="text-center mb-5">
                    <a href="" class="text-decoration-none">Quên mật khẩu?</a>
                </div>
                <div class="text-center">
                    <div>
                        <p>Bạn chưa có tài khoản? <a href="signup.php" class="text-decoration-none">Đăng ký tại đây!</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container login-footer">
            <div class="row">
                <div class="d-flex justify-content-between" id="content-login-footer">
                    <div class="d-flex">
                        <a href="https://play.google.com/store/apps/details?id=com.hahalolo.android.social&hl=en" class="text-decoration-none"><button type="button" class="btn btn-light rounded-pill d-flex align-items-center me-2"><span class="material-icons me-2">
                            adb
                            </span> <span>Google Play</span></button></a>
                        <a href="https://apps.apple.com/us/app/hahalolo/id1437417120" class="text-decoration-none"><button type="button" class="btn btn-light rounded-pill d-flex align-items-center"><span class="material-icons me-2">
                            phone_iphone
                            </span> <span>App Store</span></button></a>
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn">Deutsch</button>
                        <p class="mb-0 d-flex align-items-center">|</p>
                        <button type="button" class="btn">English</button>
                        <p class="mb-0 d-flex align-items-center">|</p>
                        <button type="button" class="btn">Tiếng Việt</button>
                        <p class="mb-0 d-flex align-items-center">|</p>
                        <button type="button" class="btn">中文 (简体)</button>
                        <p class="mb-0 d-flex align-items-center">|</p>
                        <button type="button" class="btn"><span class="material-icons d-flex align-items-center">
                            add_circle_outline
                            </span></button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md">© 2017 Hahalolo. Đã đăng ký bản quyền.</div>
                </div>
            </div>
        </div>
    </div>
<?php
include('.//partials-front/footer.php');
?>