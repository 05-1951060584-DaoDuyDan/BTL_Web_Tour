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
    if($("#startDay").val()<=$("#endDay").val() && da <= dual  && daycount==number && $("#check-startday").text()=="Hợp lệ!"){
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
        case 0: {return "CN"; break;}
        case 1: {return "Thứ 2"; break;}
        case 2: {return "Thứ 3"; break;}
        case 3: {return "Thứ 4"; break;}
        case 4: {return "Thứ 5"; break;}
        case 5: {return "Thứ 6"; break;}
        case 6: {return "Thứ 7"; break;}
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

//xử lý khi có sự kiện click
$('#btnuploadimages').on('click', function () {
    var file_data = $('#tour_images').prop('files')[0];
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
//Xóa ảnh
$(".deleteimages").click(function(){
    let ab = $(this).text();
    let cd = ab.split(":")

    $(".imgdelete").text(cd[1]);
})

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

    var file_data = $('#imgDayUpdate').prop('files')[0];
    var type = file_data.type;
    //Xét kiểu file được upload
    var match = ["image/gif", "image/png", "image/jpg","image/jpeg",];
    //kiểm tra kiểu file
    if (type == match[0] || type == match[1] || type == match[2] || type == match[3]) {

        form_datas.append('tourcodeupdate', tourcodeupdate);
        form_datas.append('dayupdate', dayupdate);
        form_datas.append('nametourdayupdate', nametourdayupdate);
        form_datas.append('morningtourupdate', morningtourupdate);
        form_datas.append('noonupdate', noonupdate);
        form_datas.append('afternoonupdate', afternoonupdate);
        form_datas.append('nightupdate', nightupdate);
        form_datas.append('file', file_data);
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
}
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

//update information tour
$(document).ready(function(){
    $("#capnhatthongtin").click(function(){
        if($(".informationtourupdate").attr("readonly")=='readonly'){
            $(".informationtourupdate").attr("readonly", false);
            if($(".tourdisplaynone").css("display")=="none"){
                $(".tourdisplaynone").css("display", "block");
                $(".displayblocktour").css("display", "none");
                $("#smUpdateTour").css("display", "block");
            }
        }
    })
})
$(document).ready(function(){
    $("#cancelupdate").click(function(){
        if(!$(".informationtourupdate").attr("readonly")){
            $(".informationtourupdate").attr("readonly", true);
            if($(".tourdisplaynone").css("display")=="block"){
                $(".tourdisplaynone").css("display", "none");
                $(".displayblocktour").css("display", "block");
                $("#smUpdateTour").css("display", "none");
            }
        }
    })
})
// $(document).ready(function(){
//     $("#smUpdateTour").click(function(){
//         accept();
//     })
// })
function accept(){
    if($("#typetour").val()=='Chọn loại tour của bạn' || $("#inlineRadio1").prop("checked")==false && $("#inlineRadio2").prop("checked")==false){
        $("#errorInput").text("Vui lòng chọn loại tour hoặc Tour có cho phép trả góp hay không!");
        return false;
    }else{
        return true;
    }
}
//Thêm dịch vụ cho Tour
$(document).ready(function(){
    $(".addTourService").click(function(){
        let nameService = $("#nameServicesadd").val();
        let priceService = $("#priceServicesadd").val();
        var tourcode = $("#my_name_tour").val();
        if(nameService!=""&&priceService!=""){
            let form_datas = new FormData();
            form_datas.append('nameservice',nameService);
            form_datas.append('priceservice',priceService);
            form_datas.append('tourcode',tourcode);
            $.ajax({
                url: 'process-addService.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $(".inforAddService").text("Thành công!").css('color','green');
                    var number = $('.tb_tourservice tr:last').closest('tr').find('td:first').text();
                    number = Number(number)+1;
                    $('.tb_tourservice tr:last').after('<tr><td>'+number+'</td><td>'
                    +nameService+'</td><td>'
                    +priceService+'</td><td>'
                    +'Không khóa</td>'+
                    +'<td><i class="bi bi-pencil-square text-warning updateTourServiceClick" data-bs-toggle="modal" data-bs-target="#editServiceTour"></i></td>'+
                    '<td><i class="bi bi-trash text-warning deleteTourServiceClick" data-bs-toggle="modal" data-bs-target="#deleteTourService"></i></td>'+
                    '</tr>');
                    $("#nameService").val("");
                    $("#priceService").val("");
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})
//sửa
$(document).ready(function(){
    $(".updateTourServiceClick").click(function(){
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $("#idTourServiceUpdate").val(data[0]);
        $("#nameServiceUpdate").val(data[1]);
        $("#priceServiceUpdate").val(data[2]);
    })
})

$(document).ready(function(){
    $(".updateTourService").click(function(){
        let idTourService = $("#idTourServiceUpdate").val();
        let nameService = $("#nameServiceUpdate").val();
        let priceService = $("#priceServiceUpdate").val();
        var tourcode = $("#my_name_tour").val();
        if(nameService!=""&&priceService!=""&&idTourService!=""){
            let form_datas = new FormData();
            form_datas.append('nameservice',nameService);
            form_datas.append('priceservice',priceService);
            form_datas.append('idTourService',idTourService);
            form_datas.append('tourcode',tourcode);
            $.ajax({
                url: 'process-updateService.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $("#tourServiceTable").html(res);
                    $(".inforAddService").text("Cập nhật hành công!").css('color','green');
                    $("#nameServiceUpdate").val("");
                    $("#priceServiceUpdate").val("");
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin cập nhật chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})

//xóa
$(".deleteTourServiceClick").click(function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $(".idservicedelete").text(data[0]);
    
    $(".commitDeleteService").click(function(){
        let idTourService = $(".idservicedelete").text();
        var tourcode = $("#my_name_tour").val();
        if(idTourService!=""){
            let form_datas = new FormData();
            form_datas.append('idTourService',idTourService);
            form_datas.append('tourcode',tourcode);
            $.ajax({
                url: 'process-deleteService.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $(".inforAddService").text("Xóa hành công!").css('color','green');
                    $tr.remove();
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin xóa chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})
/*
$(document).ready(function(){
    $(".commitDeleteService").click(function(){
        let idTourService = $(".idservicedelete").text();
        var tourcode = $("#my_name_tour").val();
        if(idTourService!=""){
            let form_datas = new FormData();
            form_datas.append('idTourService',idTourService);
            form_datas.append('tourcode',tourcode);
            $.ajax({
                url: 'process-deleteService.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $(".inforAddService").text("Xóa hành công!").css('color','green');
                    $(this).remove();
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin xóa chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})
*/
$(document).ready(function(){
    $("#updateInfoUser").click(function(){
        $("#nameuser").attr("readonly", false);
        $("#surnameuser").attr("readonly", false);
        $("#imgUserUpdate").css("display", "block");
        $("#submitUpdateUser").css("display", "block");
    })
})

//tìm kiếm tour
$(document).ready(function(){
    $("#btnsearchTour").click(function(){
        let form_datas = new FormData();
        if($("#searchlocation").val()!=""){
            form_datas.append('searchlocation', $("#searchlocation").val())
        }
        if($("#searchstartday").val()!=""){
            form_datas.append('searchstartday', $("#searchstartday").val())
        }
        if($("#searchStartLocation").val()!=""){
            form_datas.append('searchStartLocation', $("#searchStartLocation").val())
        }
        if($("#searchEndLocation").val()!=""){
            form_datas.append('searchEndLocation', $("#searchEndLocation").val())
        }
        if($("#searchcdTour").val()!=""){
            form_datas.append('searchcdTour', $("#searchcdTour").val())
        }
        if($("#searchnumberday").val()!=""){
            form_datas.append('searchnumberday', $("#searchnumberday").val())
        }
        if($("#searchPrice").val()!=""){
            form_datas.append('searchPrice', $("#searchPrice").val())
        }
        if(($("#checkbox1").is(":checked")==true) && $("#checkbox1").val()!=""){
            form_datas.append('khuyenmai', $("#checkbox1").val())
        }
        if(($("#checkbox2").is(":checked")==true) && $("#checkbox2").val()!=""){
            form_datas.append('tragop', $("#checkbox2").val())
        }
        console.log($("#searchlocation").val())
        console.log($("#searchstartday").val())
        console.log($("#searchStartLocation").val())
        console.log($("#searchEndLocation").val())
        console.log($("#searchcdTour").val())
        console.log($("#searchnumberday").val())
        console.log($("#searchPrice").val())
        console.log($("#checkbox1").is(":checked"))
        console.log($("#checkbox2").is(":checked"))
        //if($("#searchlocation").val()!="" || $("#searchstartday").val()!=""){
            $.ajax({
                url: 'process-searchTour.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $(".listtour").html(res);
                }
            });
            return false;
        //}
    })
})

$(document).ready(function(){
    $("#display").click(function(){
        $("#searchStartLocation").val("")
        $("#searchEndLocation").val("")
        $("#searchcdTour").val("")
        $("#searchnumberday").val("")
        $("#searchPrice").val("")
        $("#checkbox1").prop("checked",false);
        $("#checkbox2").prop("checked",false);
    })
})

//hủy đặt tour
$(".deleteBKT").click(function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $(".idBookingTour").text(data[0]);
    $(".idBookingTourVal").val((data[0]));
})

$(document).ready(function(){
    $("#submitapproveBKT").click(function(){
        let codebookingtour = $(".idBookingTour").text();
        if(codebookingtour!=""){
            let form_datas = new FormData();
            form_datas.append('codebookingtour',codebookingtour);
            $.ajax({
                url: 'process-deleteService.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $(".listTourBookingCho").html(res);
                    $("#helpinfo").text("Phê duyệt thành công!");
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin xóa chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})

//Phê duyệt đặt Tour
$(".deleteBKTE").click(function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $(".idBookingTours").text(data[0]);
})

$(document).ready(function(){
    $("#submitDeleteBKT").click(function(){
        let codebookingtour = $(".idBookingTours").text();
        var tourcode = $("#my_name_tour").val();
        if(codebookingtour!=""){
            let form_datas = new FormData();
            form_datas.append('codebookingtour',codebookingtour);
            form_datas.append('tourcode',tourcode);
            $.ajax({
                url: 'process-deleteBKT.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $(".listTourBookingCho").html(res);
                    $("#helpinfo").text("Xóa thành công!").css("color","green");
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin xóa chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})
$(".PDBKT").click(function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $(".idBookingTour").text(data[0]);
})

$(document).ready(function(){
    $("#submitapproveBKT").click(function(){
        let codebookingtour = $(".idBookingTour").text();
        var tourcode = $("#my_name_tour").val();
        if(codebookingtour!=""){
            let form_datas = new FormData();
            form_datas.append('codebookingtour',codebookingtour);
            form_datas.append('tourcode',tourcode);
            $.ajax({
                url: 'process-approveBookingTour.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    $(".listTourBookingCho").html(res);
                    $("#helpinfo").text("Phê duyệt thành công!").css("color","green");
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin phê duyệt chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})

//xem chi tiết đơn đặt Tour

$(document).ready(function(){
    $(".clickinformation").click(function(){
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log("OK");
        let form_datas = new FormData();
        console.log($(this).val());
        form_datas.append('codebookingtour',data[0]);
        $.ajax({
            url: 'process-informationBookingTour.php', // gửi đến file upload.php 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datas,
            type: 'post',
            success: function(res) {
                $(".modal-body").html(res);
            }
        });
        return false;
    })
})
$(document).ready(function(){
    $(".clickinformation1").click(function(){
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        console.log("OK");
        let form_datas = new FormData();
        console.log($(this).val());
        form_datas.append('codebookingtour',data[0]);
        $.ajax({
            url: '../process-informationBookingTour.php', // gửi đến file upload.php 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datas,
            type: 'post',
            success: function(res) {
                $(".modal-body").html(res);
            }
        });
        return false;
    })
})

//review
$(document).ready(function(){
    $("#customRange1").change(function(){
        $(".reviewB").text($("#customRange1").val());
        $(".reviewBC").val($("#customRange1").val());
    })
})
$(".clickreview").click(function(){
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $(".codebooktour").val(data[0]);
})
