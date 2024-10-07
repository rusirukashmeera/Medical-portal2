const navbar = document.getElementById("navbar").innerHTML; //navbar

function hideNavbar(){
    document.getElementById("navbar").innerHTML = ``;
    document.getElementById("navbar").style.backgroundColor = "transparent";
    document.getElementById("content").style.paddingTop = "120px";
} //function to hide the navbar on call

function showNavbar(){
    document.getElementById("navbar").innerHTML = navbar;
    document.getElementById("navbar").style.backgroundColor = "#8393ca";
    document.getElementById("content").style.paddingTop = "170px";
} //function to show the navbar on call

function dynamicNavbar(){
    let currentPos = window.scrollY; //vertical position of the page, at the time of function call
    
    if(currentPos > limit){
        if(prevPos > currentPos){
            showNavbar();
        }
        else{
            hideNavbar();
        }
    } //execute show or hide if scrolled over the limit, hide if scrolled down, show if scrolled up
    else{
        showNavbar(); //make sure to always show the navbar unless scrolled over the limit
    } 

    prevPos = currentPos;
} //function to show or hide the navbar depending on scroll position

let prevPos = window.scrollY; //vertical position of the page on load
let limit = 50; //minimum scroll to trigger the functions

//window.addEventListener("scroll", dynamicNavbar); //call the dynamic navbar function when the page is scrolled