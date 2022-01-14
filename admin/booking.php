<?php include('partials-front/header.php')
    
?>

<body >
    <div class="container">
        <a href="add-room.php" class="btn btn-success m-2">Thêm Tour</a>
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
                        $sql = "SELECT * FROM tb_tour, tb_startendday, tb_tourbooking WHERE tb_tour.tour_code = tb_tourbooking.tour_code AND tb_tourbooking.id_startendday = tb_startendday.id_startendday";
                        $res = mysqli_query($conn,$sql);
                        $sn = 1;
                        if(mysqli_num_rows($res) > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id_user = $row['tour_code'];
                                $code_bookingtour = $row['nametour'];
                                $namebookingtour = $row['startinglocation'];
                                $surnamebookingtour = $row['endinglocation'];
                                $gender = $row['numberofdays'];
                                $email = $row['tourdiscount'];
                                $phonenumber = $row['tourinfo'];
                                
                                $address = $row['tourregulations'];
                                $numberadult = $row['conditiontour'];
                                $numberchild = $row['tourdepartureschedule'];
                                $numberbaby = $row['nametypetour'];
                                $totalmoney = $row['nametouroperator'];
                                $tourbookingdate = $row['nametouroperator'];
                                $payments = $row['nametouroperator'];
                                if($row['status_bookingtour'] == 0)
                                    $status = 'Không hoạt động';
                                else
                                    $status = 'Hoạt động';
                                $complete = $row['nametouroperator'];
                                $cancel = $row['nametouroperator'];
                                $nametour = $row['nametouroperator'];
                                $startday = $row['nametouroperator'];
                            


                                ?>
                                <tr>
                                    <th scope="row"><?php echo $sn++; ?></th>
                                    <td><?php echo $nametour; ?></td>
                                    <td><?php echo $startinglocation; ?></td>
                                    <td><?php echo $endinglocation; ?></td>
                                    <td> <?php echo $numberofdays; ?></td>
                                    <td><?php echo $tourdiscount; ?></td>
                                    <td><?php echo $tourinfo; ?></td>
                                    <td><?php echo $installment; ?></td>
                                    <td><?php echo $tourregulations; ?></td>
                                    <td><?php echo $conditiontour; ?></td>
                                    <td><?php echo $tourdepartureschedule; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $nametypetour; ?></td>
                                    <td><?php echo $nametouroperator; ?></td>
                                    <td><?php echo $status; ?></td>
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