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
        // $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        // $stmt = $dbh->prepare("");
        // $stmt->bindParam(1, $nameservice);
        // $stmt->bindParam(2, $priceservice);
        // $stmt->bindParam(3, $tour_code);
        $count = 0;
        $sql = "Select* from tb_tourservice where nameservice = '{$nameservice}' and priceservice = {$priceservice} and tour_code = '{$tour_code}' ";
        $sqlcheck = "Select* from tb_tourservice where nameservice = '{$nameservice}' and priceservice = {$priceservice} and tour_code = '{$tour_code}' ";
        $result = mysqli_query($conn, $sqlcheck);
        if(mysqli_num_rows($result)==0){
            $sql = "INSERT INTO `tb_tourservice` (`nameservice`, `priceservice`, `tour_code`) VALUES ('{$nameservice}', {$priceservice}, '{$tour_code}')";
        }
        if (mysqli_query($conn, $sql) && $count ==0) {
            $count++;
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
                                <td><i class="bi bi-pencil-square text-warning updateTourServiceClick" data-bs-toggle="modal" data-bs-target="#editServiceTour"></i></td>
                                <td><i class="bi bi-trash text-warning deleteTourServiceClick" data-bs-toggle="modal" data-bs-target="#deleteTourService"></i></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $(".updateTourServiceClick").click(function() {
                        $tr = $(this).closest('tr');
                        var data = $tr.children("td").map(function() {
                            return $(this).text();
                        }).get();
                        $("#idTourServiceUpdate").val(data[0]);
                        $("#nameServiceUpdate").val(data[1]);
                        $("#priceServiceUpdate").val(data[2]);
                    })
                })
                $(".deleteTourServiceClick").click(function() {
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    $(".idservicedelete").text(data[0]);
                    //$(".daydeleteout").val(data[0]);
                })
            </script>
<?php
        } else {
            echo "Không thành công!";
        }
    } else {
        header("location: tourmanager.php");
    }
}
