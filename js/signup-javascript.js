let pass1 = document.formsignup.pass1.value;
let pass2 = document.formsignup.pass2.value;

function matchpass() {
    if(pass1==pass2){
        alert("OK");
        return true;
    }
    else{
        alert("Mật khẩu nhập phải giống nhau!");
        return false;
    }
}