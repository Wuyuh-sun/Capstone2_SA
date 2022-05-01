function check_Num() {
  if (!document.numCheck_form.numCheck.value) {
    alert("인증번호를 입력하세요");
    document.numCheck_form.numCheck.focus();
    return;
  }
  document.numCheck_form.submit();
}
