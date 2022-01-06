$(document).ready(function(){
    $("#text").change(function(){
        let textPattern = /^[0-9]{10}$/;
        if(textPattern.test($(this).val()) == false){
            $("textHelp").text("Tên không hợp lệ").css("color","red");
        }
    })
})