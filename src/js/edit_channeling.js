document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.querySelector('.edit');
    const inputs = document.querySelectorAll('.details, select, input[type="radio"]');

    editButton.addEventListener('click', function () {
        // Toggle read-only state
        inputs.forEach(input => {
            if (input.tagName === 'INPUT' && input.type !== 'radio') {
                input.disabled = !input.disabled; // Toggle the disabled attribute
            } else if (input.tagName === 'SELECT') {
                input.disabled = !input.disabled; // Toggle the disabled attribute
            } else if (input.tagName === 'INPUT' && input.type === 'radio') {
                input.disabled = false; // Enable radio buttons for selection
            }
        });

        // Change button text based on the current state
        if (editButton.textContent === 'EDIT') {
            editButton.textContent = 'SAVE'; // Change button text to SAVE
        } else {
            editButton.textContent = 'EDIT'; // Change button text back to EDIT

            // Optionally: You can add code here to save the updated values, if necessary.
            // For example, you might want to collect the values from the inputs and send them to a server or store them locally.
        }
    });
});
