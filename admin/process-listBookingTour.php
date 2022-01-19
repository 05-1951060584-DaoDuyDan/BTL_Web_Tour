<?php
if(isset($_POST['tourcode'])){
    $tour_code = $_POST['tourcode'];
    require "../config/config.php";
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <!-- <th scope="col">Tên người dùng</th> -->
                <th scope="col">Mã Đặt Tour</th>
                <th scope="col">Tên</th>
                <th scope="col">Họ</th>
                <th scope="col">Giới tính</th>
                <!-- <th scope="col">Email</th> -->
                <th scope="col">Số điện thoại</th>
                <!-- <th scope="col">Địa chỉ</th> -->
                <th scope="col">Người lớn</th>
                <th scope="col">Trẻ em</th>
                <th scope="col">Trẻ nhỏ</th>
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
            $sql = "SELECT * FROM tb_tour, tb_startendday, tb_tourbooking WHERE tb_tour.tour_code = tb_tourbooking.tour_code  AND tb_tourbooking.id_startendday = tb_startendday.id_startendday AND tb_tour.tour_code = '{$tour_code}'";
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
    <?php
}

?>