<?php

if (isset($_POST['submitaddbooking'])) {
    include "partials-front/header.php";
    $sqlcheck = "Select* from tb_tourbooking where phonenumber = '{$_POST['phonenumber']}' and tour_code = '{$_POST['tourcode']}' and id_startendday = '{$_POST['idstartendday']}'";
    $resultcheck = mysqli_query($conn, $sqlcheck);
    if(mysqli_num_rows($resultcheck)<=0){
    require_once "classprocessSQL.php";
    $ps = new Process();
    $code_bookingtour = strtoupper(substr(md5(rand()), 0, 10));
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $numberadult = $_POST['numberadultinfo'];
    $numberchild = $_POST['numberchildinfo'];
    $numberbaby = $_POST['numberbabyinfo'];
    $totalmoney = $_POST['totalmoney'];
    //$ = $_POST['']; ngày đặt
    $payments = $_POST['payments'];
    $idstartendday = $_POST['idstartendday'];
    if (isset($_POST['iduser'])) {
        $iduser = $_POST['iduser'];
    }
    $tourcode = $_POST['tourcode'];
    //echo isset($_POST['checkbox0']);
    $tourbookingdate = (string)(date('Y-m-d'));
    if (isset($_POST['iduser'])) {
        $sqlbookingtour = "Insert into tb_tourbooking(`code_bookingtour`, `namebookingtour`, `surnamebookingtour`, `gender`, `email`, `phonenumber`, `address`, `numberadult`, `numberchild`, `numberbaby`, `totalmoney`, `tourbookingdate`, `payments`, `status_bookingtour`, `complete`, `cancel`, `tour_code`, `id_startendday`, `id_user`) values
            ('{$code_bookingtour}','{$name}','{$surname}','{$gender}','{$email}','{$phonenumber}','{$address}','{$numberadult}','{$numberchild}','{$numberbaby}','{$totalmoney}','{$tourbookingdate}','{$payments}','0','0','0','{$tourcode}','{$idstartendday}','{$iduser}')";
        $result = mysqli_query($conn, $sqlbookingtour);
        if ($result) {
            $tourservice = $ps->getTourServive($tourcode);
            if ($tourservice != false) {
                $ct = count($tourservice);
                for ($i = 0; $i < count($tourservice); $i++) {
                    if (isset($_POST['checkbox' . $i])) {
                        $id_service = $_POST['checkbox' . $i];
                        $numberkh = $_POST['numberpag' . $i];
                        $sqladdservice = "INSERT INTO `tb_tourservicebookingtour`(`code_bookingtour`, `id_tourservice`, `numberofpassengers`) VALUES ('{$code_bookingtour}','{$id_service}','{$numberkh}')";
                        mysqli_query($conn, $sqladdservice);
                    } else {
                    }
                }
            }
        }
    } else {
        $sqlbookingtour = "Insert into tb_tourbooking(`code_bookingtour`, `namebookingtour`, `surnamebookingtour`, `gender`, `email`, `phonenumber`, `address`, `numberadult`, `numberchild`, `numberbaby`, `totalmoney`, `tourbookingdate`, `payments`, `status_bookingtour`, `complete`, `cancel`, `tour_code`, `id_startendday`) values
            ('{$code_bookingtour}','{$name}','{$surname}','{$gender}','{$email}','{$phonenumber}','{$address}','{$numberadult}','{$numberchild}','{$numberbaby}','{$totalmoney}','{$tourbookingdate}','{$payments}','0','0','0','{$tourcode}','{$idstartendday}')";
        $result = mysqli_query($conn, $sqlbookingtour);
        if ($result) {
            $tourservice = $ps->getTourServive($tourcode);
            if ($tourservice != false) {
                $ct = count($tourservice);
                for ($i = 0; $i < count($tourservice); $i++) {
                    if (isset($_POST['checkbox' . $i])) {
                        $id_service = $_POST['checkbox' . $i];
                        $numberkh = $_POST['numberpag' . $i];
                        $sqladdservice = "INSERT INTO `tb_tourservicebookingtour`(`code_bookingtour`, `id_tourservice`, `numberofpassengers`) VALUES ('{$code_bookingtour}','{$id_service}','{$numberkh}')";
                        mysqli_query($conn, $sqladdservice);
                    } else {
                    }
                }
            }
        }
    }
    
    //$sqlshowinfobookingtour = "Select* from tb_tourbooking where code_bookingtour = {'$code_bookingtour'}";
    //$resultSBT = mysqli_query($conn, $sqlshowinfobookingtour);
    //$rowSBT = mysqli_fetch_assoc($resultSBT);
    $rowseday = $ps->getStartEndDay($idstartendday);
?>
<main style="margin-top: 70px; margin-bottom:70px">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ms-auto me-auto">
                <div class="bg-white shadow-sm rounded p-2">
                    <h4 class="text-center text-primary">Chúc mừng bạn đã đăng ký thành công Tour của chúng tôi!</h4>
                    <h5 class="text-center">Thông tin đặt tour đã được gửi đến người quản trị Tour.</h5>
                    <h5 class="text-center">Bạn vui lòng chờ người quản trị phê duyệt trong 1 thời gian ngắn nữa.</h5>
                    <h5 class="text-center">Ghi nhớ mã đặt Tour của bạn để kiểm tra trạng thái đặt Tour thường xuyên!</h5>
                    <h5 class="text-center text-danger">Mã đặt tour của bạn: <?php echo $code_bookingtour ?></h5>
                </div>
                <div class="bg-white shadow-sm rounded p-2 mt-3">
                    <h4 class="text-center text-warning">Thông tin đơn đặt Tour!</h4>
                    <b>Mã đặt tour của bạn: <?php echo $code_bookingtour ?></b><br>
                    <b>Họ: <?php echo $surname ?></b><br>
                    <b>Tên: <?php echo $name ?></b><br>
                    <b>Giới tính: <?php echo $gender ?></b><br>
                    <b>Email: <?php echo $email ?></b><br>
                    <b>SDT: <?php echo $phonenumber ?></b><br>
                    <b>Địa chỉ: <?php echo $address ?></b><br>
                    <b>Số người lớn: <?php echo $numberadult ?></b><br>
                    <b>Số trẻ em: <?php echo $numberchild ?></b><br>
                    <b>Số trẻ nhỏ: <?php echo $numberbaby ?></b><br>
                    <b>Tổng tiền: <?php echo ps_price($totalmoney) ?></b><br>
                    <b>Ngày đặt tour: <?php echo $tourbookingdate ?></b><br>
                    <b>Phương thức thanh toán: <?php echo $payments ?></b><br>
                    <b>Trạng thái Tour: Đang chờ duyệt</b><br>
                    <b>Mã Tour Du Lịch: <?php echo $tourcode ?></b><br>
                    <b>Ngày bắt đầu: <?php echo $rowseday['startday']  ?></b><br>
                    <b>Ngày kết thúc: <?php echo $rowseday['endday'] ?></b><br><br>
                    <h5>Những dịch vụ đi kèm:</h5>
                    <?php
                    // $rowserv = $ps->getservicebooktour($rowSBT['code_bookingtour']);
                    // for($i = 0; $i < count($rowserv); $i++){
                    //     $rowse = $rowserv[$i];
                    //     echo "<b>Tên dịch vụ: {$rowse['nameservice']} | Số hành khách: {$rowse['numberofpassengers']}</b><br>";
                    // }
                    $ct = count($tourservice);
                    for ($i = 0; $i < count($tourservice); $i++) {
                        if (isset($_POST['checkbox' . $i])) {
                            $id_service = $_POST['checkbox' . $i];
                            $numberkh = $_POST['numberpag' . $i];
                            $rowser = $ps->getOneServive($id_service);
                            echo "<b>Tên dịch vụ: {$rowser['nameservice']} | Số hành khách: {$numberkh}</b><br>";
                        } else {
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    }else{
        header("location: informationtour.php?tourcode={$_POST['tourcode']}");
    }
} else {
    header("location: index.php");
}
?>