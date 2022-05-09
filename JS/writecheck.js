const title = document.getElementById("write_title");
const desc = document.getElementById("write_desc");

function writeCheck_input(){
  if (!title.value) { 
    alert("제목을 입력해주세요"); 
    title.focus(); 
    return;
  }
  if (!desc.value) { 
    alert("내용을 입력해주세요"); 
    desc.focus(); 
    return;
  }
  document.bbs_form.submit();
}