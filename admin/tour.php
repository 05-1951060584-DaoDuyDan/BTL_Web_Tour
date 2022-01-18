<?php
include('partials-front/header.php');
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
} else {
    header('location: ../index.php');
}
?>

<body>
    <div class="container">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã Tour</th>
                        <!-- <th scope="col">Tên Tour</th> -->
                        <th scope="col">Điểm bắt đầu</th>
                        <th scope="col">Điểm kết thúc</th>
                        <th scope="col">Số ngày</th>
                        <th scope="col">Khuyến mãi</th>
                        <th scope="col">Trả góp</th>
                        <th scope="col">Loại tour</th>
                        <th scope="col">Người điều hành tour</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Khóa tour</th>
                        <th scope="col">Mở tour</th>
                        <th scope="col">Xem chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tb_tour, tb_typetour, tb_touroperator WHERE tb_tour.id_typetour = tb_typetour.id_typetour AND tb_touroperator.id_touroperator = tb_tour.id_touroperator";
                    $res = mysqli_query($conn, $sql);
                    $sn = 1;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $tour_code = $row['tour_code'];
                            $nametour = $row['nametour'];
                            $startinglocation = $row['startinglocation'];
                            $endinglocation = $row['endinglocation'];
                            $numberofdays = $row['numberofdays'];
                            $tourdiscount = $row['tourdiscount'];
                            $tourinfo = $row['tourinfo'];
                            if ($row['installment'] == 0)
                                $installment = 'Không';
                            else
                                $installment = 'Có';
                            $tourregulations = $row['tourregulations'];
                            $conditiontour = $row['conditiontour'];
                            $tourdepartureschedule = $row['tourdepartureschedule'];
                            $nametypetour = $row['nametypetour'];
                            $nametouroperator = $row['nametouroperator'];
                            if ($row['status_tour'] == 0)
                                $status = 'Không hoạt động';
                            else
                                $status = 'Hoạt động';
                            $sqltour = "SELECT * FROM tb_tour where tour_code = '{$tour_code}'";
                            $resulttour = mysqli_query($conn, $sqltour);
                            $rowtour = mysqli_fetch_assoc($resulttour);
                            if($rowtour['lock']==0)
                                $lock = 'Không Khóa';
                            else
                                $lock = 'Khóa';


                    ?>
                            <tr>
                                <th scope="row"><?php echo $sn++; ?></th>
                                <td><?php echo $tour_code; ?></td>
                                <!-- <td><?/*php echo $nametour; */ ?></td> -->
                                <td><?php echo $startinglocation; ?></td>
                                <td><?php echo $endinglocation; ?></td>
                                <td> <?php echo $numberofdays; ?></td>
                                <td><?php echo $tourdiscount; ?></td>

                                <td><?php echo $installment; ?></td>

                                <td><?php echo $nametypetour; ?></td>
                                <td><?php echo $nametouroperator; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $lock; ?></td>
                                <td>
                                    <a href="process-lockTour.php?codetour=<?php echo $tour_code;?>" onclick="return confirm('Bạn chắc chắn muốn khóa Tour này?')">
                                        <i class="fas fa-lock" style="color:blue"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="process-unlockTour.php?codetour=<?php echo $tour_code;?>&idMa=<?php echo $row['id_touroperator'];?>" onclick="return confirm('Bạn chắc chắn muốn mở khóa Tour này?')">
                                        <i class="fas fa-lock-open text-center" style="color:red"></i>
                                    </a>
                                </td>
                                <td class="text-center text-primary clickinformation" data-bs-toggle="modal" data-bs-target="#infortour"><a href="#"><i class="bi bi-info-circle"></i></a></td>
                            </tr>
                    <?php
                        }
                    } else {
                    }
                    ?>
            </table>
            <div class="infortours">
                <div class="modal fade" id="infortour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
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
        </div>
    </div>
</body>

<?php include('partials-front/footer.php') ?>