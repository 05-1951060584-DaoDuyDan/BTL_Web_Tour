<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST)) {
        $tourco = $_POST['tourcodeupdate'];
        $dayupdate = $_POST['dayupdate'];
        $nametourdayupdate = $_POST['nametourdayupdate'];
        $morningtourupdate = $_POST['morningtourupdate'];
        $noonupdate = $_POST['noonupdate'];
        $afternoonupdate = $_POST['afternoonupdate'];
        $nightupdate = $_POST['nightupdate'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("UPDATE `tb_tourday` SET `location` = ?, `morning` = ?, `noon` = ?, `afternoon` = ?, `night` = ? where `day` = ? and `tour_code` = ?");
        $stmt->bindParam(1, $nametourdayupdate);
        $stmt->bindParam(2, $morningtourupdate);
        $stmt->bindParam(3, $noonupdate);
        $stmt->bindParam(4, $afternoonupdate);
        $stmt->bindParam(5, $nightupdate);
        $stmt->bindParam(6, $dayupdate);
        $stmt->bindParam(7, $tourco);
        if ($stmt->execute()) {
            $sql1 = "SELECT day, location, morning, noon, afternoon, night, numberofdays from tb_tourday, tb_tour where tb_tour.tour_code = '{$tourco}' and tb_tourday.tour_code = tb_tour.tour_code";
            $result =  mysqli_query($conn, $sql1);
?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Ngày thứ</th>
                        <th scope="col">Địa điểm</th>
                        <th scope="col">Buổi sáng</th>
                        <th scope="col">Buổi trưa</th>
                        <th scope="col">Buổi chiều</th>
                        <th scope="col">Buổi tối</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $row['day']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['morning']; ?></td>
                            <td><?php echo $row['noon']; ?></td>
                            <td><?php echo $row['afternoon']; ?></td>
                            <td><?php echo $row['night']; ?></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#edittourday" class="edittourday" id_service="<?php echo $row['day']; ?>"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#deletetourday" class="deletetourday" id_service="<?php echo $row['day']; ?>"><i class="bi bi-trash"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <script>
                $(".edittourday").click(function() {
                    $tr = $(this).closest('tr');
                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();
                    $("#dayupdate").attr('value', data[0]);
                    $("#nametourdayupdate").val(data[1]);
                    $("#morningtourupdate").val(data[2]);
                    $("#noonupdate").val(data[3]);
                    $("#afternoonupdate").val(data[4]);
                    $("#nightupdate").val(data[5]);
                })
            </script>
<?php
        }
    }
}
?>