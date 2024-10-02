function calcTotal(){
    let docCharge = document.getElementById("docCharge").value;
    let hospCharge = document.getElementById("hospCharge").value;
    let totalCharge = Number(docCharge) + Number(hospCharge);
    document.getElementById("totalCharge").value = totalCharge;
    console.log(totalCharge);
}