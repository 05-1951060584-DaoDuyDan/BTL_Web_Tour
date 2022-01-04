$(document).ready(function(){
    $("#text").change(function(){
        let emailPattern = /^[0-9]{10}(@e)$/;
        if(emailPattern.test($(this).val()) == false){
            $("textHelp").text("Tên không hợp lệ").css("color","red");
        }
    })
})