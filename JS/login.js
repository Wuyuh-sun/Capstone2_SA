const saHome = document.getElementById("SA_HOME");
const sa = document.getElementById("SA");
const smokearea = document.getElementById("smokearea");
const loginform = document.getElementById("loginform");
const login_top = document.getElementById("login_top");
const login_bottom = document.getElementById("login_bottom");
const login_center = document.getElementById("login_center");
const findPW = document.getElementById("findPW");
const signUP = document.getElementById("signUP");


function homeClick(){
    // console.log("click!");
    saHome.classList.add("Home_after");
    sa.classList.add("SA_after");
    smokearea.classList.add("smokearea_after");
    loginform.classList.add("form_after");
}

saHome.addEventListener("click", homeClick);



