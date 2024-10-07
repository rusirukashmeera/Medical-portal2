
// Access to the doctor charge and hospital charge input fields using Ids
const docCharge = document.getElementById("docCharge");
const hospCharge = document.getElementById("hospCharge");

//function for calculate docCharge and hospCharge
function calcTotal(){
    let totalCharge = Number(docCharge.value) + Number(hospCharge.value);
    document.getElementById("totalCharge").value = totalCharge;   //read total value from totalCharge
    //console.log(totalCharge);
}
 
docCharge.addEventListener("mouseout", calcTotal);
hospCharge.addEventListener("mouseout", calcTotal);

const docID = document.getElementById("docID");
const docs = document.getElementById("docs");

function updateDocID(){
    const fetchDocID = document.getElementById("docs").value;
    docID.value = fetchDocID;
}

updateDocID();

docs.addEventListener("mouseout", updateDocID);

// const signupBtn = document.getElementById("signupBtn");
// const logoutForm = document.getElementById("logoutForm");

// function logOut(){
//     logoutForm.submit();
// }

// signupBtn.addEventListener("click", logOut);