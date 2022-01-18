<?php
if (isset($_POST['submitsearchbooking']) && $_POST['codebookingtour'] != '') {
    include "partials-front/header.php";
    $ps = new Process();
    $codebookingtour = $_POST['codebookingtour'];
    echo $codebookingtour;
    $sqlshowinfobookingtour = "Select* from tb_tourbooking where code_bookingtour = '{$codebookingtour}'";
    $resultSBT = mysqli_query($conn, $sqlshowinfobookingtour);
    if(mysqli_num_rows($resultSBT)>0){
    $rowSBT = mysqli_fetch_assoc($resultSBT);
    $rowseday = $ps->getStartEndDay($rowSBT['id_startendday']);
    $tt = "";
    if($rowSBT['status_bookingtour']==0){
        $tt = "Đang chờ duyệt";
    }else if($rowSBT['status_bookingtour']==1 && $rowSBT['complete']==0){
        $tt = "Đang phục vụ";
    }else if($rowSBT['status_bookingtour']==1 && $rowSBT['complete']==1){
        $tt = "Hoàn thành!";
    }
?>
    <main style="margin-top: 70px; margin-bottom:70px">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ms-auto me-auto">
                    <div class="bg-white shadow-sm rounded p-2">
                        <h4 class="text-center text-primary">Thông tin mã đặt tour!</h4>
                    </div>
                    <div class="bg-white shadow-sm rounded p-2 mt-3">
                        <b>Mã đặt tour của bạn: <?php echo $codebookingtour ?></b><br>
                        <b>Họ: <?php echo $rowSBT['surnamebookingtour'] ?></b><br>
                        <b>Tên: <?php echo $rowSBT['namebookingtour'] ?></b><br>
                        <b>Giới tính: <?php echo $rowSBT['gender'] ?></b><br>
                        <b>Email: <?php echo $rowSBT['email'] ?></b><br>
                        <b>SDT: <?php echo $rowSBT['phonenumber'] ?></b><br>
                        <b>Địa chỉ: <?php echo $rowSBT['address'] ?></b><br>
                        <b>Số người lớn: <?php echo $rowSBT['numberadult'] ?></b><br>
                        <b>Số trẻ em: <?php echo $rowSBT['numberchild'] ?></b><br>
                        <b>Số trẻ nhỏ: <?php echo $rowSBT['numberbaby'] ?></b><br>
                        <b>Tổng tiền: <?php echo ps_price($rowSBT['totalmoney']) ?></b><br>
                        <b>Ngày đặt tour: <?php echo $rowSBT['tourbookingdate'] ?></b><br>
                        <b>Phương thức thanh toán: <?php echo $rowSBT['payments'] ?></b><br>
                        <b>Trạng thái Tour: <?php echo $tt; ?></b><br>
                        <b>Mã Tour Du Lịch: <?php echo $rowSBT['tour_code'] ?></b><br>
                        <b>Ngày bắt đầu: <?php echo $rowseday['startday']  ?></b><br>
                        <b>Ngày kết thúc: <?php echo $rowseday['endday'] ?></b><br><br>
                        <h5>Những dịch vụ đi kèm:</h5>
                        <?php
                        $rowserv = $ps->getservicebooktour($rowSBT['code_bookingtour']);
                        if($rowserv!=false){
                            for($i = 0; $i < count($rowserv); $i++){
                                $rowse = $rowserv[$i];
                                echo "<b>Tên dịch vụ: {$rowse['nameservice']} | Số hành khách: {$rowse['numberofpassengers']}</b><br>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
    }
} else {
    header("location: index.php");
}
?>