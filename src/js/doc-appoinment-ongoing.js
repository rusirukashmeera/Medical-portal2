
function validateInputs() {
    const patientId = document.getElementById('patient_id').value;
    const prescriptionDetails = document.getElementById('prescription-details').value;

    // Validate patient_id
    if (isNaN(patientId)) {
        alert('Patient ID must be an integer.');
        return false;
    }
    // Validate prescription-details
    if (prescriptionDetails.length > 2000) {
        alert('Prescription details must be less than 2000 characters.');
        return false;
    }

    return true;
}

// Add event listener to the form submission
document.querySelector('form').addEventListener('submit', function(event) {
    if (!validateInputs()) {
        event.preventDefault();
    }
});
