<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST)) {
        $id = $_POST['id'];
        $startDay = $_POST['startDay'];
        $endDay = $_POST['endDay'];
        $wdStart = $_POST['ws'];
        $wdEnd = $_POST['we'];
        $adultPrice = $_POST['adultPrice'];
        $childPrice = $_POST['childPrice'];
        $vat = $_POST['vat'];
        $tour_code = $_POST['tourcode'];
        $status = '1';
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("UPDATE `tb_startendday` SET `startday` = ?, `endday` = ?, `wdstart` = ?, `wdend` = ?, `childprice` = ?, `adultprice` = ?, `vat` = ?, `status_ startendday` = ? WHERE `id_startendday` = ? AND `tour_code` = ?");
        $stmt->bindParam(1, $startDay);
        $stmt->bindParam(2, $endDay);
        $stmt->bindParam(3, $wdStart);
        $stmt->bindParam(4, $wdEnd);
        $stmt->bindParam(5, $childPrice);
        $stmt->bindParam(6, $adultPrice);
        $stmt->bindParam(7, $vat);
        $stmt->bindParam(8, $status);
        $stmt->bindParam(9, $id);
        $stmt->bindParam(10, $tour_code);
        if ($stmt->execute()) {
?>
            <table class="table bg-secondary text-warning mt-3 mb-5">
                <thead>
                    <tr>
                        <th scope="col">Mã ngày du lịch</th>
                        <th scope="col">Ngày khởi hành</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Giá vé cho người lớn</th>
                        <th scope="col">Giá vé cho trẻ em</th>
                        <th scope="col">VAT</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqltourseday = "Select* from tb_startendday where tour_code = '{$tour_code}' and startday >= CURDATE() and status_startendday = 1 ORDER by startday";
                    $resultseday = mysqli_query($conn, $sqltourseday);
                    if (mysqli_num_rows($resultseday)) {
                        for ($i = 0; $i < mysqli_num_rows($resultseday); $i++) {
                            $rowseday = mysqli_fetch_assoc($resultseday);
                    ?>
                            <tr>
                                <td scope="row"><?php echo $rowseday['id_startendday'] ?></td>
                                <td><?php echo $rowseday['startday'] ?></td>
                                <td><?php echo $rowseday['endday'] ?></td>
                                <td><?php echo $rowseday['adultprice'] ?></td>
                                <td><?php echo $rowseday['childprice'] ?></td>
                                <td><?php echo $rowseday['vat'] ?></td>
                                <td><a data-bs-toggle="modal" data-bs-target="#editSEDay" class="editSEDay" id_service="<?php echo $row['day']; ?>"><i class="bi bi-pencil-square text-warning"></i></a></td>
                                <td><a data-bs-toggle="modal" data-bs-target="#deleteSEDay" class="deleteSEDaybtn" id_service="<?php echo $row['day']; ?>"><i class="bi bi-trash text-warning"></i></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <script>
                $(".editSEDay").click(function() {
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    $("#idSEDayUpdate").val(data[0]);
                    $("#startDayUpdate").val(data[1]);
                    $("#endDayUpdate").val(data[2]);
                    $("#adultPriceUpdate").val(data[3]);
                    $("#childPriceUpdate").val(data[4]);
                    $("#vatUpdate").val(data[5]);
                })
                $(document).ready(function() {
                    $(".deleteSEDaybtn").click(function() {
                        $tr = $(this).closest('tr');
                        var data = $tr.children("td").map(function() {
                            return $(this).text();
                        }).get();
                        $(".SEDayDelete").text(data[0]);
                    })
                })
            </script>
<?php
        }
    } else {
        echo "<p>Lỗi không xác định!</p>";
    }
}
?>