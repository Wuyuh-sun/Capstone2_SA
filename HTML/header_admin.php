<?
include("./db_connect.php");
session_start();

$sql = "select * from friends where username='{$_SESSION['usernickname']}' and friend='1' order by friendname;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
  $sql2 = "select * from userinfo where nickname='{$row['friendname']}'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);

  $friendList = $friendList . "
    <li onclick='userClick_{$row['friendname']}()'>
      <img src='../img/userprofile/{$row2['user_profileImg']}' alt='프로필 사진'>
      <div class='username {$row['friendname']}'>{$row['friendname']}</div>
      <div class='newChat_count'>10+</div>
    </li>
    <script>
      function userClick_{$row['friendname']}(){
        document.getElementById('user1').value = '{$_SESSION['usernickname']}';
        document.getElementById('user2').value = document.querySelector('.{$row['friendname']}').innerText;
      }
    </script>
  ";
}
$chatAppBackUp = "
  <div class='friend_sidebar' id='friend_sidebar'>
  <div class='friend_barTop'>
    <img src='../img/expand_circle_down_black_24dp.svg' class='menu_closeBtn2' id='menu_closeBtn2'>
    <div>친구 목록</div>
  </div>
  <ul class='friend_list' id='friend_list'>
      {$friendList}
  </ul>
  </div>
  <!-- 채팅 레이아웃 -->
  <div class='chatting' id='chatting'>
  <div class='chatCloseBtn' id='chatCloseBtn'>
    <img src='../img/downArrow.png'>
  </div>

  <input type='text' class='chat_txt' placeholder='Aa'>
  </div>

  <script>
  const chatLayoutOpenBtn = document.getElementById('friend_list');
  const chatLayout = document.getElementById('chatting');
  const chatLayoutCloseBtn = document.getElementById('chatCloseBtn');
  function chatOpen(){
    chatLayout.style.bottom = '0';
  }
  function chatClose(){
    chatLayout.style.bottom = '-100%';
  }
  chatLayoutOpenBtn.addEventListener('click', chatOpen);
  chatLayoutCloseBtn.addEventListener('click', chatClose);
  </script>
";


$header = "
  <div class='windowBlack' id='windowBlack'></div>
  <!-- 헤더 -->
  <div class='header'>
    <!-- 메뉴 -->
    <img src='../img/menu_black_24dp.svg' class='menu' id='menu'>
    <!-- SA홈 아이콘 -->
    <a href='main.php'>
      <div class='SA_HOME' id='SA_HOME'>
        <div class='SA' id='SA'>SA</div>
      </div>
    </a>
    <!-- 채팅 -->
    <img src='../img/sms_black_24dp.svg' class='chat_closeBtn' id='chat_closeBtn'>
  </div>
  <!--좌측 사이드바 -->
  <div class='menu_sidebar' id='menu_sidebar'>
    <div><a href='myinfo.php'>내 정보</a></div>
    <div><a href='friendpage.php?friend_send'>친구</a></div>
    <div><a href='map_manager.php?create'>지도 관리</a></div>
    <div><a href='logout.php'>로그아웃</a></div>
    <img src='../img/expand_circle_down_black_24dp.svg' class='menu_closeBtn1' id='menu_closeBtn1'>
  </div>
  <!-- 우측 사이드바 -->
  
  
  <iframe src='http://localhost/HTML/chatApp.php' id='friend_sidebar'></iframe>
";


?>