function check_input(){
  if (!document.login_form.email.value) { 
    alert("이메일을 입력하세요"); 
    document.login_form.email.focus();
    return;
  }
  if (!document.login_form.pw.value) { 
    alert("비밀번호를 입력하세요"); 
    document.login_form.pw.focus();
    return;
  }
  document.login_form.submit();
}