<?php 
include('partials-front/header.php');
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    
} else {
    header('location: ../index.php');
}
?>

<div class="container-fluid bg-secondary bg-opacity-50">
    <div class="wrapper">
        <h2>Dashboard</h2>
        <br><br>

        <div class="row">
            <div class="wrapper-col-4">
                <div class="col-4">
                    <?php
                        $sql1 = "SELECT * FROM tb_tour";
                        $res1 = mysqli_query($conn, $sql1);
                        $tour = mysqli_num_rows($res1);
                        if( $tour > 0){
                            echo $tour;
                        }
                        else{
                            echo "Không có";
                        }
                    ?>
                    <br>
                    Số tour
                </div>

                <div class="col-4">
                    <?php
                        $sql2 = "SELECT * FROM tb_touroperator";
                        $res2 = mysqli_query($conn, $sql2);
                        $operator = mysqli_num_rows($res2);
                        if( $operator > 0){
                            echo $operator;
                        }
                        else{
                            echo "Không có";
                        }
                    ?>
                    <br>
                    Số người điều hành tour
                </div>

                <div class="col-4">
                    <?php
                        $sql3 = "SELECT * FROM tb_tourservice";
                        $res3 = mysqli_query($conn, $sql3);
                        $service = mysqli_num_rows($res3);
                        if( $service > 0){
                            echo $service;
                        }
                        else{
                            echo "Không có";
                        }
                    ?>
                    <br>
                    Số dịch vụ
                </div>

                <div class="col-4">
                    <?php
                        $sql4 = "SELECT * FROM tb_user";
                        $res4 = mysqli_query($conn, $sql4);
                        $user = mysqli_num_rows($res4);
                        if( $user > 0){
                            echo $user;
                        }
                        else{
                            echo "Không có";
                        }
                    ?>
                    <br>
                    Số Người dùng
                </div>

                <div class="col-4">
                    <?php
                        $sql5 = "SELECT * FROM tb_tourbooking";
                        $res5 = mysqli_query($conn, $sql5);
                        $booking = mysqli_num_rows($res5);
                        if( $booking > 0){
                            echo $booking;
                        }
                        else{
                            echo "Không có";
                        }
                    ?>
                    <br>
                    Booking
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('partials-front/footer.php') ?>