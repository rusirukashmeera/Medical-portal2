//IT23840782  W.M.D.N.Weerakoon

// Access to the speciality, doctor, date, time-slots input fields using Ids
const speciality = document.getElementById("speciality");
const doctor = document.getElementById("doctor");
const date = document.getElementById("date");
const time1 = document.getElementById("time-slot1");
const time2 = document.getElementById("time-slot2");
const time3 = document.getElementById("time-slot3");

// Access to the edit button using Id
const edit = document.getElementById("edit");

//Function for enable to editing of appointment detail
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
//cancel.addEventListener("click", cancelReservation);


function cancelReservation() {
    alert("Do you want to cancel the reservation?");
}

// Access to the hospital charge and doctor charge of input field using Ids 
const charge = document.getElementById("charge");
const HCharge = document.getElementById("HCharge");
const DocCharge = document.getElementById("DocCharge");

//calculate the hospital and doctor charges
function calcCharge(){
    charge.value = Number(HCharge.value) + Number(DocCharge.value); //convert the input field values to numbers
}

//add 'mouseout' event listner for total calculation when mouse out from the input field
HCharge.addEventListener("mouseout", calcCharge);
DocCharge.addEventListener("mouseout", calcCharge);

//Access to the sign in and logout button using id
const signupBtn = document.getElementById("signupBtn");
const logoutForm = document.getElementById("logoutForm");


function logOut(){
    logoutForm.submit();
}

signupBtn.addEventListener("click", logOut);