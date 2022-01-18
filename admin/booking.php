<?php
include('partials-front/header.php');
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
} else {
    header('location: ../index.php');
}

?>

<body>
    <div class="container ">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Số thứ tự</th>
                        <!-- <th scope="col">Tên người dùng</th> -->
                        <th scope="col">Mã Đặt Tour</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Họ</th>
                        <th scope="col">Giới tính</th>
                        <!-- <th scope="col">Email</th> -->
                        <th scope="col">Số điện thoại</th>
                        <!-- <th scope="col">Địa chỉ</th> -->
                        <th scope="col">Số người lớn</th>
                        <th scope="col">Số trẻ em</th>
                        <th scope="col">Số bé</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Ngày đặt</th>
                        <!-- <th scope="col">Thanh toán</th> -->
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hoàn thành</th>
                        <!-- <th scope="col">Hủy bỏ</th> -->
                        <th scope="col">Mã tour</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Mở</th>
                        <th scope="col">Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tb_tour, tb_startendday, tb_tourbooking WHERE tb_tour.tour_code = tb_tourbooking.tour_code  AND tb_tourbooking.id_startendday = tb_startendday.id_startendday";
                    $res = mysqli_query($conn, $sql);
                    $sn = 1;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            //$nameuser = $row['nameuser'];
                            $code_bookingtour = $row['code_bookingtour'];
                            $namebookingtour = $row['namebookingtour'];
                            $surnamebookingtour = $row['surnamebookingtour'];
                            $gender = $row['gender'];
                            // $email = $row['email'];
                            $phonenumber = $row['phonenumber'];

                            // $address = $row['address'];
                            $numberadult = $row['numberadult'];
                            $numberchild = $row['numberchild'];
                            $numberbaby = $row['numberbaby'];
                            $totalmoney = $row['totalmoney'];
                            $tourbookingdate = $row['tourbookingdate'];
                            $payments = $row['payments'];
                            if ($row['status_bookingtour'] == 0)
                                $status = 'Chưa trả';
                            else
                                $status = 'Đã trả';
                            $complete = $row['complete'];
                            $cancel = $row['cancel'];
                            $nametour = $row['tour_code'];
                            $startday = $row['startday'];



                    ?>
                            <tr>
                                <th scope="row"><?php echo $sn++; ?></th>
                                
                                <td><?php echo $code_bookingtour; ?></td>
                                <td><?php echo $namebookingtour; ?></td>
                                <td> <?php echo $surnamebookingtour; ?></td>
                                <td><?php echo $gender; ?></td>

                                <td><?php echo $phonenumber; ?></td>

                                <td><?php echo $numberadult; ?></td>
                                <td><?php echo $numberchild; ?></td>
                                <td><?php echo $numberbaby; ?></td>
                                <td><?php echo $totalmoney; ?></td>
                                <td><?php echo $tourbookingdate; ?></td>

                                <td><?php echo $status; ?></td>
                                <td><?php echo $complete; ?></td>
                                <td><?php echo $nametour; ?></td>
                                <td><?php echo $startday; ?></td>
                                <td>
                                    <a href="update-room.php?id=<?php echo $id; ?>">
                                        <i class="fas fa-lock text-center" style="color:blue"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="delete-room.php?id=<?php echo $id; ?>">
                                        <i class="fas fa-lock-open text-center" style="color:red"></i>
                                    </a>
                                </td>
                                <td class="text-center text-primary clickBooking" data-bs-toggle="modal" data-bs-target="#informationBookingTour"><a href="#"><i class="bi bi-info-circle"></i></a></td>
                            </tr>
                    <?php
                        }
                    } else {
                    }
                    ?>
            </table>
            <div class="inforbook">
                <div class="modal fade" id="informationBookingTour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết đơn đặt Tour</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            /*
            <td><?php echo $email; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $payments; ?></td>
<!-- <td><?php echo $nameuser; ?></td> -->
            */
            ?>
        </div>
    </div>
</body>

<?php
include('partials-front/footer.php');
?>