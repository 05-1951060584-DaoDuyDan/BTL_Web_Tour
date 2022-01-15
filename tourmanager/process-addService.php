<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST)) {
        require_once "../classprocessSQL.php";
        require_once "../process-string.php";
        $ps = new Process();
        $nameservice = $_POST['nameservice'];
        $priceservice = $_POST['priceservice'];
        $tour_code = $_POST['tourcode'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("INSERT INTO `tb_tourservice` (`nameservice`, `priceservice`, `tour_code`) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $nameservice);
        $stmt->bindParam(2, $priceservice);
        $stmt->bindParam(3, $tour_code);
        if ($stmt->execute()) {
?>
            <table class="table mt-2 bg-white shadow-sm rounded">
                <h4 class="mt-2">Danh sách các dịch vụ của Tour</h4>
                <thead>
                    <tr>
                        <th scope="col">Mã dịch vụ</th>
                        <th scope="col">Tên dịch vụ</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <?php
                $tourservice = $ps->getTourServive($tour_code);
                ?>
                <tbody>
                    <?php
                    if ($tourservice != false) {
                        for ($i = 0; $i < count($tourservice); $i++) {
                            $rowservice = $tourservice[$i];
                    ?>
                            <tr>
                                <td scope="row"><?php echo $rowservice['id_tourservice'] ?></td>
                                <td><?php echo $rowservice['nameservice'] ?></td>
                                <td><?php echo $rowservice['priceservice'] ?></td>
                                <td><i class="bi bi-pencil-square text-warning updateTourServiceClick"></i></td>
                                <td><i class="bi bi-trash text-warning"></i></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
<?php
        } else {
            echo "Không thành công!";
        }
    } else {
        header("location: tourmanager.php");
    }
}
