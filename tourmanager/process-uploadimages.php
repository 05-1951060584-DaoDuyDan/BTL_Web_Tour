<?php
require "config/config.php";
if (isset($_POST) && !empty($_FILES['file']) && isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '1') {
    //echo $_FILES['file']['name'];
    $tour_code =  $_POST['text'];
    $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
    // Kiểm tra xem có phải file ảnh không
    if ($duoi == 'jpg' || $duoi == 'png' || $duoi == 'gif' || $duoi == 'jpeg') {
        // tiến hành upload
        $data = file_get_contents($_FILES['file']['tmp_name']);
        //$sql = "insert into tb_tourimages values(NULL,'{$tour_code}' ,{$data})";
        //mysqli_query($conn, $sql);
        $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
        $stmt = $dbh->prepare("INSERT into tb_tourimages (tour_code, images_part) values(?, ?)");
        $stmt->bindParam(1, $tour_code);
        $stmt->bindParam(2, $data);
        $stmt->execute();
        if (move_uploaded_file($_FILES['file']['tmp_name'], '../images/Tour/' . $tour_code . '/' . $_FILES['file']['name'])) {
            // Nếu thành công
            //die('Upload thành công file: ' . $_FILES['file']['name']); //in ra thông báo + tên file
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
                ?>
                <script>
                    $(".deleteimages").click(function() {
                        let ab = $(this).text();
                        let cd = ab.split(":")

                        $(".imgdelete").text(cd[1]);
                    })
                </script>
<?php
            } else { // nếu không thành công
                //die('Có lỗi!'); // in ra thông báo
            }
        } else { // nếu không phải file ảnh
            //die('Chỉ được upload ảnh'); // in ra thông báo
        }
    }
} else {
    header('location: ../index.php');
}
?>