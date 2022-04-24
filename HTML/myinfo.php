<?
session_start();
if(isset($_SESSION["useremail"])){
  $useremail = $_SESSION["useremail"];
} else {
  $useremail = "";
}
if(isset($_SESSION["usernickname"])){
  $usernickname = $_SESSION["usernickname"];
} else {
  $usernickname = "";
}
if(isset($_SESSION["userpassword"])){
  $userpassword = $_SESSION["userpassword"];
} else {
  $userpassword = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/myinfo.css">
  <title>Document</title>
</head>

<body>
  <div class="windowBlack" id="windowBlack"></div>
  <!-- 헤더 -->
  <div class="header">
    <!-- 메뉴 -->
    <img src="../img/menu_black_24dp.svg" class="menu" id="menu">
    <!-- SA홈 아이콘 -->
    <a href="main.php">
      <div class="SA_HOME" id="SA_HOME">
        <div class="SA" id="SA">SA</div>
      </div>
    </a>
    <!-- 채팅 -->
    <img src="../img/sms_black_24dp.svg" class="chat" id="chat">
  </div>
  <!--좌측 사이드바 -->
  <div class="menu_sidebar" id="menu_sidebar">
    <div><a href="myinfo.php">내 정보</a></div>
    <div><a href="friendpage.php">친구</a></div>
    <div><a href="logout.php">로그아웃</a></div>
    <img src="../img/expand_circle_down_black_24dp.svg" class="menu_closeBtn1" id="menu_closeBtn1">
  </div>
  <!-- 우측 사이드바 -->
  <div class="friend_sidebar" id="friend_sidebar">
    <div class="friend_barTop">
      <img src="../img/expand_circle_down_black_24dp.svg" class="menu_closeBtn2" id="menu_closeBtn2">
      <div>친구 목록</div>
    </div>
  </div>
  <!-- 내 정보 -->
  <form action="myinfo_update.php" name="myinfo_update" method="POST">
    <img src="../img/user.png" alt="profile_image" class="profile_image">
    <input type="text" name="nickname" class="nicknameEdit" placeholder="변경할 닉네임을 입력해주세요" 
    value=<?=$usernickname?> 
    maxlength="20">
    <div class="id_pw_email_Form">
      <!-- 
      <label for="idEdit" class="idEdit_label">ID</label>
      <input type="text" name="idEdit" class="idEdit" placeholder="변경할 ID를 입력해주세요" value="root" maxlength="20"> -->
      <label for="emailEdit" class="emailEdit_label">e-mail</label>
      <input type="text" name="email" class="emailEdit" placeholder="변경할 이메일을 입력해주세요" 
      value=<?=$useremail?> 
      maxlength="20">
      <label for="pwEdit" class="pwEdit_label">PASSWORD</label>
      <input type="text" name="pw" class="pwEdit" placeholder="변경할 비밀번호를 입력해주세요" 
      value=<?=$userpassword?> 
      minlength="6" maxlength="20">
      <p>- 영문, 숫자, 특수문자를 섞어 6~20자 이내로 만드십시오.</p>
      <p>- 공백은 사용할 수 없습니다.</p>
      <input type="text" name="pw_check" class="pw_Reinput" placeholder="변경할 비밀번호를 재입력해주세요" minlength="6" maxlength="20">
    </div>
    <a href="#" class="editBtn" onclick="check_input()">변경하기</a>
  </form>


  <script src="../JS/menu.js"></script>
  <script src="../JS/myinfo.js"></script>

</body>

</html>