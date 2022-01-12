$(document).ready(function(){
    $("#nameindustry").change(function(){
        let textPattern = /^[0-9]{10}$/;
        if(textPattern.test($(this).val()) == false){
            $("#textHelp").text("Tên không hợp lệ").css("color","red");
        }
    })
})