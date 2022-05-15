const email = document.getElementById('inputEmail');
const pw1 = document.getElementById('inputPW');
const pw2 = document.getElementById('inputPW_check');
const nickname = document.getElementById('inputNickName');

function emailCheck(){
  if(email.value !=''){
    email.style.backgroundImage='url(../img/check_red.png)';
  }else{
    email.style.backgroundImage='url(../img/x_red.png)';
  }
}
function pwCheck(){
  if(pw1.value !=''){
    pw1.style.backgroundImage='url(../img/check_red.png)';
  }else{
    pw1.style.backgroundImage='url(../img/x_red.png)';
  }
}
function pwCheck_2(){
  if(pw1.value == pw2.value){
    pw2.style.backgroundImage='url(../img/check_red.png)';
  }
  else{
    pw2.style.backgroundImage='url(../img/x_red.png)';
  }
}
function nickNameCheck(){
  if(nickname.value !=''){
    nickname.style.backgroundImage='url(../img/check_red.png)';
  }else{
    nickname.style.backgroundImage='url(../img/x_red.png)';
  }
}
function check_input(){
  if (!document.signUP_Form.email.value) { 
    alert('이메일을 입력하세요'); 
    document.signUP_Form.email.focus();
    return;
  }
  if (!document.signUP_Form.pw.value) { 
    alert('비밀번호를 입력하세요'); 
    document.signUP_Form.pw.focus();
    return;
  }
  if (!document.signUP_Form.pw_check.value) { 
    alert('비밀번호 확인을 입력하세요'); 
    document.signUP_Form.pw_check.focus();
    return;
  }
  if (!document.signUP_Form.nickname.value) { 
    alert('닉네임을 입력하세요'); 
    document.signUP_Form.nickname.focus();
    return;
  }
  document.signUP_Form.submit();
}