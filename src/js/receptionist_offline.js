const docCharge = document.getElementById("docCharge");
const hospCharge = document.getElementById("hospCharge");

function calcTotal(){
    let totalCharge = Number(docCharge.value) + Number(hospCharge.value);
    document.getElementById("totalCharge").value = totalCharge;
    console.log(totalCharge);
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