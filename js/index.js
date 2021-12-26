const wrapper = document.querySelector('.wrapper');
// inputPart = document.querySelector('.input-part');
infoTxT = document.querySelector('.info-txt');
// inputField = document.querySelector('input');
// locationbtn = document.querySelector('buttom');
weatherpart = document.querySelector('.wrapper-part');
wicon = document.querySelector('img');
// arrowBack = document.querySelector('header i');

let api;
let apikey = '537dffe96e4cc109abe4b055216dcba6';
let city = 'Ha Noi';
let info;

// api = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apikey}`;
// info = fetch(api).then(Response => console.log(Response.json())).name;
// console.log(fetch(api).then(Response => console.log(Response.json())).name);

// // info = fetch(api).then(res => res.json());


// console.log(info.city);

navigator.geolocation.getCurrentPosition((success)=>{
    console.log(success);
    let {latitude, longitude} = success.coords;
    api = 'https://api.openweathermap.org/data/2.5/onecall?lat=${latitude}&lon=${longitude}&units=metric&appid=${apikey}'
})
// infoTxt.innerText = "Getting weather details...";
// infoTxt.classList.add("pending");
fetch(api).then(res => res.json()).then(result => weatherDetails(info)).catch(() =>{
    // infoTxt.innerText = "Something went wrong";
    // infoTxt.classList.replace("pending", "error");
});

function weatherDetails(info){
    if(info.cod == "404"){
        // infoTxt.classList.replace("pending", "error");
        // infoTxt.innerText = `${inputField.value} isn't a valid city name`;
    }else{
        const city = info.name;
        const country = info.sys.country;
        const {description, id} = info.weather[0];
        const {temp, feels_like, humidity} = info.main;

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
        
        weatherPart.querySelector(".temp .numb").innerText = Math.floor(temp);
        weatherPart.querySelector(".weather").innerText = description;
        weatherPart.querySelector(".location span").innerText = `${city}, ${country}`;
        weatherPart.querySelector(".temp .numb-2").innerText = Math.floor(feels_like);
        weatherPart.querySelector(".humidity span").innerText = `${humidity}%`;
        infoTxt.classList.remove("pending", "error");
        infoTxt.innerText = "";
        inputField.value = "";
        wrapper.classList.add("active");
    }
}

