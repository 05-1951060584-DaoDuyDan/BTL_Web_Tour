<?php
    require_once "config/config.php";
    if(isset($_POST['name'])){
        $code_bookingtour = strtoupper(substr(md5(rand()), 0, 10));
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address'];
        $numberadult = $_POST['numberadultinfo'];
        $numberchild = $_POST['numberchildinfo'];
        $numberbaby = $_POST['numberbabyinfo'];
        $totalmoney = $_POST['totalmoney'];
        //$ = $_POST['']; ngày đặt
        $payments = $_POST['payments'];
        $idstartendday = $_POST['idstartendday'];
        if(isset($_POST['iduser'])){
            $iduser = $_POST['iduser'];
        }
        $tourcode = $_POST['tourcode'];
        //echo isset($_POST['checkbox0']);
        $tourbookingdate = date('d-m-Y');
        if(isset($_POST['iduser'])){
            $sqlbookingtour = "Insert into tb_tourbooking(`code_bookingtour`, `namebookingtour`, `surnamebookingtour`, `gender`, `email`, `phonenumber`, `address`, `numberadult`, `numberchild`, `numberbaby`, `totalmoney`, `tourbookingdate`, `payments`, `status_bookingtour`, `complete`, `cancel`, `tour_code`, `id_startendday`, `id_user`) values
            ('{$code_bookingtour}','{$name}','{$surname}','{$gender}','{$email}','{$phonenumber}','{$address}','{$numberadult}','{$numberchild}','{$numberbaby}','{$totalmoney}','{$tourbookingdate}','{$payments}','0','0','0','{$tourcode}','{$idstartendday}','{$iduser}')";
            $result = mysqli_query($conn, $sqlbookingtour);
            if($result){
                echo "Ngon";
            }
        }else{
            $sqlbookingtour = "Insert into tb_tourbooking(`code_bookingtour`, `namebookingtour`, `surnamebookingtour`, `gender`, `email`, `phonenumber`, `address`, `numberadult`, `numberchild`, `numberbaby`, `totalmoney`, `tourbookingdate`, `payments`, `status_bookingtour`, `complete`, `cancel`, `tour_code`, `id_startendday`) values
            ('{$code_bookingtour}','{$name}','{$surname}','{$gender}','{$email}','{$phonenumber}','{$address}','{$numberadult}','{$numberchild}','{$numberbaby}','{$totalmoney}','{$tourbookingdate}','{$payments}','0','0','0','{$tourcode}','{$idstartendday}')";
            $result = mysqli_query($conn, $sqlbookingtour);
            if($result){
                echo "OK";
            }
        }
    }else{
        header("location: index.php");
    }
?>