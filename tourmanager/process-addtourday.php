<?php
    require "config/config.php";
    if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
        header('location: ../index.php');
    }else{
        if(isset($_POST['btndayoftour'])){
            $duoi = explode('.', $_FILES['imgDayNM']['name']); // tách chuỗi khi gặp dấu .
            $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
            // Kiểm tra xem có phải file ảnh không
            if ($duoi == 'jpg' || $duoi == 'png' || $duoi == 'gif' || $duoi == 'jpeg') {
                $data = file_get_contents($_FILES['imgDayNM']['tmp_name']);
                $tour_code = $_GET['tourcode'];
                $day = $_POST['day'];
                $location = $_POST['nametourday'];
                $morning = $_POST['morningtour'];
                $noon = $_POST['noonofday'];
                $afternoon = $_POST['afternoonofday'];
                $night = $_POST['nightofday'];
                $dbh = new PDO("mysql:host=localhost;dbname=db_tournew", "root", "");
                $stmt = $dbh->prepare("Insert into tb_tourday values(?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $tour_code);
                $stmt->bindParam(2, $day);
                $stmt->bindParam(3, $location);
                $stmt->bindParam(4, $morning);
                $stmt->bindParam(5, $noon);
                $stmt->bindParam(6, $afternoon);
                $stmt->bindParam(7, $night);
                $stmt->bindParam(8, $data);
                if ($stmt->execute()) {
                    header("location: process-addtour.php?tourcode={$tour_code}");
                } else {
                    header("location: process-addtour.php?tourcode={$tour_code}");
                }
            }else{
                 header('location: tourmanager.php');
            }
        }else{
            header('location: tourmanager.php');
        }
    }
?>