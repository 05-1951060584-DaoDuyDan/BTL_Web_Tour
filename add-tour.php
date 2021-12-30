<?php
    $tour_code = substr(md5(rand()), 0, 10);
    session_start();
    if (!isset($_SESSION['LoginOK']) && !substr($_SESSION['LoginOK'], 0, 1) == '1') {
        header('location: index.php');
    }else{
        require('partials-front/header.php');
        $sqltourmanager = "Select* from tb_user, tb_touroperator, tb_tour where tb_user.id_user = tb_touroperator.id_user and tb_touroperator.id_touroperator = tb_tour.id_touroperator and tb_user.email = '{$user}'";
        $result =  mysqli_query($conn, $sqltourmanager);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
    }
?>
    <header>
        <div class="container" style="margin-top: 66px;">
            <div class="row">
                <div class="col-md-10">
                    <form action="process-addtour.php" method="POST" class="form-control">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <span class="me-2 fw-bold fs-1">Mã tour mới của bạn: </span>
                            <input class="form-control mt-2" name = "tour_code" value="<?php echo $tour_code;?>" style="max-width: 150px;" readonly>
                        </div>
                        <div class="mt-3">
                            <select class="form-select" aria-label="Default select example" name="typetour" required>
                                <option selected>Chọn loại tour của bạn</option>
                                <?php
                                    $sqltypetour = "Select* from tb_typetour";
                                    $resulttypetour = mysqli_query($conn, $sqltypetour);
                                    if(mysqli_num_rows($resulttypetour)){
                                        while ($rowtypetour = mysqli_fetch_assoc($resulttypetour)) {
                                ?>
                                    <option value="<?php echo $rowtypetour['id_typetour'] ?>"><?php echo $rowtypetour['nametypetour'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                                <!-- <option value="1">One</option> -->
                            </select>
                            <div class="col-md me-1 mt-3">
                                <label for="exampleInputEmail1" class="form-label fw-bold">Nhập tên tour của bạn</label>
                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="nametour" required>
                            </div>
                        </div>
                        <div class="col-md d-flex flex-row mt-3">
                            <div class="col-md-6 me-1">
                                <label for="exampleInputEmail1" class="form-label fw-bold">Địa Điểm Bắt Đầu</label>
                                <input type="text" class="form-control" name="startlocation" aria-describedby="emailHelp" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label fw-bold">Địa Điểm Kết Thúc</label>
                                <input type="text" class="form-control" name="endlocation" id="" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                        <div class="col-md mt-3">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label fw-bold">Số ngày thực hiện chuyến đi</label>
                                <input type="text" class="form-control" name="numberofdays" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mt-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px" name="tourinfo" required></textarea>
                                    <label for="floatingTextarea2" class="fw-bold">Mô tả tour của bạn</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="fw-bold">Tour có cho phép trả góp hay không?</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Trả góp</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Không trả góp</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="exampleInputEmail1" class="form-label fw-bold">Khuyến mãi của Tour</label>
                                <input type="text" class="form-control" name="tourdiscount" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mt-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px" name="quydinhtour" required></textarea>
                                    <label for="floatingTextarea2" class="fw-bold">Quy định riêng về tour của bạn(Mỗi câu cách nhau bằng 1 dấu chấm)</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px" name="khuyenmaitour" required></textarea>
                                    <label for="floatingTextarea2" class="fw-bold">Khuyến mãi tour của bạn(Mỗi câu cách nhau bằng 1 dấu chấm)</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px" name="chinhsachtour" required></textarea>
                                    <label for="floatingTextarea2" class="fw-bold">Chính sách riêng tư tour của bạn(Mỗi câu cách nhau 1 dấu chấm)</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-primary mt-1 rounded-pill" type="submit" name="btnaddtour">Tiếp Tục Đăng Ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>