$(document).ready(function(){
    $("#email").change(function(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if(this.responseText=="Email hợp lệ có thể đăng ký")
                $("#emailHelp").text(this.responseText).css("color","green");
            else
                $("#emailHelp").text(this.responseText).css("color","red");
        }
        xhttp.open("POST", "process-email.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("email="+this.value);
    })
})

//xử lý khi có sự kiện click
$('#btnuploadimages').on('click', function () {
    //Lấy ra files
    var file_data = $('#tour_images').prop('files')[0];
    //lấy ra kiểu file
    var type = file_data.type;
    //Xét kiểu file được upload
    var match = ["image/gif", "image/png", "image/jpg","image/jpeg",];
    //kiểm tra kiểu file
    if (type == match[0] || type == match[1] || type == match[2] || type == match[3]) {
        //khởi tạo đối tượng form data
        var form_data = new FormData();
        //thêm files vào trong form data
        form_data.append('file', file_data);
        var tourcode = $("#my_name_tour").val();
        form_data.append('text', tourcode);
        //sử dụng ajax post
        $.ajax({
            url: 'process-uploadimages.php', // gửi đến file upload.php 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (res) {
                $('#my_images_tour').html(res);
                $('#tour_images').val('');
            }
        });
    } else {
        $('.status').text('Chỉ được upload file ảnh');
        $('#file').val('');
    }
    return false;
});

//đăng ký ngày đi và kết thúc tour
$('#btnAddSEDay').on('click', function() {
    let startDay = $("#startDay").val();
    let dual = new Date(startDay);
    let starttmp = new Date(startDay);
    let endDay = $("#endDay").val();
    let xdntnv = new Date(endDay);
    let da = new Date();
    let number = $("#nbofdays").val();
    let daycount = 0;
    while(starttmp<=xdntnv){
        daycount+=1;
        starttmp.setDate(starttmp.getDate() + 1);
    }
    console.log(daycount);
    console.log(number);
    if($("#startDay").val()<$("#endDay").val() && da <= dual  && daycount==number && $("#check-startday").text()=="Hợp lệ!"){
        let form_data = new FormData();
        let endDay = $("#endDay").val();
        let adultPrice = $("#adultPrice").val();
        let childPrice = $("#childPrice").val();
        let vat = $("#vat").val();
        var tourcode = $("#my_name_tour").val();
        form_data.append('startDay', startDay);
        form_data.append('endDay', endDay);
        form_data.append('adultPrice', adultPrice);
        form_data.append('childPrice', childPrice);
        form_data.append('vat', vat);
        form_data.append('tourcode', tourcode);
        let ws = getDaySED(startDay);
        let we = getDaySED(endDay);
        form_data.append('ws', ws);
        form_data.append('we', we);
        $.ajax({
            url: 'process-addstartendday.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(res) {
                $('.inforeturn').html(res);
                $("#startDay").val('');
                $("#endDay").val('');
                $("#adultPrice").val('');
                $("#childPrice").val('');
                $("#vat").val('');
            }
        });
    return false;
}else{
    $('.informationadd').text("Thông tin về ngày khởi hành và kết thúc chưa hợp lệ").css("color", "red");
}
}); //startDayUpdate
//Check ngày bắt đầu của update
$(document).ready(function(){
    $("#startDayUpdate").change(function(){
        let sx = $("#tourcodemainde").val();
        let az = $("#startDayUpdate").val();
        let form_datas = new FormData();
        form_datas.append('startDay', az);
        form_datas.append('tourcode', sx);
        $.ajax({
            url: 'process-checkday.php', // gửi đến file upload.php 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datas,
            type: 'post',
            success: function(res) {
                if(res=="Ngày bắt đầu chuyến đi đã tồn tại hoặc không hợp lệ! Vui lòng nhập lại.")
                    $('#check-startdayUpdate').text(res).css('color','red');
                else if(res=="Hợp lệ!")
                    $('#check-startdayUpdate').text(res).css('color','green');
            }
        });
        return false;
    })
})

$(".editSEDay").click(function() {
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $("#idSEDayUpdate").val(data[0]);
    $("#startDayUpdate").attr('value', data[1]);
    $("#endDayUpdate").val(data[2]);
    $("#adultPriceUpdate").val(data[3]);
    $("#childPriceUpdate").val(data[4]);
    $("#vatUpdate").val(data[5]);
})
//thực hiện truyền dữ liệu đi để sửa
$('#btnUpdateSEDay').on('click', function() {
    let startDay = $("#startDayUpdate").val();
    let dual = new Date(startDay);
    let starttmp = new Date(startDay);
    let endDay = $("#endDayUpdate").val();
    let xdntnv = new Date(endDay);
    let da = new Date();
    let number = $("#nbofdays").val();
    let daycount = 0;
    while(starttmp<=xdntnv){
        daycount+=1;
        starttmp.setDate(starttmp.getDate() + 1);
    }
    console.log(daycount);
    console.log(number);
    if($("#startDayUpdate").val()<$("#endDayUpdate").val() && da <= dual  && daycount==number && $("#check-startdayUpdate").text()=="Hợp lệ!"){
        let form_data = new FormData();
        let id = $("#idSEDayUpdate").val();
        let adultPrice = $("#adultPriceUpdate").val();
        let childPrice = $("#childPriceUpdate").val();
        let vat = $("#vatUpdate").val();
        var tourcode = $("#my_name_tour").val();
        form_data.append('startDay', startDay);
        form_data.append('endDay', endDay);
        form_data.append('adultPrice', adultPrice);
        form_data.append('childPrice', childPrice);
        form_data.append('vat', vat);
        form_data.append('tourcode', tourcode);
        form_data.append('id', id);
        let ws = getDaySED(startDay);
        let we = getDaySED(endDay);
        form_data.append('ws', ws);
        form_data.append('we', we);
        $('.infomationupdate').text("");
        $.ajax({
            url: 'process-updatestartendday.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(res) {
                $('.inforeturn').html(res);
                $("#idSEDayUpdate").val('');
                $('.informationadd').text("Cập nhật thành công!");
                $("#startDayUpdate").val('');
                $("#endDayUpdate").val('');
                $("#adultPriceUpdate").val('');
                $("#childPriceUpdate").val('');
                $("#vatUpdate").val('');
                $('.infomationupdate').text("Hoàn tất!").css("color", "green");
                $("#check-startdayUpdate").text("");
            }
        });
        return false;
        
    }else{
    $('.infomationupdate').text("Thông tin về ngày khởi hành và kết thúc chưa hợp lệ").css("color", "red");
}
});
$(document).ready(function(){
    $(".closeupdate").click(function(){
        $('.infomationupdate').text("");
    })
})

