function check_input(){
  if (!document.myinfo_update.nickname.value) { 
    alert("닉네임을 입력하세요"); 
    document.myinfo_update.nickname.focus();
    return;
  }
  if (!document.myinfo_update.email.value) { 
    alert("이메일을 입력하세요"); 
    document.myinfo_update.email.focus();
    return;
  }
  if (!document.myinfo_update.pw.value) { 
    alert("비밀번호를 입력하세요"); 
    document.myinfo_update.pw.focus();
    return;
  }
  if (document.myinfo_update.pw.value != document.myinfo_update.pw_check.value) { 
    alert("비밀번호 확인을 다시 입력하세요"); 
    document.myinfo_update.pw_check.focus();
    return;
  }
  document.myinfo_update.submit();
}