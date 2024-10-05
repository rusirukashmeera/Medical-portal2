const docID = document.getElementById("docID");
const docs = document.getElementById("docs");

function updateDocID(){
    const fetchDocID = document.getElementById("docs").value;
    docID.value = fetchDocID;
}

updateDocID();

docs.addEventListener("mouseout", updateDocID);

const charge = document.getElementById("charge");
const HCharge = document.getElementById("HCharge");
const DocCharge = document.getElementById("DocCharge");

function calcCharge(){
    charge.value = Number(HCharge.value) + Number(DocCharge.value);
}

HCharge.addEventListener("mouseout", calcCharge);
DocCharge.addEventListener("mouseout", calcCharge);