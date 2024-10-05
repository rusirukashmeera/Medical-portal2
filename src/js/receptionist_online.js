const speciality = document.getElementById("speciality");
const doctor = document.getElementById("doctor");
const date = document.getElementById("date");
const time1 = document.getElementById("time-slot1");
const time2 = document.getElementById("time-slot2");
const time3 = document.getElementById("time-slot3");


const edit = document.getElementById("edit");

function enableEdit(){
    speciality.disabled = false;
    doctor.disabled = false;
    date.removeAttribute("readonly");
    time1.disabled = false;
    time2.disabled = false;
    time3.disabled = false;
}

// search patient reference number
function searchPatient() {
    var searchId = document.getElementById("searchId").value;
}          

// cancel the recervaton
const cancel = document.getElementById("cancel");
cancel.addEventListener("click", cancelReservation);

function cancelReservation() {
    alert("Do you want to cancel the reservation?");
}

// var specialty = document.getElementById('specialty').value;
// var doctor = document.getElementById('doctor').value;
// var date = document.getElementById('date').value;

function confirmReservation() {


}
