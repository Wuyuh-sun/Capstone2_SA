
function inputCheck(){
  if (!document.saInfo_create.lat.value) {
    alert("위도 데이터를 넣어주세요");
    document.saInfo_create.lat.focus();
    return;
  }
  if (!document.saInfo_create.lng.value) {
    alert("경도 데이터를 넣어주세요");
    document.saInfo_create.lng.focus();
    return;
  }
  if (!document.saInfo_create.addr.value) {
    alert("지번 주소 데이터를 넣어주세요");
    document.saInfo_create.addr.focus();
    return;
  }
  if (!document.saInfo_create.placename.value) {
    alert("장소 이름 데이터를 넣어주세요");
    document.saInfo_create.placename.focus();
    return;
  }
  document.saInfo_create.submit();
}