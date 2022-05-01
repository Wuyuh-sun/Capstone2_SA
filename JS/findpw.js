function check_input(){
  if (!document.sendMail_form.email.value) { 
    alert("이메일을 입력하세요"); 
    document.sendMail_form.email.focus();
    return;
  }
  document.sendMail_form.submit();
}