<?php
// include('config/config.php');
if (isset($_SESSION['LoginOK'])) {
    $user = substr($_SESSION['LoginOK'], 1, 60);
    $user = rtrim($user);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style/style.css">
</head>

<body style="background-color: #FAFAFB" id="body-main">
    <div class="header fixed-top shadow-sm rounded">
        <nav class="navbar navbar-expand-lg navbar-light bg-white pt-1 pb-1">
            <div class="container-fluid header-content">
                <a class="navbar-brand" href="index.php"><img src=".//images/logo_login.png" alt="" class="img-fluid logo_home"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-0" class="navbar-header" id="navbarSupportedContent">
                    <div class="navbar-nav me-auto ms-auto mb-lg-0 header-main">
                        <div class="d-flex flex-column bd-highlight ps-3 pe-3 section_header">
                            <div class="bd-highlight d-flex justify-content-center"><span class="material-icons">
                                    article
                                </span></i></div>
                            <div class="bd-highlight d-flex justify-content-center my_font_header">
                                <p class="my_text_header"> Bảng tin</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column bd-highlight ps-3 pe-3 section_header">
                            <div class="bd-highlight d-flex justify-content-center"><span class="material-icons">
                                    map
                                </span></div>
                            <div class="bd-highlight d-flex justify-content-center my_font_header">
                                <p class="my_text_header">Trải nghiệm</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column bd-highlight ps-3 pe-3 section_header ">
                            <div class="bd-highlight d-flex justify-content-center"><span class="material-icons text-primary">
                                    tour
                                </span></div>
                            <div class="bd-highlight d-flex justify-content-center my_font_header text-primary">
                                <p class="my_text_header">Tour</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column bd-highlight ps-3 pe-3 section_header">
                            <div class="bd-highlight d-flex justify-content-center"><span class="material-icons">
                                    hotel_class
                                </span></div>
                            <div class="bd-highlight d-flex justify-content-center my_font_header">
                                <p class="my_text_header">Khách sạn</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column bd-highlight ps-3 pe-3 section_header">
                            <div class="bd-highlight d-flex justify-content-center"><span class="material-icons">
                                    flight_takeoff
                                </span></div>
                            <div class="bd-highlight d-flex justify-content-center my_font_header">
                                <p class="my_text_header">Vé máy bay</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column bd-highlight ps-3 pe-3 section_header">
                            <div class="bd-highlight d-flex justify-content-center"><span class="material-icons">
                                    directions_car
                                </span></div>
                            <div class="bd-highlight d-flex justify-content-center my_font_header">
                                <p class="my_text_header">Thuê xe</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column bd-highlight ps-3 pe-3 section_header">
                            <div class="bd-highlight d-flex justify-content-center"><span class="material-icons">
                                    shopping_cart
                                </span></div>
                            <div class="bd-highlight d-flex justify-content-center my_font_header">
                                <p class="my_text_header">Mua sắm</p>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-nav mb-lg-0">
                        <div class="d-flex bd-highlight ps-3 pe-3 header_end" id="navbar-content-right">
                            <div class="btn-group">
                                <span class="material-icons my_icon_header_2" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">add_shopping_cart
                                </span>
                                <ul class="dropdown-menu dropdown-menu-lg-end p-3">
                                    <p class="fw-bold mt-1 ms-2">Giỏ Hàng</p>
                                    <p class="mt-3 ms-2">Thanh Toán</p>
                                    <hr>
                                    <div class="form-check d-flex">
                                        <div class="me-5">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1" style="width:100px">
                                            Đặt tour
                                        </label></div>
                                        <p class="text-danger">1800000</p>
                                    </div>
                                    <hr>
                                    <a href="cart.php"><div class="d-grid gap-2">
                                        <button class="btn btn-primary rounded-pill" type="button">Đặt Tour</button></div></a>
                                </ul>
                            </div>
                            <div class="bd-highlight d-flex justify-content-center align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tài khoản thanh toán"><span class="material-icons my_icon_header_2">
                                    account_balance_wallet
                                </span></div>
                            <div class="bd-highlight d-flex justify-content-center align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Messenger"><span class="material-icons my_icon_header_2">
                                    chat
                                </span></div>
                            <div class="btn-group">
                                <span class="material-icons my_icon_header" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    person
                                </span>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <?php
                                    if (isset($_SESSION['LoginOK'])) {
                                    ?>
                                        <a href="userinformation.php" class="text-decoration-none">
                                            <li class="dropdown-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3"><span class="material-icons">
                                                            person
                                                        </span></div>
                                                    <div>
                                                        <?php echo "<p>Welcome: {$user}</p>"; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    <a href="" class="text-decoration-none">
                                        <li class="dropdown-item">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3"><span class="material-icons my-icon-index">
                                                        library_books
                                                    </span></div>
                                                <div>
                                                    <p>Quản lý đơn hàng</p>
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                    <li class="dropdown-item">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3"><span class="material-icons my-icon-index">
                                                    light_mode
                                                </span></div>
                                            <div>
                                                <p>Chế độ tối(Tắt)<br>Điều chỉnh giao diện để giảm độ chói và<br> cho đôi mắt được nghỉ ngơi</p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    if (isset($_SESSION['LoginOK'])) {
                                    ?>
                                        <a href="logout.php" class="text-decoration-none">
                                            <li class="dropdown-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3"><span class="material-icons my-icon-index">
                                                            login
                                                        </span></div>
                                                    <div>
                                                        <p>Đăng xuất</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (!isset($_SESSION['LoginOK'])) {
                                    ?>
                                        <a href="login.php" class="text-decoration-none">
                                            <li class="dropdown-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3"><span class="material-icons my-icon-index">
                                                            login
                                                        </span></div>
                                                    <div>
                                                        <p>Đăng nhập</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="clear"></div>
    </div>