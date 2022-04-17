const bbs_listAfter = document.getElementById("bbs_list");

bbs_listAfter.addEventListener("click", function(){
  if(bbs_listAfter.style.top === "-132px"){
    bbs_listAfter.style.top = "70px";
  } else{
    bbs_listAfter.style.top = "-132px";
  }
  
})