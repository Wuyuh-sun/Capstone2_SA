function profileUpdate(){
  document.getElementById('windowBlack2').style.display='block';
  document.getElementById('imgClickForm').style.display='flex';
}
function profileUpdate_cancel(){
  document.getElementById('windowBlack2').style.display='none';
  document.getElementById('imgClickForm').style.display='none';
}

function profileImgFileSubmit(){
  document.myinfo_update.submit();
}

function profileUpdate_delete(frm){
  frm.action='profileDelete.php';
  frm.submit();
}