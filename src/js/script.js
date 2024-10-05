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

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b9b4418c14b99be7804ae8f772d35912ef5d283d
window.addEventListener("scroll", dynamicNavbar);

const signinForm = document.getElementById("signinForm");
const check = document.getElementById("check");
const email = document.getElementById("email");
const password = document.getElementById("password");
const signinHome = document.getElementById("signinHome");
/*
function loginCheck(event){
    if(email.value == ""){
        event.preventDefault();
        check.textContent = "email";
    }
}

<<<<<<< HEAD
signinHome.addEventListener("click", loginCheck);*/
=======
signinHome.addEventListener("click", loginCheck);*/
=======
window.addEventListener("scroll", dynamicNavbar);
>>>>>>> 1c19a08156ea0251a8467ecccc3387e1344c2fc8
>>>>>>> b9b4418c14b99be7804ae8f772d35912ef5d283d
