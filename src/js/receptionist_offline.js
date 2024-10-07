const docCharge = document.getElementById("docCharge"); //storing the docCharge input box in a variable
const hospCharge = document.getElementById("hospCharge"); //storing the hospCharge input box in a variable

function calcTotal(){
<<<<<<< HEAD
    let totalCharge = Number(docCharge.value) + Number(hospCharge.value);
    document.getElementById("totalCharge").value = totalCharge;
} //function for calculating total charge and displaying it inside totalCharge box

docCharge.addEventListener("mouseout", calcTotal); //triggering calculate total when mouse cursor moved out from docCharge box
hospCharge.addEventListener("mouseout", calcTotal); //triggering calculate total when mouse cursor moved out from hospCharge box
=======
    let totalCharge = Number(docCharge.value) + Number(hospCharge.value);   
    document.getElementById("totalCharge").value = totalCharge; 
    //console.log(totalCharge);
}
 
docCharge.addEventListener("mouseout", calcTotal);
hospCharge.addEventListener("mouseout", calcTotal);
>>>>>>> 8fad60b43b83a773ceb16d5981fe739bb47ca34c

const docID = document.getElementById("docID"); //storing the docID input box in a variable
const docs = document.getElementById("docs"); //storing the docs element in a variable


function updateDocID(){
    const fetchDocID = document.getElementById("docs").value;
    docID.value = fetchDocID;
} //function for updating the docID display value according to the selected option in dropdown list

updateDocID(); //calling the update function at load to display correct docID at load

docs.addEventListener("mouseout", updateDocID); //update the docID when mouse cursor moved out from dropdown list