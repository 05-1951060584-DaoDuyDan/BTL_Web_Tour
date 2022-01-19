<?php
include('partials-front/header.php');
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    
} else {
    header('location: ../index.php');
}
?>
<head>
    <title>Admin Dịch vụ</title>
</head>


    <div class="container">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Mã Tour</th>
                    <th scope="col">Tên dịch vụ</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Tình Trạng</th>
                    <th scope="col">Khóa dịch vụ</th>
                    <th scope="col">Mở dịch vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * from tb_tourservice";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['lock_service']==1)
                            $tt = "Đang khóa";
                        else
                            $tt = "Không khóa";
                ?>
                        <tr>
                            <td><?php echo $row['id_tourservice']; ?></td>
                            <td><?php echo $row['tour_code']; ?></td>
                            <td><?php echo $row['nameservice']; ?></td>
                            <td><?php echo $row['priceservice']; ?></td>
                            <td><?php echo $tt; ?></td>
                            <td>
                            <a href="process-lockService.php?id=<?php echo $row['id_tourservice'];?>" onclick="return confirm('Bạn chắc chắn muốn khóa Dịch Vụ này?')">
                                <i class="fas fa-lock text-center" style="color:blue"></i></a>
                            </td>
                            <td>
                            <a href="process-unlockService.php?id=<?php echo $row['id_tourservice'];?>" onclick="return confirm('Bạn chắc chắn muốn mở khóa Dịch Vụ này?')">
                                <i class="fas fa-lock-open text-center" style="color:red"></i></a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>