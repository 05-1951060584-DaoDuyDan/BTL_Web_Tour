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
    let tongtiendv = 0;
    for(let j = 0; j < Number($('#countservice').val()); j++){
        let cbs = "#checkbox"+j;
        if($(cbs).is(":checked")==true){
            let price = Number($("#priceserviceadd"+j).val());
            let numberkh = Number($("#numberpag"+j).val());
            tongtiendv += price*numberkh;
        }
    }
    tong = adultprice*adu + childprice*chi+tongtiendv;
    $(".numberAdultTotal").text(adu);
    $(".adultTotalPrice").text(ps_price(adu*adultprice));
    $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
    $(".total-price").text(ps_price(tong + tong*(vatPrice*1/100)));
    $("#totalpricepost").val(tong + tong*(vatPrice*1/100));
}

function removeadult() {
    if (adu > 1) {
        adu -= 1;
        $('#numberadult').val(String(adu));
        let tongtiendv = 0;
        for(let j = 0; j < Number($('#countservice').val()); j++){
            let cbs = "#checkbox"+j;
            if($(cbs).is(":checked")==true){
                let price = Number($("#priceserviceadd"+j).val());
                let numberkh = Number($("#numberpag"+j).val());
                tongtiendv += price*numberkh;
            }
        }
        tong = adultprice*adu + childprice*chi+tongtiendv;
        $(".numberAdultTotal").text(adu);
        $(".adultTotalPrice").text(ps_price(adu*adultprice));
        $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
        $(".total-price").text(ps_price(tong + tong*(vatPrice*1/100)));
        $("#totalpricepost").val(tong + tong*(vatPrice*1/100));
    }
}

function addchild() {
    chi += 1;
    $('#numberchild').val(String(chi));
    let tongtiendv = 0;
    for(let j = 0; j < Number($('#countservice').val()); j++){
        let cbs = "#checkbox"+j;
        if($(cbs).is(":checked")==true){
            let price = Number($("#priceserviceadd"+j).val());
            let numberkh = Number($("#numberpag"+j).val());
            tongtiendv += price*numberkh;
        }
    }
    tong = adultprice*adu + childprice*chi+tongtiendv;
    $(".numberChildTotal").text(chi);
    $(".childTotalPrice").text(ps_price(chi*childprice));
    $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
    $(".total-price").text(ps_price(tong + tong*(vatPrice*1/100)));
    $("#totalpricepost").val(tong + tong*(vatPrice*1/100));
}

function removechild() {
    if (chi > 0) {
        chi -= 1;
        $('#numberchild').val(String(chi));
        let tongtiendv = 0;
        for(let j = 0; j < Number($('#countservice').val()); j++){
            let cbs = "#checkbox"+j;
            if($(cbs).is(":checked")==true){
                let price = Number($("#priceserviceadd"+j).val());
                let numberkh = Number($("#numberpag"+j).val());
                tongtiendv += price*numberkh;
            }
        }
        tong = adultprice*adu + childprice*chi+tongtiendv;
        $(".numberChildTotal").text(chi);
        $(".childTotalPrice").text(ps_price(chi*childprice));
        $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
        $(".total-price").text(ps_price(tong + tong*(vatPrice*1/100)));
        $("#totalpricepost").val(tong + tong*(vatPrice*1/100));
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

for(let i = 0; i < Number($('#countservice').val()); i++){
    $(document).ready(function() {
        let teninput = "#numberpag"+i;
        $(teninput).change(function(){
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
            let cb = "#checkbox"+i;
            if($(cb).is(":checked")==true){
                let tongtiendv = 0;
                for(let j = 0; j < Number($('#countservice').val()); j++){
                    let cbs = "#checkbox"+j;
                    if($(cbs).is(":checked")==true){
                        let price = Number($("#priceserviceadd"+j).val());
                        let numberkh = Number($("#numberpag"+j).val());
                        tongtiendv += price*numberkh;
                    }
                }
            tong = adultprice*adu + childprice*chi+tongtiendv;
            $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
            $(".total-price").text(ps_price(tong + tong*(vatPrice*1/100)));
            $("#totalpricepost").val(tong + tong*(vatPrice*1/100));
            }
        })
    })
}

for(let i = 0; i < Number($('#countservice').val()); i++){
    $(document).ready(function() {
        let cb = "#checkbox"+i;
        $(cb).click(function(){
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
            if($(cb).is(":checked")==false){
                $("#numberpag"+i).val('');
                let tongtiendv = 0;
                for(let j = 0; j < Number($('#countservice').val()); j++){
                    let cbs = "#checkbox"+j;
                    if($(cbs).is(":checked")==true){
                        let price = Number($("#priceserviceadd"+j).val());
                        let numberkh = Number($("#numberpag"+j).val());
                        tongtiendv += price*numberkh;
                    }
                }
                tong = adultprice*adu + childprice*chi+tongtiendv;
                $(".vatTotalPrice").text(ps_price(tong*(vatPrice*1/100)));
                $(".total-price").text(ps_price(tong + tong*(vatPrice*1/100)));
                $("#totalpricepost").val(tong + tong*(vatPrice*1/100));
            }
        })
    })
}

$(document).ready(function() {
    let ab = $(".total-price").text();
    ab = ab.replace(' đ','');
    ab = ab.replace('.','');
    $("#totalpricepost").val(ab);
})

function kiemtra(){
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
    let tongtiendv = 0;
    for(let j = 0; j < Number($('#countservice').val()); j++){
        let cbs = "#checkbox"+j;
        if($(cbs).is(":checked")==true){
            let price = Number($("#priceserviceadd"+j).val());
            let numberkh = Number($("#numberpag"+j).val());
            tongtiendv += price*numberkh;
        }
    }
    tong = adultprice*adu + childprice*chi+tongtiendv;
    tong = tong + tong*(vatPrice*1/100);
    if($("#surname").val()!="" && $("#name").val()!="" && $("input[name='gender']:checked").val() == "Nam" || $("input[name='gender']:checked").val() == "Nữ" && $("#email").val()!=""  && $("#phonenumber").val()!="" && $("#address").val()!="")
    {
        for(let j = 0; j < Number($('#countservice').val()); j++){
            let cbs = "#checkbox"+j;
            if($(cbs).is(":checked")==true){
                if($("#numberpag"+j).val()==''){
                    return false;
                }
            }
        }
        if(tong!=Number($("#totalpricepost").val())){
            return false;
        }
        if($("input[name='dieukhoan']:checked").val()!='dieukhoan'){
            return false;
        }
        return true;
    }else{
        return false;
    }
}