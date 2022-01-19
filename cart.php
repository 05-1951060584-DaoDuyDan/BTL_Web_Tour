<?php
include('.//partials-front/header.php');
if (!isset($_SESSION['LoginOK'])) {
    header('location: index.php');
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <header class="container" style="margin-top: 66px;">
        <div class="row">
            <h1>Giỏ hàng</h1>
            <p>Tour(1)</p>
            <?php
            $sql = "Select* from tb_tourcart, tb_tour, tb_startendday, tb_typetour where tb_tour.id_typetour = tb_typetour.id_typetour and tb_tourcart.tour_code = tb_tour.tour_code and tb_tourcart.id_startendday = tb_startendday.id_startendday and id_user = {$id_user}";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)){
                $row = mysqli_fetch_assoc($result);
                if(date('d-m-Y',strtotime($row['startday']))>date('d-m-Y')){

            ?>
            <div class="col-md border border-1 p-3 cart-content bg-white">
                <div class="col-md-2 mt-3">
                    <img src="images/Tour/DaNang_BaNa_NguHanhSon_HoiAn.png" class="img-fluid" alt="" style="max-width: 150px; max-height: 100%">
                </div>
                <div class="col-md-3 me-5" style="text-align: justify;">
                    <h4><?php echo $row['nametour'] ?></h4>
                    <p>Lịch trình <br>
                        <?php echo $row['startinglocation'] ?> - <?php echo $row['endinglocation'] ?><br>
                        Số khách: 1 người lớn<br>
                        Loại tour: <?php echo $row['nametypetour'] ?></p>
                </div>
                <div class="col-md-3 cart-days">
                    <div class="p-1 border border-radius">
                        <div class="d-flex flex-row justify-content-center">
                            <div class="d-flex flex-column text-center me-5">
                                <p>Ngày khởi hành</p>
                                <b><?php echo ps_date($row['startday']) ?></b>
                            </div>
                            <hr width="1px" height="30px">
                            <div class="d-flex flex-column text-center">
                                <p>Ngày kết thúc</p>
                                <b><?php echo ps_date($row['endday']) ?></b>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <p class="text-center mt-2"><?php echo $row['numberofdays'] ?> ngày, <?php echo $row['numberofdays']-1 ?> đêm</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column justify-content-end">
                        <h3 class="text-end"> <?php echo ps_price($row['adultprice']) ?> </h3>
                        <i class="text-end mb-2">Chưa bao gồm thuế và phí</i>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary rounded-pill" href="bookingtour.php?idse=<?php echo $row['id_startendday']?>&tourcode=<?php echo $row['tour_code']?>" style="max-width: 90px">Đặt Tour</a>
                        </div>
                    </div>
                </div>
            </div>
    </header>
    <?php

    include('.//partials-front/footer.php');
    }else{
        $sql = "Delete from tb_cart where id_user = {$id_user}";
        $result = mysqli_query($conn, $sql);
    }
}
}
    ?>