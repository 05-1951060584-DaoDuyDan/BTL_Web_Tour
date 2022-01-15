<?php
require 'partials-front/header.php';
require_once "classprocessSQL.php";
require_once "process-string.php";
if (!isset($_GET['tourcode']) && !isset($_GET['idse'])) {
    header("location: index.php");
} else {
    $tour_code = $_GET['tourcode'];
    $id_startendday = $_GET['idse'];
    $ps = new Process();
    $tour = $ps->getTour($tour_code);
    $startendday = $ps->getStartEndDay($id_startendday);
    $adultprice = $startendday['adultprice'];
    $childprice = $startendday['childprice'];
    $vat = $startendday['vat'];
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

<body style="background-color: #FAFAFB">
    <header style="margin-top: 120px;">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md">
                    <p class="constAdultPrice" style="display: none;"><?php echo $adultprice; ?></p>
                    <p class="constChildPrice" style="display: none;"><?php echo $childprice ?></p>
                    <p class="constVatPrice" style="display: none;"><?php echo $vat ?></p>
                    <a href="informationtour.php?tourcode=<?php echo $tour_code ?>" class="text-decoration-none d-flex align-items-center mb-3">
                        <span class="material-icons">
                            arrow_back_ios
                        </span>
                        <span>Quay lại</span>
                    </a>
                    <h4 class="mb-3">Thông tin đặt Tour</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 m-1">
                    <div>
                        <form class="row g-3 needs-validation m-1" method="POST" action="process-bookingtour.php" onsubmit="return kiemtra()" novalidate>
                            <div class="bg-white rounded shadow-sm p-2">
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Họ <span class="text-danger">*</span></label>
                                    <input type="text" name="surname" class="form-control" id="surname" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Tên đệm & tên <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <span class="me-4">Giới tính <span class="text-danger">*</span></span>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_nam" value="Nam">
                                        <label class="form-check-label" for="inlineRadio1">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2 mb-3">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_nu" value="Nữ">
                                        <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom02" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" name="phonenumber" class="form-control" id="phonenumber" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom03" class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" id="address" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded shadow-sm p-2">
                                <h4 class="mt-3">Số lượng hành khách</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Người lớn</b>
                                        <p>(Trên 10 tuổi)</p>
                                        <div class="d-flex justify-content-between">
                                            <span class="material-icons border rounded-pill add-passengers" onclick="removeadult()">
                                                remove
                                            </span>
                                            <span><input type="text" id="numberadult" class="form-control" name="numberadultinfo" value="1" style="max-width: 50px" readonly></span>
                                            <span class="material-icons border rounded-pill add-passengers" onclick="addadult()">
                                                add
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Trẻ em</b>
                                        <p>(5 - 10 tuổi)</p>
                                        <div class="d-flex justify-content-between">
                                            <span class="material-icons border rounded-pill add-passengers" onclick="removechild()">
                                                remove
                                            </span>
                                            <span><input type="text" id="numberchild" class="form-control" name="numberchildinfo" value="0" style="max-width: 50px" readonly></span>
                                            <span class="material-icons border rounded-pill add-passengers" onclick="addchild()">
                                                add
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Trẻ nhỏ</b>
                                        <p>(0 - dưới 5 tuổi)</p>
                                        <div class="d-flex justify-content-between">
                                            <span class="material-icons border rounded-pill add-passengers" onclick="removebaby()">
                                                remove
                                            </span>
                                            <span><input type="text" id="numberbaby" class="form-control" name="numberbabyinfo" value="0" style="max-width: 50px" readonly></span>
                                            <span class="material-icons border rounded-pill add-passengers" onclick="addbaby()">
                                                add
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded shadow-sm p-2">
                                <h4 class="mt-3">Dịch vụ đi kèm</h4>
                                <p class="ms-2">Vui lòng tích chọn dịch vụ đi kèm và số lượng tương ứng (Nếu không thì hãy bỏ qua)</p>
                                <?php
                                $tourservice = $ps->getTourServive($tour_code);
                                if($tourservice!=false){
                                    $ct = count($tourservice);
                                    echo "<input type='text' class='' name='countservice' id='countservice' style='display:none;'' value='$ct' readonly>";
                                    for($i = 0; $i < count($tourservice);$i++){
                                        $rowtourservice = $tourservice[$i];
                                ?>
                                <div class="">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkbox<?php echo $i; ?>" value="">
                                        <input style="display: none;" type="text" id="priceserviceadd<?php echo $i; ?>" value="<?php echo $rowtourservice['priceservice'] ?>"></input>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php echo $rowtourservice['nameservice']." (".ps_price($rowtourservice['priceservice']).")"; ?>
                                        </label>
                                        <div class="col-md-6">
                                            <label for="validationCustom05" class="form-label">Số hành khách</label>
                                            <input type="text" name="numberpag<?php echo $i; ?>" id="numberpag<?php echo $i; ?>" class="form-control" id="validationCustom05" required>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="bg-white rounded shadow-sm p-2">
                                <h4>Hình thức thanh toán</h4>
                                <div class="row ms-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Thẻ ATM hoặc iBanking của các ngân hàng
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Thẻ thanh toán quốc tế (Visa/Master)
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="dieukhoan" id="" value="dieukhoan">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        <span class="material-icons text-primary">
                                            handshake
                                        </span>
                                        <span class="" style="text-align:justify">Tiếp tục thực hiện bước tiếp theo, tôi xác nhận đã xem và chấp thuận
                                            các <a href="">Điều khoản & chính sách</a> và <a href="">Chính sách riêng tư</a> của hahalolo.</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary mt-3">Thanh Toán</button>
                                </div>
                            </div>
                            <input type="text" class="" name="totalmoney" id="totalpricepost" style="display:none;" value="<?php echo $adultprice + $adultprice*($vat * 1 / 100) ?>" readonly>
                            <input type="text" class="" name="idstartendday" value="<?php echo $id_startendday ?>" id="" style="display:none;" readonly>
                            <?php
                                if(isset($_SESSION['LoginOK'])){
                            ?>
                            <input type="text" class="" name="iduser" id="" value="<?php echo $id_user ?>" style="display:none;" readonly>
                            <?php                             
                            }
                            ?>
                            <input type="text" class="" name="tourcode" id="" value="<?php echo $tour_code ?>" style="display:none;" readonly>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md bg-white rounded shadow-sm m-1 mt-4 p-2">
                        <h4 class="mt-3">Thông tin tour</h4>
                        <hr>
                        <h6><?php echo $tour['nametour'] ?></h6>
                        <a href="informationtour.php?tourcode=<?php echo $tour_code ?>" class="text-decoration-none">Xem chi tiết tour</a>
                        <hr>
                        <div class="d-flex justify-content-around" style="font-size: 14px;">
                            <div>
                                <p>Thời gian:</p>
                                <p>Điểm khởi hành:</p>
                                <p>Ngày khởi hành:</p>
                                <p>Ngày kết thúc:</p>
                                <p>Hành khách:</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="fw-bold"><?php echo $tour['numberofdays'] ?> ngày</p>
                                <p class="fw-bold"><?php echo $tour['startinglocation'] ?></p>
                                <p class="fw-bold"><?php echo date('d-m-Y', strtotime($startendday['startday'])) ?></p>
                                <p class="fw-bold"><?php echo date('d-m-Y', strtotime($startendday['endday'])) ?></p>
                                <p class="fw-bold">1 người lớn, 1 trẻ nhỏ</p>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h6>Chi tiết giá</h6>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <span>Người lớn <b>x</b> <span class="numberAdultTotal">1</span></span>
                                    <span class="fw-bold adultTotalPrice"><?php echo ps_price($adultprice) ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Trẻ em <b>x</b> <span class="numberChildTotal">0</span></span>
                                    <span class="fw-bold childTotalPrice">0 đ</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Trẻ nhỏ <b>x</b> <span class="numberBabyTotal">0</span></span>
                                    <span class="fw-bold babyTotalPrice">0 đ</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>VAT</span>
                                    <span class="fw-bold vatTotalPrice"><?php echo ps_price($adultprice * ($vat * 1 / 100)) ?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6>Tổng tiền</h6>
                            <h5 class="text-danger total-price"><?php echo ps_price($adultprice + $adultprice * ($vat * 1 / 100)) ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bookingtour.js">
    </script>
</body>

</html>