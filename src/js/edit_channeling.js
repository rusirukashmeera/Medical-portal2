// IT23823334 W.M.S.Methara
// Wait for the DOM content to fully load before running the script
document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.querySelector('.edit');
    const inputs = document.querySelectorAll('.details, select, input[type="radio"]');

    editButton.addEventListener('click', function (event) {
        // Toggle read-only state
        inputs.forEach(input => {
            if (input.tagName === 'INPUT' && input.type !== 'radio' && input.id !== "Appointment-ID" && input.id !== "doctor") {
                input.disabled = false; // Toggle the disabled attribute
            } else if (input.tagName === 'SELECT') {
                input.disabled = false; // Toggle the disabled attribute
            } else if (input.tagName === 'INPUT' && input.type === 'radio') {
                input.disabled = false; // Enable radio buttons for selection
            }
        });

        // Change button text based on the current state
        if (editButton.textContent === 'EDIT') {
            event.preventDefault();
            editButton.textContent = 'SAVE'; // Change button text to SAVE
            editButton.name = "save";
        } else {
            editButton.textContent = 'EDIT'; // Change button text back to EDIT
            editButton.name = "edit";
        }
    });
});

;