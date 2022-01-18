<?php
    require "config/config.php";
    if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
        header('location: ../index.php');
    } else {
        if(isset($_POST)){
            $tour_code = $_POST['tourcode'];
            $sd = $_POST['startDay'];
            $date = getdate();
            $nowday = $date['mday'];
            $nowmonth = $date['mon'];
            $nowyear = $date['year'];
            $startday = (string)$sd;
            $array = explode("-", $startday);
            if((int)$array[0] = (int)$nowyear && (int)$array[1]=(int)$nowmonth && (int)$array[2]>(int)$nowday || (int)$array[0] >= (int)$nowyear && (int)$array[1]>(int)$nowmonth || (int)$array[0] > (int)$nowyear){
                $sql = "Select* from `tb_startendday` where `tour_code` = '{$tour_code}' and `startday` = '{$sd}'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)>0){
                    echo "Ngày bắt đầu chuyến đi đã tồn tại hoặc không hợp lệ! Vui lòng nhập lại.";
                }else{
                    echo "Hợp lệ!";
                }
            }else{
                echo "Ngày bắt đầu chuyến đi đã tồn tại hoặc không hợp lệ! Vui lòng nhập lại.";
            }
        }
    }
?>