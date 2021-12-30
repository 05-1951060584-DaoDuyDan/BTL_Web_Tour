<?php
// $tour_code = $_POST['tour_code'];
// print $tour_code;
session_start();
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: index.php');
} else {
    if (isset($_POST['btnaddtour'])) {
        require('partials-front/header.php');
        $sqlstatustour = "Select* from tb_touroperator, tb_user where tb_user.id_user = tb_touroperator.id_user and tb_user.email = '{$user}'";
        $resultstatustour =  mysqli_query($conn, $sqlstatustour);
        if (mysqli_num_rows($resultstatustour) > 0) {
            $row = mysqli_fetch_assoc($resultstatustour);
        }
        $tour_code = $_POST['tour_code'];
        $typetour = $_POST['typetour'];
        $nametour = $_POST['nametour'];
        $startlocation = $_POST['startlocation'];
        $endlocation = $_POST['endlocation'];
        $numberofdays = $_POST['numberofdays'];
        $tourinfo = $_POST['tourinfo'];
        if ($tourtragop = $_POST['inlineRadioOptions'] == "option1") {
            $tourinstallemnt = 1;
        } else {
            $tourinstallemnt = 0;
        }
        $tourdiscount = $_POST['tourdiscount'];
        $quydinhtour = $_POST['quydinhtour'];
        $khuyenmaitour = $_POST['khuyenmaitour'];
        $chinhsachtour = $_POST['chinhsachtour'];
        $sqladdtour = "Insert into tb_tour Values('{$tour_code}','{$nametour}','{$startlocation}','{$endlocation}',{$numberofdays},{$tourdiscount}, '{$tourinfo}', {$tourinstallemnt} ,'{$quydinhtour}','{$khuyenmaitour}','{$chinhsachtour}', 0, 1, {$row['id_touroperator']})";
        if (!mysqli_query($conn, $sqladdtour)) {
            header("location: add-tour.php");
        }
        $sqlstatustour = "Select* from tb_touroperator, tb_user, tb_tour where tb_user.id_user = tb_touroperator.id_user and tb_user.email = '{$user}' and tour_code = '{$tour_code}'";
        $resultstatustour =  mysqli_query($conn, $sqlstatustour);
        if (mysqli_num_rows($resultstatustour) > 0) {
            $row = mysqli_fetch_assoc($resultstatustour);
        }
    } else {
        require('partials-front/header.php');
        if(isset($_GET['themthongtintour'])){
            $tour_code_post = $_GET['tour_code_update'];
            $sqlstatustour = "Select* from tb_tour, tb_touroperator, tb_user where tb_user.id_user = tb_touroperator.id_user and tb_tour.id_touroperator = tb_touroperator.id_touroperator and tb_tour.status_tour = 0 and tb_user.email = '{$user}' and tour_code = '{$tour_code_post}'";
            $resultstatustour =  mysqli_query($conn, $sqlstatustour);
            if (mysqli_num_rows($resultstatustour) > 0) {
                $row = mysqli_fetch_assoc($resultstatustour);
            }
            $tour_code = $row['tour_code'];
            $nametour = $row['nametour'];
        }
        if(isset($_POST['btndayoftour'])){
            $dayk = $_POST['songay'];
            $tour_code = $_POST['tourcode-active'];
            $nametour = $_POST['nametour'];
            $sqlstatustour = "Select* from tb_tour, tb_touroperator, tb_user where tb_user.id_user = tb_touroperator.id_user and tb_tour.id_touroperator = tb_touroperator.id_touroperator and tb_tour.status_tour = 0 and tb_user.email = '{$user}' and tour_code = '{$tour_code}'";
            $resultstatustour =  mysqli_query($conn, $sqlstatustour);
            if (mysqli_num_rows($resultstatustour) > 0) {
                $row = mysqli_fetch_assoc($resultstatustour);
            }
            $sqldayoftour = "Insert into tb_tourday values('{$tour_code}','{$dayk}','{$_POST['nametourday']}','{$_POST['morningtour']}','{$_POST['noonofday']}','{$_POST['afternoonofday']}','{$_POST['nightofday']}')";
            mysqli_query($conn, $sqldayoftour);
        }
    }
}
require "partials-front/footer.php";
?>
<div class="main" style="margin-top: 66px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                $sqlcheckday = "Select count(tour_code) as soluong from tb_tourday where tour_code = '{$tour_code}'";
                $resultcheckday = mysqli_query($conn, $sqlcheckday);
                $rowcheckday = mysqli_fetch_assoc($resultcheckday);
                $soluong = $rowcheckday['soluong'];
                if ($soluong < $row['numberofdays']) {
                ?>
                    <h4>Nhập thông tin ngày thứ <?php echo $soluong + 1 ?> cho tour</h4>
                    <p>Mã tour: <?php echo $tour_code  ?></p>
                    <p>Tên tour: <?php echo $nametour  ?></p>
                    <form action="process-addtour.php" method="POST" class="form-control">
                        <input type="text" style="display: none" value=<?php echo $tour_code  ?> name="tourcode-active">
                        <input type="text" style="display: none" value=<?php echo $nametour  ?> name="nametour">
                        <div class="col-md me-1 mt-3">
                            <label for="exampleInputEmail1" class="form-label fw-bold">Nhập địa điểm dừng chân tại ngày thứ <?php echo $soluong + 1 ?></label>
                            <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="nametourday" required>
                        </div>
                        <div class="col-md me-1 mt-3" style="display: none;">
                            <input type="text" class="form-control" name="songay" value=<?php echo $soluong + 1 ?> aria-describedby="emailHelp" name="nametour" required>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="morningtour" required></textarea>
                                <label for="floatingTextarea2" class="fw-bold">Buổi sáng tại địa điểm thứ <?php echo $soluong + 1 ?>(Mỗi câu cách nhau bằng 1 dấu chấm)</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="noonofday" required></textarea>
                                <label for="floatingTextarea2" class="fw-bold">Buổi trưa tại địa điểm thứ <?php echo $soluong + 1 ?>(Mỗi câu cách nhau bằng 1 dấu chấm)</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="afternoonofday" required></textarea>
                                <label for="floatingTextarea2" class="fw-bold">Buổi chiều tại địa điểm thứ <?php echo $soluong + 1 ?>(Mỗi câu cách nhau bằng 1 dấu chấm)</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="nightofday" required></textarea>
                                <label for="floatingTextarea2" class="fw-bold">Buổi tối tại địa điểm thứ <?php echo $soluong + 1 ?>(Mỗi câu cách nhau bằng 1 dấu chấm)</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-primary mt-1 rounded-pill" type="submit" name="btndayoftour">Tiếp Tục Đăng Ký</button>
                        </div>
                    </form>
                <?php
                } else {
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
require "partials-front/footer.php";
?>