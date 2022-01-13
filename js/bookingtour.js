function ps_price(str){
    let sprice = String(str);
    let stringres = '';
    let le = sprice.length;
    if(le>0 &&  le<=3){
        stringres = sprice+' đ';
    }else if(le>3 &&  le<=6){
        stringres = sprice.slice(0,-3)+'.'+sprice.slice(-3,le)+' đ';
    }else if(le>6 &&  le<=9){
        stringres = sprice.slice(0,-6)+'.'+sprice.slice(-6,-3)+'.'+sprice.slice(-3,le)+' đ';
    }else if(le>9 &&  le<=12){
        stringres = sprice.slice(0,-9)+'.'+sprice.slice(-9,-6)+'.'+sprice.slice(-6,-3)+'.'+sprice.slice(-3,le)+' đ';
    }

    return stringres;
}

let adult = $('#numberadult').val();
let child = $('#numberchild').val();
let baby = $('#numberbaby').val();
let adu = Number(adult);
let chi = Number(child);
let bab = Number(baby);
let adultprice = Number($(".constAdultPrice").text());
let childprice = Number($(".constChildPrice").text());
let vatPrice = Number($(".constVatPrice").text());
let tong;
function addadult() {
    adu += 1;
    $('#numberadult').val(String(adu));
    tong = adultprice*adu + childprice*chi;
    $(".numberAdultTotal").text(adu);
    $(".adultTotalPrice").text(ps_price(adu*adultprice));
    $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
    $(".total-price").text(ps_price(tong - tong*(vatPrice*1/100)));
}

function removeadult() {
    if (adu > 1) {
        adu -= 1;
        $('#numberadult').val(String(adu));
        tong = adultprice*adu + childprice*chi;
        $(".numberAdultTotal").text(adu);
        $(".adultTotalPrice").text(ps_price(adu*adultprice));
        $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
        $(".total-price").text(ps_price(tong - tong*(vatPrice*1/100)));
    }
}

function addchild() {
    chi += 1;
    $('#numberchild').val(String(chi));
    tong = adultprice*adu + childprice*chi;
    $(".numberChildTotal").text(chi);
    $(".childTotalPrice").text(ps_price(chi*childprice));
    $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
    $(".total-price").text(ps_price(tong - tong*(vatPrice*1/100)));
}

function removechild() {
    if (chi > 0) {
        chi -= 1;
        $('#numberchild').val(String(chi));
        tong = adultprice*adu + childprice*chi;
        $(".numberChildTotal").text(chi);
        $(".childTotalPrice").text(ps_price(chi*childprice));
        $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
        $(".total-price").text(ps_price(tong - tong*(vatPrice*1/100)));
    }
}

function addbaby() {
    bab += 1;
    $('#numberbaby').val(String(bab));
    $(".numberBabyTotal").text(bab);
}

function removebaby() {
    if (bab > 0) {
        bab -= 1;
        $('#numberbaby').val(String(bab));
        $(".numberBabyTotal").text(bab);
    }
}

$(document).ready(function() {

})