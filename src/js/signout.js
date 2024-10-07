const signupBtn = document.getElementById("signupBtn"); //signup button
const logoutForm = document.getElementById("logoutForm"); //logout form

function logOut(){
    logoutForm.submit();
} //function to submit the logout form manually on call

signupBtn.addEventListener("click", logOut); //submit the logout form on click of Sign Out button, form POST values will be captured in php code to process the signout