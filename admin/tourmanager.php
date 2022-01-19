<?php
include('partials-front/header.php');
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    
} else {
    header('location: ../index.php');
}
?>
<head>
    <title>Admin Tour Operator</title>
</head>
<body >
    <div class="container ">
        <a href="add-room.php" class="btn btn-success m-2">Thêm Tour</a>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên người điều hành</th>
                        <th scope="col">Loại hình kinh doanh</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ảnh người điều hành</th>
                        <th scope="col">Trạng thái</th>

                        <th scope="col">Khóa</th>
                        <th scope="col">Email liên kết</th>
                        <th scope="col">Liên kết vào</th>
                        <th scope="col">Trang</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Khóa</th>
                        <th scope="col">Mở</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM tb_user, tb_typepage, tb_touroperator WHERE tb_touroperator.id_typepage = tb_typepage.id_typepage AND tb_touroperator.id_user = tb_user.id_user";
                        $res = mysqli_query($conn,$sql);
                        $sn = 1;
                        if(mysqli_num_rows($res) > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id_touroperator = $row['id_touroperator'];
                                $nametouroperator = $row['nametouroperator'];
                                $businesstype = $row['businesstype'];
                                $email = $row['email'];
                                $phonenumber = $row['phonenumber'];
                                $imagetouroperator = $row['imagetouroperator'];
                    
                                if($row['status_touroperator'] == 0)
                                    $status = 'Không hoạt động';
                                else
                                    $status = 'Hoạt động';
                                if($row['lock'] == 0)
                                    $lock = 'Không';
                                else
                                    $lock = 'Có';
                                $email_verification_link = $row['email_verification_link'];
                                $email_verified_at = $row['email_verified_at'];
                                $nametypepage = $row['nametypepage'];
                                $nameuser = $row['nameuser'];
                                
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $sn++; ?></th>
                                    <td><?php echo $nametouroperator; ?></td>
                                    <td><?php echo $businesstype; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td> <?php echo $phonenumber ?></td>
                                    <td>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['imagetouroperator']); ?>" width="160" height="100" alt="Image Operator" />
                                </td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $lock; ?></td>
                                    <td><?php echo $email_verification_link; ?></td>
                                    <td><?php echo $email_verified_at; ?></td>
                                    <td><?php echo $nametypepage; ?></td>
                                    <td><?php echo $nameuser; ?></td>
                                    <td>
                                        <a onclick="return confirm('Bạn chắc chắn muốn khóa người quản lý các Tour này?')" href="process-lockManager.php?id=<?php echo $id_touroperator;?>" class="m-l-42">
                                        <i class="fas fa-lock text-center" style="color:blue"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Bạn chắc chắn muốn mở khóa người quản lý các Tour này?')" href="process-unlockManager.php?id=<?php echo $id_touroperator ?>&idus=<?php echo $row['id_user']?>" class="m-l-42" >
                                            <i class="fas fa-lock-open text-center" style="color:red"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else{}
                    ?>
            </table>
        </div>
    </div>
</body>

<?php include('partials-front/footer.php') ?>