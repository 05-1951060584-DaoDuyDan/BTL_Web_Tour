<?php
require "config/config.php";
if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
    header('location: ../index.php');
} else {
    if (isset($_POST['idimages'])) {
        $id_images = $_POST['idimages'];
        $tour_code = $_POST['tourcode'];
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("Delete from `tb_tourimages` where `id_imagestour` = ?");
        $stmt->bindParam(1, $id_images);
        if ($stmt->execute()) {
            $sql2 = "Select* from tb_tourimages where tour_code = '" . $tour_code . "'";
            $result1 =  mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result1) > 0) {
                for ($i = 0; $i < mysqli_num_rows($result1); $i++) {
                    $row1 = mysqli_fetch_assoc($result1);
                    $images = $row1['images_part'];
?>
                    <div class="col-md-3 me-2 mb-3">
                        <div class="card">
                            <img src="data:image/png;base64, <?php echo base64_encode($images) ?>" class="card-img-top img-fluid" alt="...">
                            <div class="card-body">
                                <a data-bs-toggle="modal" data-bs-target="#deleteimagesday" class="btn btn-primary deleteimages">Xóa ảnh ID:<?php echo $row1['id_imagestour'] ?></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <script>
                $(".deleteimages").click(function() {
                    let ab = $(this).text();
                    let cd = ab.split(":")

                    $(".imgdelete").text(cd[1]);
                })
            </script>
<?php
        }
    } else {
        header('location: process-addtour.php');
    }
}
?>