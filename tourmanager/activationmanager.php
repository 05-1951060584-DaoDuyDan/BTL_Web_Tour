<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Account Activation by Email Verification using PHP</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
        if($_GET['key'] && $_GET['token']) //nó bắt giá trị trên url
        {
            require "config/config.php";
            $email = $_GET['key'];
            $token = $_GET['token'];
            $query = mysqli_query($conn, "SELECT * FROM `tb_touroperator` WHERE `email_verification_link`='".$token."' and `email`='".$email."';"
        );
        $d = date('Y-m-d H:i:s'); //tạo biến thời gian
        if (mysqli_num_rows($query) > 0) { //có bản ghi nào khớp với thông tin không?
            $row= mysqli_fetch_array($query); //nếu có
            if($row['email_verified_at'] == NULL){
                mysqli_query($conn,"UPDATE tb_touroperator set email_verified_at ='" . $d . "' , `status_touroperator` = 1 WHERE email='" . $email . "'");
                $msg = "Chúc mừng bạn đã xác thức được Email.";
                session_start();
                if (isset($_SESSION['LoginOK'])) {
                    unset($_SESSION['LoginOK']);
                    header('location: index.php');
                }
            }else{
                $msg = "Bạn đã xác nhận email với chúng tôi rồi!";
            }
        } else {
            $msg = "Email này đã được đăng ký với chúng tôi!";
        }
        }
        else
        {
            $msg = "Danger! Your something goes to wrong.";
        }
    ?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center">
                User Account Activation by Email Verification using PHP
            </div>
            <div class="card-body">
                <p>
                    <?php echo $msg; ?>
                </p>
            </div>
        </div>
    </div>
</body>

</html>