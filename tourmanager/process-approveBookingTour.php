<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST['codebookingtour'])) {
        $count = 0;
        $codebookingtour = $_POST['codebookingtour'];
        $tour_code = $_POST['tourcode'];
        $stmt = $dbh->prepare("Update tb_tourbooking set status_bookingtour = ? where code_bookingtour = ?");
        $rt = 1;
        $stmt->bindParam(1, $rt);
        $stmt->bindParam(2, $codebookingtour);
        $stmt->execute() ? $count++ : $count = 0;
        if ($count != 0) {
            require_once "../classprocessSQL.php";
            $ps = new Process();
            require_once "../process-string.php";
?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã đặt tour</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Ngày đặt Tour</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Mã Tour</th>
                        <th scope="col">Ngày khởi hành</th>
                        <th scope="col">Phê duyệt</th>
                        <th scope="col">Xem chi tiết</th>
                        <th scope="col">Hủy Booking</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($ps->getBookingTourChoOperator($tour_code) != false) {
                        $rowBookingTourUser = $ps->getBookingTourChoOperator($tour_code);
                        for ($i = 0; $i < count($rowBookingTourUser); $i++) {
                            $rowbooking = $rowBookingTourUser[$i];
                            $rowseday = $ps->getStartEndDay($rowbooking['id_startendday']);
                    ?>
                            <tr>
                                <td scope="row"><?php echo $rowbooking['code_bookingtour'] ?></td>
                                <td><?php echo ps_price($rowbooking['totalmoney']) ?></td>
                                <td><?php echo $rowbooking['tourbookingdate'] ?></td>
                                <td>Chờ phê duyệt</td>
                                <td><?php echo $rowbooking['tour_code'] ?></td>
                                <td><?php echo date('d-m-Y', strtotime($rowseday['startday'])) ?></td>
                                <td class="text-center text-primary deleteBKTE" data-bs-toggle="modal" data-bs-target="#approveBookingTour"><i class="bi bi-check2"></i></td>
                                <td class="text-center text-primary"><i class="bi bi-info-circle"></i></td>
                                <td class="text-center text-primary deleteBKTE" data-bs-toggle="modal" data-bs-target="#deleteBookingTour"><i class="bi bi-x-lg"></i></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <script>
                $(".deleteBKTE").click(function() {
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    $(".idBookingTours").text(data[0]);
                })
                $(".PDBKT").click(function() {
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    $(".idBookingTour").text(data[0]);
                })
            </script>
<?php
        }
    }
}
?>