<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style/style.css">
</head>

<body style="background-color: #FAFAFB">
    <header style="margin-top: 120px;">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md">
                    <a href="" class="text-decoration-none d-flex align-items-center mb-3">
                        <span class="material-icons">
                            arrow_back_ios
                        </span>
                        <span>Quay lại</span>
                    </a>
                    <h4 class="mb-3">Thông tin đặt Tour</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 m-1">
                    <div class="bg-white rounded shadow-sm">
                        <form class="row g-3 needs-validation m-1" novalidate>
                            <div class="col-md-6">
                                <label for="validationCustom01" class="form-label">Họ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="validationCustom01" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom02" class="form-label">Tên đệm & tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="validationCustom01" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <span class="me-4">Giới tính <span class="text-danger">*</span></span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Nam</label>
                                </div>
                                <div class="form-check form-check-inline mt-2 mb-3">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                              </div>
                            <div class="col-md-12">
                                <label for="validationCustom02" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="validationCustom02" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom03" class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="validationCustom03" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                    <div class="container mt-3 mb-3 bg-white p-2 rounded shadow-sm">
                        <h4 class="mt-3">Số lượng hành khách</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <b>Người lớn</b>
                                <p>(Trên 10 tuổi)</p>
                                <div class="d-flex justify-content-between">
                                    <span class="material-icons border rounded-pill add-passengers" onclick="removeadult()">
                                        remove
                                    </span>
                                    <span id="numberadult">1</span>
                                    <span class="material-icons border rounded-pill add-passengers" onclick="addadult()">
                                        add
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Trẻ em</b>
                                <p>(5 - 10 tuổi)</p>
                                <div class="d-flex justify-content-between">
                                    <span class="material-icons border rounded-pill add-passengers" onclick="removechild()">
                                        remove
                                    </span>
                                    <span  id="numberchild">0</span>
                                    <span class="material-icons border rounded-pill add-passengers"  onclick="addchild()">
                                        add
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Trẻ nhỏ</b>
                                <p>(0 - dưới 5 tuổi)</p>
                                <div class="d-flex justify-content-between">
                                    <span class="material-icons border rounded-pill add-passengers" onclick="removebaby()">
                                        remove
                                    </span>
                                    <span id="numberbaby">0</span>
                                    <span class="material-icons border rounded-pill add-passengers" onclick="addbaby()">
                                        add
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid bg-white p-2 rounded shadow-sm">
                        <h4 class="mt-3">Dịch vụ đi kèm</h4>
                        <p class="ms-2">Vui lòng chọn dịch vụ đi kèm và số lượng tương ứng</p>
                        <form class="row g-3 needs-validation m-1" novalidate>
                            <div class="col-md-6">
                                <label for="validationCustom04" class="form-label">Dịch vụ đi kèm</label>
                                <select class=" col-md-6 form-select" aria-label="Default select example">
                                    <option value="1">Transportation (950.000 đ)</option>
                                    <option value="2">Single room(600.000 đ)</option>
                                    <option value="3">Food and Beverage service (195.000 đ)</option>
                                    <option value="4">Tour guide(2.400.000 đ)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="validationCustom05" class="form-label">Số hành khách</label>
                                <input type="text" class="form-control" id="validationCustom05" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="container-fluid bg-white mt-3 p-2 rounded shadow-sm">
                        <h4>Hình thức thanh toán</h4>
                        <div class="row ms-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Thẻ ATM hoặc iBanking của các ngân hàng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Thẻ thanh toán quốc tế (Visa/Master)
                                </label>
                            </div>
                        </div>
                        <div class="mt-5">
                            <span class="material-icons text-primary">
                                handshake
                            </span>
                            <span class="" style="text-align:justify">Tiếp tục thực hiện bước tiếp theo, tôi xác nhận đã xem và chấp thuận các <a href="">Điều khoản & chính sách</a> và <a href="">Chính sách riêng tư</a> của hahalolo.</span>
                        </div>
                        <div class="col-md-6 d-grid gap-2 mt-3 ms-auto me-auto">
                            <button class="btn btn-primary rounded-pill" type="button">Thanh toán</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 rounded shadow-sm m-1 bg-white">
                    <div class="col-md">
                        <h4 class="mt-3">Thông tin tour</h4>
                        <hr>
                        <h6>003: Đà Nẵng – Sơn Trà – Hội An – Rừng Dừa 7 Mẫu – Bà Nà (4N3Đ)</h6>
                        <a href="" class="text-decoration-none">Xem chi tiết tour</a>
                        <hr>
                        <div class="d-flex justify-content-around" style="font-size: 14px;">
                            <div>
                                <p>Thời gian:</p>
                                <p>Điểm khởi hành:</p>
                                <p>Ngày khởi hành:</p>
                                <p>Ngày kết thúc:</p>
                                <p>Hành khách:</p>
                            </div>
                            <div class="d-flex flex-column">
                                <p class="fw-bold">4 ngày</p>
                                <p  class="fw-bold">Thành phố Đà Nẵng</p>
                                <p  class="fw-bold">Thứ 4, 29/12/2021 (UTC+07:00)</p>
                                <p  class="fw-bold">Thứ 7, 01/01/2022 (UTC+07:00)</p>
                                <p  class="fw-bold">1 người lớn, 1 trẻ nhỏ</p>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h6>Chi tiết giá</h6>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <span>Người lớn <b>x</b></span>
                                    <span class="fw-bold">1760000 đ</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Trẻ em <b>x</b></span>
                                    <span class="fw-bold">1150000 đ</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Trẻ nhỏ <b>x</b></span>
                                    <span class="fw-bold">0 đ</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>VAT</span>
                                    <span class="fw-bold">291000 đ</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6>Tổng tiền</h6>
                            <h5 class="text-danger">3201000</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script>
        let adult = document.getElementById('numberadult').textContent;
        let child = document.getElementById('numberchild').textContent;
        let baby = document.getElementById('numberbaby').textContent;
        let adu = Number(adult);
        let chi = Number(child);
        let bab = Number(baby);
        function addadult(){
            adu+=1;
            document.getElementById('numberadult').innerText = String(adu);
        }
        function removeadult(){
            if(adu>1){
                adu-=1;
                document.getElementById('numberadult').innerText = String(adu);
            }
        }
        function addchild(){
            chi+=1;
            document.getElementById('numberchild').innerText = String(chi);
        }
        function removechild(){
            if(chi>0){
                chi-=1;
                document.getElementById('numberchild').innerText = String(chi);
            }
        }
        function addbaby(){
            bab+=1;
            document.getElementById('numberbaby').innerText = String(bab);
        }
        function removebaby(){
            if(bab>0){
                bab-=1;
                document.getElementById('numberbaby').innerText = String(bab);
            }
        }
    </script>
</body>
</html>