<?php
if(isset($_POST['btnSignUpManager']) && $_POST['email'])
{
include "config/config.php";
$result = mysqli_query($conn,"SELECT * FROM tb_touroperator WHERE email='" . $_POST['email'] . "'");
if(mysqli_num_rows($result) <= 0)
{
    $token = md5($_POST['email']).rand(10,9999);
    //lưu lại thông tin đăng ký của người dùng
    $name = $_POST['nameindustry'];
    $email = $_POST['email'];
    $lhkd = $_POST['loaihinhkinhdoanh'];
    $phonenumber = $_POST['phonenumber'];
    $id_typepage = $_POST['typepage'];
    $id_user = $_POST['iduser'];
    $status = 0;
    $lock = 0;
    $time = NULL;
    $data = file_get_contents($_FILES['imgManager']['tmp_name']);
    $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
    $stmt = $dbh->prepare("INSERT into tb_touroperator (`nametouroperator`, `businesstype`, `email`, `phonenumber`, `imagetouroperator`, `status_touroperator`, `lock`, `email_verification_link`, `id_typepage`, `id_user`) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $lhkd);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $phonenumber);
    $stmt->bindParam(5, $data);
    $stmt->bindParam(6, $status);
    $stmt->bindParam(7, $lock);
    $stmt->bindParam(8, $token);
    $stmt->bindParam(9, $id_typepage);
    $stmt->bindParam(10, $id_user);
    $stmt->execute();
    //sau khi lưu xong chúng ta sẽ cần gửi tới email đăng ký
    //yêu cầu người dùng nhấp để kích hoạt đường dẫn kích hoạt gửi vào email
    $link = "<a href='http://localhost/BTL_WEB_TongHop/tourmanager/activationmanager.php?key=".$email."&token=".$token."'>Nhấp vào đây để kích hoạt.</a>";
    

    //quá trình gửi email
    include 'send_emailManager.php';
    if(sendemailforAccount($email, $link)){
        echo "Vui lòng kiểm tra hộp thư của bạn để kích hoạt tài khoản!";
    } else{
        echo "Xin lỗi. Email chưa được gửi đi. Vui lòng kiểm tra lại thông tin đăng ký tài khoản!";
    }
}
else
{
    $error = "Username or Email is exitsted";
    header("location: business.php?error=$error");
}
}else{
    header('location: business.php');
}
?>