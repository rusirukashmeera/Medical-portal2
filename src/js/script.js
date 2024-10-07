const navbar = document.getElementById("navbar").innerHTML;

function hideNavbar(){
    document.getElementById("navbar").innerHTML = ``;
    document.getElementById("navbar").style.backgroundColor = "transparent";
    document.getElementById("content").style.paddingTop = "120px";
}

function showNavbar(){
    document.getElementById("navbar").innerHTML = navbar;
    document.getElementById("navbar").style.backgroundColor = "#8393ca";
    document.getElementById("content").style.paddingTop = "170px";
}

function dynamicNavbar(){
    let currentPos = window.scrollY;
    if(prevPos > currentPos){
        showNavbar();
    }
    else{
        hideNavbar();
    }
    prevPos = currentPos;
}

let prevPos = window.scrollY;

window.addEventListener("scroll", dynamicNavbar);

// const signinForm = document.getElementById("signinForm");
// const check = document.getElementById("check");
// const email = document.getElementById("email");
// const password = document.getElementById("password");
// const signinHome = document.getElementById("signinHome");
/*
function loginCheck(event){
    if(email.value == ""){
        event.preventDefault();
        check.textContent = "email";
    }
}
signinHome.addEventListener("click", loginCheck);*/

window.addEventListener("scroll", dynamicNavbar);

const signupBtn = document.getElementById("signupBtn");
const signupForm = document.getElementById("signupForm");

function signUp(){
    signupForm.submit();
}

signupBtn.addEventListener("click", signUp);