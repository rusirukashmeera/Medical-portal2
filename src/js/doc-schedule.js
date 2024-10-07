//function to make visible table and start session button
function toggleTableVisibility() {
    const table = document.getElementById("schedule-table");
    const start = document.getElementById("start-session");
    
    table.style.visibility = "visible";
    start.style.visibility = "visible";

}

document.getElementById("submit").addEventListener("click", toggleTableVisibility);


// Get the form element
const form = document.getElementById('date-time');

// Add an event listener to the form submit event
form.addEventListener('submit', function(event) {
    // Get all radio buttons within the form
    const radioButtons = form.querySelectorAll('input[type="radio"]');
    let isSelected = false;
    
    // Loop through the radio buttons to check if one is selected
    for (let i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            isSelected = true;
            break;
        }
    }
    
    // If no radio button is selected, prevent form submission and show an error message
    if (!isSelected) {
        event.preventDefault();
        alert('Please select a time before submitting.');
    }
});
