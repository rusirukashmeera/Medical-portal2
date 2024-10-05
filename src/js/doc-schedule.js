//function to make visible table and start session button
function toggleTableVisibility() {
    const table = document.getElementById("schedule-table");
    const start = document.getElementById("start-session");
    
    table.style.visibility = "visible";
    start.style.visibility = "visible";

}

document.getElementById("submit").addEventListener("click", toggleTableVisibility);
