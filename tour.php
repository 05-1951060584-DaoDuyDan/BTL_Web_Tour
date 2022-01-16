<?php
include('config/config.php');
if (isset($_SESSION['LoginOK'])) {
    $user = substr($_SESSION['LoginOK'], 1, 60);
    $user = rtrim($user);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body >
    <div class="container">
        <a href="add-tour.php" class="btn btn-success m-2">Thêm Tour</a>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã Tour</th>
                        <th scope="col">Tên Tour</th>
                        <th scope="col">Điểm bắt đầu</th>
                        <th scope="col">Điểm kết thúc</th>
                        <th scope="col">Số ngày</th>
                        <th scope="col">Khuyến mãi</th>
                        <th scope="col">Thông tin tour</th>
                        <th scope="col">Trả góp</th>
                        <th scope="col">Quy định tour</th>
                        <th scope="col">Tình trạng tour</th>
                        <th scope="col">Lịch khởi hành</th>
                        <th scope="col">Trạng thái tour</th>
                        <th scope="col">Loại tour</th>
                        <th scope="col">Người điều hành tour</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM tb_tour, tb_typetour, tb_touroperator WHERE tb_tour.id_typetour = tb_typetour.id_typetour AND tb_touroperator.id_touroperator = tb_tour.id_touroperator";
                        $res = mysqli_query($conn,$sql);
                        $sn = 1;
                        if(mysqli_num_rows($res) > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $tour_code = $row['tour_code'];
                                $nametour = $row['nametour'];
                                $startinglocation = $row['startinglocation'];
                                $endinglocation = $row['endinglocation'];
                                $numberofdays = $row['numberofdays'];
                                $tourdiscount = $row['tourdiscount'];
                                $tourinfo = $row['tourinfo'];
                                if($row['installment'] == 0)
                                    $installment = 'Không';
                                else
                                    $installment = 'Có';
                                $tourregulations = $row['tourregulations'];
                                $conditiontour = $row['conditiontour'];
                                $tourdepartureschedule = $row['tourdepartureschedule'];
                                $nametypetour = $row['nametypetour'];
                                $nametouroperator = $row['nametouroperator'];
                                if($row['status_tour'] == 0)
                                    $status = 'Không hoạt động';
                                else
                                    $status = 'Hoạt động';


                                ?>
                                <tr>
                                    <th scope="row"><?php echo $sn++; ?></th>
                                    <td><?php echo $tour_code; ?></td>
                                    <td><?php echo $nametour; ?></td>
                                    <td><?php echo $startinglocation; ?></td>
                                    <td><?php echo $endinglocation; ?></td>
                                    <td> <?php echo $numberofdays; ?></td>
                                    <td><?php echo $tourdiscount; ?></td>
                                    <td><?php echo $tourinfo; ?></td>
                                    <td><?php echo $installment; ?></td>
                                    <td><?php echo $tourregulations; ?></td>
                                    <td><?php echo $conditiontour; ?></td>
                                    <td><?php echo $tourdepartureschedule; ?></td>
                                    <td><?php echo $nametypetour; ?></td>
                                    <td><?php echo $nametouroperator; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <a href="update-tour.php?id=<?php echo $id;?>" >
                                            <i class="fas fa-user-edit text-center" style="color:blue"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete-tour.php?id=<?php echo $id;?>" >
                                            <i class="fas fa-user-times" style="color:red"></i>
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