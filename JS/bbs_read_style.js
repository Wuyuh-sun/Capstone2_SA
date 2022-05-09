const commIcon_img = document.getElementById("commIcon_img");

const commView_form = document.getElementById("commView_form");


function commOpen(){
  if(commView_form.style.display == "inline"){
    commIcon_img.src="../../img/댓글.png";
    commView_form.style.display = "none"
  } else{
    commIcon_img.src="../../img/댓글2.png";
    commView_form.style.display = "inline"
  }
}

commIcon_img.addEventListener("click", commOpen);
