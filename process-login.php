<?php
    include('config/config.php');
    if (isset($_POST["btnsignin"])) {
        $user = $_POST['phoneoremail'];
        $pass = $_POST['password'];
        $sql1 = "Select* from tb_user where (email = '{$user}' or phonenumber = '{$user}')";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1)>0){
            $row1 = mysqli_fetch_assoc($result1);
            if($row1['lock']==0){
                if(mysqli_num_rows($result1)>0 && password_verify($pass, $row1['password'])){
                    if($row1['status_user']==1){
                        if($row1['admin']==1){
                            $_SESSION['LoginOK'] = '3'.$row1['email'];
                            echo $_SESSION['LoginOK'];
                            header("location: admin/index.php");
                        }else{
                            $sql2 = "Select* from tb_user, tb_touroperator where tb_user.id_user = tb_touroperator.id_user and  tb_user.id_user = '{$row1['id_user']}' and status_touroperator = 1";
                            $result2 = mysqli_query($conn, $sql2);
                            if(mysqli_num_rows($result2)>0){
                                $_SESSION['LoginOK'] = '1'.$row1['email'];
                            }else{
                                $_SESSION['LoginOK'] = '2'.$row1['email'];
                            }
                            header("location: index.php");
                        }
                    }else{
                        $error = "Email của bạn chưa được xác thực!";
                        header("location: login.php?error=$error");
                    }
                }
                else{
                    $error = "Thông tin và mật khẩu không chính xác!";
                    header("location: login.php?error=$error");
                }
            }
            else{
                header("location: process-informationLock.php");
            }
        }
        else{
            $error = "Thông tin và mật khẩu không chính xác!";
            header("location: login.php?error=$error");
        }
    } else{
        header("location: login.php");
    }
    
?>