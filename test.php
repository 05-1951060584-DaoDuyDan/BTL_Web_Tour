<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <!-- <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#tab1" data-toggle="tab">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab2" data-toggle="tab">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="tab">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-toggle="tab">Disabled</a>
            </li>
        </ul>
        <div class="tab-content"> 
            <div class="tab-pane container active" id="tab1"> <p>Gà.</p> </div>
            <div class="tab-pane container fade" id="tab2"> <p>ngon.</p></div> 
            <div class="tab-pane container fade" id="tab3"> </p>Đấy.</p></div> 
        </div> -->
        <div class="row">
            <div class="col-md-8 ms-auto me-auto bg-success">
                <p>OK</p>
            </div>
        </div>
    </div>
    <?php
                                $sql2 = "Select* from tb_tourimages where id_tour = '".$idtour."'";
                                $result1 =  mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result1)>0) {
                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                        $images = $row1['images_part']
                            ?>

<?php
                                    }
                                }
                            ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>