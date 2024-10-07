    const channel = document.getElementById("channel");
    const date = document.getElementById("date");
    const time = document.getElementById("time");
    const slot1 = document.getElementById("slot1");
    const slot2 = document.getElementById("slot2");
    const slot3 = document.getElementById("slot3");


    
 /* Checks if the date field is empty and stops the action and shows an alert */
    function checkDate(event){
        if(date.value == ""){
            event.preventDefault();
            window.alert("Please select a date");
        }
    }

    /*Checks if any of the time slots (slot1, slot2, or slot3) are selected.
  If not selected, it stops the action and shows an alert */
    function checkTime(event){
        if(!(slot1.checked || slot2.checked || slot3.checked)){
            event.preventDefault();
            window.alert("Please select a time");
        }
    }

    /* Adds event listeners to the 'channel' element,
     so that both date and time are checked when clicked*/
    channel.addEventListener("click", checkDate);
    channel.addEventListener("click", checkTime);

    const DoctorID = document.getElementById("Doctor-ID");
    const doctor = document.getElementById("doctor");

    /*Updates the 'DoctorID' field with the selected doctor's ID.
     when the user changes the doctor.*/
    function updateDocID(){
        const fetchDocID = document.getElementById("doctor").value;
        DoctorID.value = fetchDocID;
    }

    // Updates the 'DoctorID' field as soon as the script runs
    updateDocID();

    /* Adds an event listener to update 
    the 'DoctorID' field whenever the user selects a new doctor*/
    doctor.addEventListener("mouseout", updateDocID);