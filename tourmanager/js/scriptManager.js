

function checkManager(){
    if(($("#inlineRadio1").is(":checked")==true)|| ($("#inlineRadio2").is(":checked")==true) && $("#typepage").val()!="Loại trang" && $("#nameindustry").val()!="" && $("#nametouroperator").val()!="" && $("#email").val()!="" && $("#phonenumber").val()!="" && $("#imgManager").val()!="" && $("#emailHelp").text()!="Email đã tồn tại trong server."){
        
        return true;

    }else{
        return false;
    }
    //return false;
}

$(document).ready(function(){
    $("#email").change(function(){
        let email = $("#email").val();
        if(email!=""){
            let form_datas = new FormData();
            form_datas.append('email',email);
            $.ajax({
                url: 'process-emailManager.php', // gửi đến file upload.php 
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_datas,
                type: 'post',
                success: function(res) {
                    if(res=="Email đã tồn tại trong server.")
                        $("#emailHelp").text(res).css("color","red");
                    else
                        $("#emailHelp").text(res).css("color","green");
                    console.log(res);
                }
            });
            return false;
        }else{
            $(".inforAddService").text("Thông tin xóa chưa đầy đủ mời nhập lại!").css('color','red');
        }
    })
})