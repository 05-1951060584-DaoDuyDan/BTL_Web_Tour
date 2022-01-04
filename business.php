<?php
  require('partials-front/header-business.php')
?>

  <link rel="stylesheet" href="css/style2.css">
    
    <!-- <header>AAAA</header> -->
    <div class="tao1">
      <main class="container-fuild text-center align-text-stretch" >
        <h1>Tạo tài khoản kinh doanh</h1>
        <h5>
          Bạn chưa sở hữu tài khoản kinh doanh, khởi tạo ngay để bắt đầu quá trình
          hoạt động kinh doanh trên Hahalolo cho doanh nghiệp của bạn. Với một tài
          khoản kinh doanh trên Hahalolo, bạn có thể điều hành, quản lý và phát
          triển doanh nghiệp một cách toàn diện.
        </h5>
        <h6 class="h6a text-success">Tất cả trong một và hoàn toàn miễn phí.</h6>
        <button type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          TẠO TÀI KHOẢN KINH DOANH
        </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tạo tài khoản kinh doanh</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
          <h6>Chọn loại hình doanh nghiệp</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Cá Nhân</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">Doanh Nghiệp</label>
              </div>
            <h6>Tên doanh nghiệp</h6>
            <input type="text" class="form-control" placeholder="Nhập tên doanh nghiệp" aria-label="Username" aria-describedby="addon-wrapping">
            <div id="passwordHelpBlock" class="form-text">
                Tên doanh nghiệp của bạn sẽ được nhìn thấy bởi tất cả nhân viên.
              </div>
              <h6>Tên chủ sở hữu</h6>
            <input type="text" class="form-control" placeholder="Dao Duy Dan" aria-label="Username" aria-describedby="addon-wrapping">
              <h6>Email</h6>
            <input type="text" class="form-control" placeholder="daodan2612@gmail.com" aria-label="Username" aria-describedby="addon-wrapping">
            <small id="textHelp" class="form-text">Chúng tôi sẽ gửi thông báo tới doanh nghiệp của bạn qua email này.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">HỦY BỎ</button>
        <button type="button" class="btn btn-primary">ĐỒNG Ý</button>
      </div>
    </div>
  </div>
</div>
    
      </main>
     
    </div>
    <section class="tao3 d-flex justify-content-center p-2 bg-info fixed-bottom ">
      <hr />
      <p class="taocon">Hahalolo &copy; 2017</p>
      <a href="http://localhost/baitaplon/business.php" class="taocon text-decoration-none"> Giới thiệu</a>
      <a href="https://tuyendung.hahalolo.com/" class="taocon text-decoration-none"> Tuyển dụng</a>
      <a href="https://help.hahalolo.com/hc/vi/articles/360036293871" class="taocon text-decoration-none"> Quyền riêng tư</a>
      <a href="https://help.hahalolo.com/hc/vi/articles/360035943132" class="taocon text-decoration-none"> Cookies</a>
      <a href="https://help.hahalolo.com/hc/vi/articles/360036291411" class="taocon text-decoration-none"> Điều khoản</a>
      <a href="https://help.hahalolo.com/hc/vi/articles/360035841292" class="taocon text-decoration-none"> Tiêu chuẩn cộng đồng</a>
      <a href="https://help.hahalolo.com/hc/vi" class="taocon text-decoration-none"> Hỗ trợ</a>
    </section>
    <script src="jss/script.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
