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

<?php
        } else {
            echo "Không thành công!";
        }
    } else {
        header("location: tourmanager.php");
    }
}