//Add
function getDaySED(date) {
    let dual = new Date(date);
    let a = dual.getDay();
    switch(a){
        case 0: {return "Chủ Nhật"; break;}
        case 1: {return "Thứ Hai"; break;}
        case 2: {return "Thứ Ba"; break;}
        case 3: {return "Thứ Tư"; break;}
        case 4: {return "Thứ Năm"; break;}
        case 5: {return "Thứ Sáu"; break;}
        case 6: {return "Thứ Bảy"; break;}
    }
}
//check ngày
$(document).ready(function(){
    $("#startDay").change(function(){
        let sx = $("#tourcodemainde").val();
        let az = $("#startDay").val();
        let form_datas = new FormData();
        form_datas.append('startDay', az);
        form_datas.append('tourcode', sx);
        $.ajax({
            url: 'process-checkday.php', // gửi đến file upload.php 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datas,
            type: 'post',
            success: function(res) {
                if(res=="Ngày bắt đầu chuyến đi đã tồn tại hoặc không hợp lệ! Vui lòng nhập lại.")
                    $('#check-startday').text(res).css('color','red');
                else if(res=="Hợp lệ!")
                    $('#check-startday').text(res).css('color','green');
            }
        });
        return false;
    })
})
//Xóa
$(document).ready(function(){
    $(".deleteSEDaybtn").click(function(){
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $(".SEDayDelete").text(data[0]);
    })
})

$("#btnDeleteSEDay").click(function(){
    let SEDayDelete = $(".SEDayDelete").text();
    var tourcode = $("#my_name_tour").val();
    let form_datas = new FormData();
    form_datas.append('id',SEDayDelete);
    form_datas.append('tourcode', tourcode);
    $.ajax({
        url: 'process-deletestartendday.php', // gửi đến file upload.php 
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_datas,
        type: 'post',
        success: function(res) {
            $('.inforeturn').html(res);
        }
    });
})


//Kết thúc
//Javascript cho Ảnh
$(".deleteimages").click(function(){
    let ab = $(this).text();
    let cd = ab.split(":")

    $(".imgdelete").text(cd[1]);
})
//xóa ảnh
$("#btnDeleteImages").click(function(){
    let az = $(".imgdelete").text();
    let sx = $("#tourcodemainde").val();
    let form_datas = new FormData();
    form_datas.append('idimages', az);
    form_datas.append('tourcode', sx);
    $.ajax({
        url: 'process-deleteimages.php', // gửi đến file upload.php 
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_datas,
        type: 'post',
        success: function(res) {
            $('#my_images_tour').html(res);
        }
    });
})
//Kết thúc
//Thông tin từng ngày du lịch
//Cập nhật
$("#btnupdatedayoftour").click(function(){
    let form_datas = new FormData();
    let tourcodeupdate = $(".tourcodeupdate").val();
    let dayupdate = $("#dayupdate").val();
    let nametourdayupdate = $("#nametourdayupdate").val();
    let morningtourupdate = $("#morningtourupdate").val();
    let noonupdate = $("#noonupdate").val();
    let afternoonupdate = $("#afternoonupdate").val();
    let nightupdate = $("#nightupdate").val();

    form_datas.append('tourcodeupdate', tourcodeupdate);
    form_datas.append('dayupdate', dayupdate);
    form_datas.append('nametourdayupdate', nametourdayupdate);
    form_datas.append('morningtourupdate', morningtourupdate);
    form_datas.append('noonupdate', noonupdate);
    form_datas.append('afternoonupdate', afternoonupdate);
    form_datas.append('nightupdate', nightupdate);
    $.ajax({
        url: 'process-updatetourday.php', // gửi đến file upload.php 
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_datas,
        type: 'post',
        success: function(res) {
            $('.infotourday').html(res);
        }
    });
    return false;
})
//Cập nhật
$(".edittourday").click(function() {
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $("#dayupdate").attr('value', data[0]);
    $("#nametourdayupdate").val(data[1]);
    $("#morningtourupdate").val(data[2]);
    $("#noonupdate").val(data[3]);
    $("#afternoonupdate").val(data[4]);
    $("#nightupdate").val(data[5]);
})
//Xóa
$(".deletetourday").click(function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    
    $(".daydelete").text(data[0]);
    $(".daydeleteout").val(data[0]);
})
//Kết thúc