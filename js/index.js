const wrapper = document.querySelector('.wrapper');
// inputPart = document.querySelector('.input-part');
infoTxT = document.querySelector('.info-txt');
// inputField = document.querySelector('input');
// locationbtn = document.querySelector('buttom');
weatherPart = document.querySelector('.weather-part');
wIcon = document.querySelector('.wrapper img');
// arrowBack = document.querySelector('header i');

let api;
let apikey = '537dffe96e4cc109abe4b055216dcba6';
let city = 'Ha Noi';
let info;



$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(onSuccess, onError);
    }else{
        alert("Your browser not support geolocation api");
    }
});

function onSuccess(position){
    const {latitude, longitude} = position.coords;
    api = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&appid=537dffe96e4cc109abe4b055216dcba6`;
    fetchData();
}

function onError(error){
    infoTxt.innerText = error.message;
    infoTxt.classList.add("error");
}

function fetchData(){
    fetch(api).then(res => res.json()).then(result => weatherDetails(result)).catch(() =>{
    });
}

function weatherDetails(info){
    if(info.cod == "404"){
        infoTxt.classList.replace("pending", "error");
        infoTxt.innerText = `${inputField.value} isn't a valid city name`;
    }else{
        const city = info.name;
        const country = info.sys.country;
        const {description, id} = info.weather[0];
        const {temp, feels_like, humidity} = info.main;
        //alert(city);
        if(id == 800){
            wIcon.src = "icon/clear.svg";
        }else if(id >= 200 && id <= 232){
            wIcon.src = "icon/storm.svg";  
        }else if(id >= 600 && id <= 622){
            wIcon.src = "icon/snow.svg";
        }else if(id >= 701 && id <= 781){
            wIcon.src = "icon/haze.svg";
        }else if(id >= 801 && id <= 804){
            wIcon.src = "icon/cloud.svg";
        }else if((id >= 500 && id <= 531) || (id >= 300 && id <= 321)){
            wIcon.src = "icon/rain.svg";
        }
        weatherPart.querySelector(".temp .numb").innerText = '26';
        weatherPart.querySelector(".temp .numb").innerText = Math.floor(temp);
        weatherPart.querySelector(".weather").innerText = description;
        weatherPart.querySelector(".location .address").innerText = `${city}, ${country}`;
        weatherPart.querySelector(".temp .numb-2").innerText = Math.floor(feels_like);
        weatherPart.querySelector(".humidity .humid").innerText = `${humidity}%`;
       //wrapper.classList.add("active");
       document.querySelector('.wrapper').style.display = "block";
    }
}

