const windowBlack = document.getElementById("windowBlack");
// 좌측 메뉴 지정
const menuBtn = document.getElementById("menu");
const menuSidebar = document.getElementById("menu_sidebar");
const menuClose = document.getElementById("menu_closeBtn1");
// 우측 메뉴 지정
const chatBtn = document.getElementById("chat_closeBtn");
const friendSidebar = document.getElementById("friend_sidebar");
document.querySelector

// 좌측 메뉴 함수
function menuOpenClick() {
  menuSidebar.style.left = "0px";
  windowBlack.style.display = "block";
}
function menuCloseClick() {
  menuSidebar.style.left = "-310px";
  windowBlack.style.display = "none";
}
// 우측 메뉴 함수
function chatOpenClick() {
  if(chatBtn.style.right == "300px"){
    friendSidebar.style.right = "-300px";
    chatBtn.style.right = "0px";
  } else{
    friendSidebar.style.right = "0px";
    chatBtn.style.right = "300px";
  }
  // windowBlack.style.display = 'block';
}
function friend_chatOpenClick() {
  if(chatBtn.style.right == "300px"){
    friendSidebar.style.right = "-300px";
    chatBtn.style.right = "0px";
  } {
    friendSidebar.style.right = "0px";
    
    chatBtn.style.right = "300px";
  }
  // windowBlack.style.display = 'block';
}
// console.log(document.querySelectorAll('.chatting').forEach(function(i){
//   i.style.bottom='-100%';
//   console.log(i.style.bottom);
// }));


// 좌측 메뉴 이벤트
menuBtn.addEventListener("click", menuOpenClick);
menuClose.addEventListener("click", menuCloseClick);
windowBlack.addEventListener("click", menuCloseClick);
// 우측 메뉴 이벤트
chatBtn.addEventListener("click", chatOpenClick);

