<?
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/main.css">
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
  <!-- 지도 -->
  <div id="map"></div>

  <script src="../JS/menu.js"></script>
  <script type="text/javascript" src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=09f865a4c6589413cc8f263a0f217a30">
  </script>
  <script src="../JS/map.js"></script>
</body>

</html>