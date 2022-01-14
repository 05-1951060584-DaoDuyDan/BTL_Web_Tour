<?php include('partials-front/header.php')
    // session_start(); //Dịch vụ bảo vệ
    // if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
    //     header("Location:../login.php");
    // }
    //     include '../config.php';
?>

<body class="bg-cuatoi">
    <div class="container">
        <a href="add-room.php" class="btn btn-success m-2">Thêm Tour</a>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên Tour</th>
                        <th scope="col">Điểm bắt đầu</th>
                        <th scope="col">Điểm kết thúc</th>
                        <th scope="col">Số ngày</th>
                        <th scope="col">Khuyến mãi</th>
                        <th scope="col">Thông tin tour</th>
                        <th scope="col">Trả góp</th>
                        <th scope="col">Quy định tour</th>
                        <th scope="col">Tình trạng tour</th>
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
                        $sql = "SELECT * FROM tb_tour, tb_typetour, tb_touroperation WHERE tbl_hotel.id_hotel = tbl_room.id_hotel AND tbl_typeroom.id_typeroom = tbl_room.id_typeroom";
                        $res = mysqli_query($conn,$sql);
                        $sn = 1;
                        if(mysqli_num_rows($res) > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id_room'];
                                $name = $row['name_room'];
                                $price = $row['priceofday_room'];
                                $customermax = $row['customermax_room'];
                                $type = $row['name_typeroom'];
                                $name_hotel = $row['name_hotel'];
                                if($row['status_room'] == 0)
                                    $status = 'Không hoạt động';
                                else
                                    $status = 'Hoạt động';
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $sn++; ?></th>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $customermax; ?></td>
                                    <td> <?php echo $type; ?></td>
                                    <td><?php echo $name_hotel; ?></td>
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