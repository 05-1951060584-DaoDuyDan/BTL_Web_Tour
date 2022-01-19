<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/style.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
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
                    <h3 class="text-center">Đăng Ký</h3>
                </div>
                <form class="row g-3 needs-validation" onsubmit="return matchpass()" name="formsignup" method="POST" action="process-register.php" novalidate>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="Ten" required name="nameuser">
                        
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Họ</label>
                        <input type="text" class="form-control" id="Ho" name="surnameuser" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom03" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <small id="emailHelp" class="form-test"></small>
                        <div class="invalid-feedback">
                            Email chưa chính xác!
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom03" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="Dienthoai" name="phonenumber" required>
                        <div class="invalid-feedback">
                            Số điện thoại chưa đúng!
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom04" class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" id="password" name="pass1" required>
                        <div class="invalid-feedback">
                            Nhập mật khẩu!
                        </div>
                    </div>
                    <div class="col-md-12" id="signup-retypepass">
                        <label for="validationCustom05" class="form-label">Xác Nhận Mật Khẩu</label>
                        <input type="password" class="form-control" id="confirm_password" name="pass2" required>
                        <div class="invalid-feedback">
                            Nhập mật khẩu!
                        </div>
                    </div>
                    <div class="d-grid gap-2 mb-4 mt-5">
                        <button class="btn btn-primary rounded-pill" type="submit" name="btnsignup">Đăng Ký</button>
                    </div>
                    <?php
                        if(isset($_GET['error'])){
                            echo "<p style='color: red'>{$_GET['error']}</p>";
                        }
                    ?>
                </form>
                <div class="col-md-12 mt-3">
                    <p class="fs-6 my_privacypolicy">Bằng cách nhấp vào Đăng ký, bạn đồng ý với <a href="" class="text-decoration-none">Điều khoản dịch vụ</a>,
                        <a href="" class="text-decoration-none">Chính sách dữ liệu</a>, <a href="" class="text-decoration-none">Chính sách cookie</a> và <a href="" class="text-decoration-none">Tiêu chuẩn cộng đồng của chúng tôi</a>
                    </p>
                </div>
                <div class="text-center">
                    <div>
                        <p>Bạn đã có tài khoản? <a href="login.php" class="text-decoration-none">Đăng nhập</a></p>
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
    <script>
        let pass1 = document.getElementById('password').value;
        let pass2 = document.getElementById('confirm_password').value;
        function matchpass() {
            if (pass1 != pass2) {
                alert("Mật khẩu nhập phải giống nhau!");
                return false;
            } else {
                return true;
            }
        }

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>