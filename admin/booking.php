<?php include('partials-front/header.php')
    
?>

<body >
    <div class="container ">
        <!-- <a href="add-room.php" class="btn btn-success m-2">Thêm Tour</a> -->
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Mã booking</th>
                        <th scope="col">Tên tour book</th>
                        <th scope="col">Họ tour book</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số người lớn</th>
                        <th scope="col">Số trẻ em</th>
                        <th scope="col">Số bé</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hoàn thành</th>
                        <th scope="col">Hủy bỏ</th>
                        <th scope="col">Tên tour</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM tb_tour, tb_startendday, tb_tourbooking , tb_user WHERE tb_tour.tour_code = tb_tourbooking.tour_code  AND tb_user.id_user = tb_tourbooking.id_user AND tb_tourbooking.id_startendday = tb_startendday.id_startendday";
                        $res = mysqli_query($conn,$sql);
                        $sn = 1;
                        if(mysqli_num_rows($res) > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $nameuser = $row['nameuser'];
                                $code_bookingtour = $row['code_bookingtour'];
                                $namebookingtour = $row['namebookingtour'];
                                $surnamebookingtour = $row['surnamebookingtour'];
                                $gender = $row['gender'];
                                $email = $row['email'];
                                $phonenumber = $row['phonenumber'];
                                
                                $address = $row['address'];
                                $numberadult = $row['numberadult'];
                                $numberchild = $row['numberchild'];
                                $numberbaby = $row['numberbaby'];
                                $totalmoney = $row['totalmoney'];
                                $tourbookingdate = $row['tourbookingdate'];
                                $payments = $row['payments'];
                                if($row['status_bookingtour'] == 0)
                                    $status = 'Chưa trả';
                                else
                                    $status = 'Đã trả';
                                $complete = $row['complete'];
                                $cancel = $row['cancel'];
                                $nametour = $row['nametour'];
                                $startday = $row['startday'];
                            


                                ?>
                                <tr>
                                    <th scope="row"><?php echo $sn++; ?></th>
                                    <td><?php echo $nameuser; ?></td>
                                    <td><?php echo $code_bookingtour; ?></td>
                                    <td><?php echo $namebookingtour; ?></td>
                                    <td> <?php echo $surnamebookingtour; ?></td>
                                    <td><?php echo $gender; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $phonenumber; ?></td>
                                    <td><?php echo $address; ?></td>
                                    <td><?php echo $numberadult; ?></td>
                                    <td><?php echo $numberchild; ?></td>
                                    <td><?php echo $numberbaby; ?></td>
                                    <td><?php echo $totalmoney; ?></td>
                                    <td><?php echo $tourbookingdate; ?></td>
                                    <td><?php echo $payments; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $complete; ?></td>
                                    <td><?php echo $nametour; ?></td>
                                    <td><?php echo $startday; ?></td>
                                    <td>
                                        <a href="update-room.php?id=<?php echo $id;?>" class="m-l-42">
                                            <i class="fas fa-user-edit text-center" style="color:blue"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete-room.php?id=<?php echo $id;?>" class="m-l-42">
                                            <i class="fas fa-user-times" style="color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else{}
                    ?>
            </table>
        </div>
    </div>
</body>

<?php include('partials-front/footer.php') ?>