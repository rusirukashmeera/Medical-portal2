const signupBtn = document.getElementById("signupBtn");
const logoutForm = document.getElementById("logoutForm");

function logOut(){
    logoutForm.submit();
}

signupBtn.addEventListener("click", logOut);