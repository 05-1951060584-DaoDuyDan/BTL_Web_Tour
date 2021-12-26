<?php
if(isset($_POST['btnsignup']) && $_POST['email'])
{
include "config/config.php";
$result = mysqli_query($conn,"SELECT * FROM tb_user WHERE email='" . $_POST['email'] . "'");
if(mysqli_num_rows($result) <= 0)
{
    $token = md5($_POST['email']).rand(10,9999);
    //lưu lại thông tin đăng ký của người dùng
    $name = $_POST['nameuser'];
    $surname = $_POST['surnameuser'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $pass1 = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO tb_user(nameuser, surnameuser, email, phonenumber, password, email_verification_link) VALUES('$name','$surname','$email','$phonenumber', '$pass1', '$token')");
    //sau khi lưu xong chúng ta sẽ cần gửi tới email đăng ký
    //yêu cầu người dùng nhấp để kích hoạt đường dẫn kích hoạt gửi vào email
    $link = "<a href='http://localhost/BTL_WEB/activation.php?key=".$email."&token=".$token."'>Nhấp vào đây để kích hoạt.</a>";
    

    //quá trình gửi email
    include 'send_email.php';
    if(sendemailforAccount($email, $link)){
        echo "Vui lòng kiểm tra hộp thư của bạn để kích hoạt tài khoản!";
    } else{
        echo "Xin lỗi. Email chưa được gửi đi. Vui lòng kiểm tra lại thông tin đăng ký tài khoản!";
    }
}
else
{
    $error = "Username or Email is exitsted";
    header("location: signup.php?error=$error");
}
}else{
    header('location: signup.php');
}
?>