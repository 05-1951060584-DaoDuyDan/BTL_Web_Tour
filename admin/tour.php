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
                        $sql = "SELECT * FROM tb_tour, tb_typetour, tb_touroperator WHERE tb_tour.id_typetour = tb_typetour.id_typetour AND tb_touroperator.id_touroperator = tb_tour.id_touroperator";
                        $res = mysqli_query($conn,$sql);
                        $sn = 1;
                        if(mysqli_num_rows($res) > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $tour_code = $row['tour_code'];
                                $nametour = $row['nametour'];
                                $startinglocation = $row['startinglocation'];
                                $endinglocation = $row['endinglocation'];
                                $numberofdays = $row['numberofdays'];
                                $tourdiscount = $row['tourdiscount'];
                                $tourinfo = $row['tourinfo'];
                                if($row['installment'] == 0)
                                    $installment = 'Không hoạt động';
                                else
                                    $installment = 'Hoạt động';
                                $tourregulations = $row['tourregulations'];
                                $conditiontour = $row['conditiontour'];
                                $tourdepartureschedule = $row['tourdepartureschedule'];
                                $nametypetour = $row['nametypetour'];
                                $nametouroperator = $row['nametouroperator'];
                                if($row['status_tour'] == 0)
                                    $status = 'Không hoạt động';
                                else
                                    $status = 'Hoạt động';


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