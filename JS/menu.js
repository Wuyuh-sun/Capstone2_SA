const windowBlack = document.getElementById("windowBlack");
// 좌측 메뉴 지정
const menuBtn = document.getElementById("menu");
const menuSidebar = document.getElementById("menu_sidebar");
const menuClose = document.getElementById("menu_closeBtn1");
// 우측 메뉴 지정
const chatBtn = document.getElementById("chat");
const friendSidebar = document.getElementById("friend_sidebar");
const friendClose = document.getElementById("menu_closeBtn2")

// 좌측 메뉴 함수
function menuOpenClick(){
  menuSidebar.style.left = "0px";
  windowBlack.style.display = "block";
}
function menuCloseClick(){
  menuSidebar.style.left = "-300px";
  windowBlack.style.display = "none";
}
// 우측 메뉴 함수
function chatOpenClick(){
  friendSidebar.style.right = "0px";
  windowBlack.style.display = "block";
}
function chatCloseClick(){
  friendSidebar.style.right = "-300px";
  windowBlack.style.display = "none";
}
// 좌측 메뉴 이벤트
menuBtn.addEventListener("click", menuOpenClick);
menuClose.addEventListener("click", menuCloseClick);
// 우측 메뉴 이벤트
chatBtn.addEventListener("click", chatOpenClick);
friendClose.addEventListener("click", chatCloseClick);