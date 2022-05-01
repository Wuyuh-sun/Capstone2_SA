const newPw = document.getElementById("inputNewPW");
const newPw_check = document.getElementById("inputRePW");

function newPwCheck(){
  if(newPw.value !=""){
    newPw.style.backgroundImage="url(../img/check_red.png)";
  }else{
    newPw.style.backgroundImage="url(../img/x_red.png)";
  }
}
function newPwCheck2(){
  if(newPw_check.value == newPw.value){
    newPw_check.style.backgroundImage="url(../img/check_red.png)";
  }else{
    newPw_check.style.backgroundImage="url(../img/x_red.png)";
  }
}
function check_input(){
  if (!document.findPW_update_form.newPW.value) { 
    alert("비밀번호를 입력하세요"); 
    document.findPW_update_form.newPW.focus();
    return;
  }
  if (!document.findPW_update_form.newPW_check.value) { 
    alert("비밀번호 확인을 입력하세요"); 
    document.findPW_update_form.newPW_check.focus();
    return;
  }
  if (document.findPW_update_form.newPW_check.value !== document.findPW_update_form.newPW.value) { 
    alert("비밀번호를 다시 확인해주세요"); 
    document.findPW_update_form.newPW_check.focus();
    return;
  }
  document.findPW_update_form.submit();
}