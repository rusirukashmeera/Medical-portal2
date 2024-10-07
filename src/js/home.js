const check = document.getElementById("check"); //error message label
const email = document.getElementById("email"); //email input
const password = document.getElementById("password"); //password input
const signinHome = document.getElementById("signinHome"); //sign in button

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
} //check whether password and email fields are empty and prevent form submission if at least one is empty

signinHome.addEventListener("click", loginCheck); //validate email password on click of sign in button

const signupBtn = document.getElementById("signupBtn"); //signup button
const signupForm = document.getElementById("signupForm"); //logout formx

function signUp(){
    signupForm.submit();
} //function to submit the logout form manually on call

signupBtn.addEventListener("click", signUp); //submit the logout form on click of Sign Out button, form POST values will be captured in php code to process the signout