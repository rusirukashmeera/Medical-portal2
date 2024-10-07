//IT23840782  W.M.D.N.Weerakoon

// Access to the doctor id and doctor name of input fields using Ids
const docID = document.getElementById("docID");
const docs = document.getElementById("docs");

function updateDocID(){
    const fetchDocID = document.getElementById("docs").value;
    docID.value = fetchDocID;
}

//function calling for updateDocID
updateDocID();

//add "mouseout" event listner when doctor name updated
docs.addEventListener("mouseout", updateDocID);

// Access to the hospital charge and doctor charge of input field using Ids 
const charge = document.getElementById("charge");
const HCharge = document.getElementById("HCharge");
const DocCharge = document.getElementById("DocCharge");

//calculate the hospital and doctor charges
function calcCharge(){
    charge.value = Number(HCharge.value) + Number(DocCharge.value);
}

//add 'mouseout' event listner for total calculation when mouse out from the input field
HCharge.addEventListener("mouseout", calcCharge);
DocCharge.addEventListener("mouseout", calcCharge);