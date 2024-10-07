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
    
    if(currentPos > limit){
        if(prevPos > currentPos){
            showNavbar();
        }
        else{
            hideNavbar();
        }
    }
    else{
        showNavbar();
    }

    prevPos = currentPos;
}

let prevPos = window.scrollY;
let limit = 50;

window.addEventListener("scroll", dynamicNavbar);

// const signupBtn = document.getElementById("signupBtn");
// const signupForm = document.getElementById("signupForm");

// function signUp(){
//     signupForm.submit();
// }

// signupBtn.addEventListener("click", signUp);