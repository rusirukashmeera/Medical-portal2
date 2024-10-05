const signinForm = document.getElementById("signinForm");
const check = document.getElementById("check");
const email = document.getElementById("email");
const password = document.getElementById("password");
const signinHome = document.getElementById("signinHome");

function loginCheck(event){
    if(email.value == "" && password.value == ""){
        event.preventDefault();
        check.innerHTML = "<br><br>Please provide a username<br>Please provide a password";
    }
    else if(email.value == ""){
        event.preventDefault();
        check.innerHTML = "<br><br>Please provide a username";
    }
    else if(password.value == ""){
        event.preventDefault();
        check.innerHTML = "<br><br>Please provide a password";
    }
}

signinHome.addEventListener("click", loginCheck);