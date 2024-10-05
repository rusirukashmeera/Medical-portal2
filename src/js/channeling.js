const channel = document.getElementById("channel");
const date = document.getElementById("date");
const time = document.getElementById("time");
const slot1 = document.getElementById("slot1");
const slot2 = document.getElementById("slot2");
const slot3 = document.getElementById("slot3");

function checkDate(event){
    if(date.value == ""){
        event.preventDefault();
        window.alert("Please select a date");
    }
}

function checkTime(event){
    if(!(slot1.checked || slot2.checked || slot3.checked)){
        event.preventDefault();
        window.alert("Please select a time");
    }
}

channel.addEventListener("click", checkDate);
channel.addEventListener("click", checkTime);