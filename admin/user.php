<?php include('partials-front/header.php')
    
?>

<body class="bg-cuatoi">
    <div class="container">
        <a href="add-room.php" class="btn btn-success m-2">Thêm Tour</a>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Họ người dùng</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Mật khẩu</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Liên kết lúc</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Lịch khởi hành</th>
                        <th scope="col">Trạng thái tour</th>
                        <th scope="col">Loại tour</th>
                        <th scope="col">Người điều hành tour</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Mở</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM tb_tour, tb_typetour, tb_touroperator WHERE tb_tour.id_typetour = tb_typetour.id_typetour AND tb_touroperator.id_touroperator = tb_tour.id_touroperator";
                        $res = mysqli_query($conn,$sql);
                        $sn = 1;
                        if(mysqli_num_rows($res) > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id_user = $row['tour_code'];
                                $nameuser = $row['nameuser'];
                                $surnameuser = $row['startinglocation'];
                                $email = $row['endinglocation'];
                                $phonenumber = $row['numberofdays'];
                                $pasword = $row['tourdiscount'];
                                if($row['status_user'] == 0)
                                    $status = 'Không hoạt động';
                                else
                                    $status = 'Hoạt động';
                                
                                $email_verification_link = $row['email_verification_link'];
                                $email_verified_at = $row['email_verified_at'];
                                
                                if($row['lock'] == 0)
                                    $lock = 'Không hoạt động';
                                else
                                    $lock = 'Hoạt động';
                                if($row['admin'] == 0)
                                    $admin = 'Không hoạt động';
                                else
                                    $admin = 'Hoạt động';


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