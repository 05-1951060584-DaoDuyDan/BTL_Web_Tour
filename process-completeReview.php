<?php
if (isset($_POST['codebooktour']) && isset($_POST['reviewBC']) && isset($_POST['submitReview'])) {
    require "config/config.php";
    $sqlReview = "Update tb_tourbooking set complete = 1 , review = '{$_POST['reviewBC']}' where code_bookingtour = '{$_POST['codebooktour']}'";
    if (mysqli_query($conn, $sqlReview)) {
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
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 bg-white shadow-sm rounded p-2 mt-3 ms-auto me-auto">
                        <h3 class="text-center text-primary">Cảm ơn quý khách đã đặt dịch vụ Tour của chúng tôi: <?php echo $_POST['codebooktour'] ?></h3><br>
                        <h4 class="text-center text-primary">Chúng tôi hi vọng đã mang tới trải nghiệp thú vị cho quý khách!</h4>
                        <h4 class="text-center">Hi vọng sẽ sớm gặp lại quý khách trong tương lai! <br> Chúc quý khách sức khỏe và nhiều sự may mắn</h4>
                        <button class="btn btn-primary">Trở lại trang chủ</button>
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php
    }
}
?>