<?
include("./db_connect.php");
session_start();

$sql = "select * from friends where username='{$_SESSION['usernickname']}' and friend='1' order by friendname;";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
  $sql2 = "select * from userinfo where nickname='{$row['friendname']}'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  if($row2['user_profileImg']==''){
    $row2['user_profileImg'] = 'user.png';
  }
  $friendName = $row['friendname'];
  $friendList = $friendList . "
    <li onclick='userClick_{$friendName}()' class='friend_li{$friendName}'>
      <img src='../img/userprofile/{$row2['user_profileImg']}' alt='프로필 사진'>
      <div class='username username{$friendName}'>{$friendName}</div>
    </li>
    <!-- 채팅 레이아웃 -->
    <div class='chatting' id='chatting_{$friendName}'>
      <div class='chatCloseBtn' id='chatCloseBtn_{$friendName}' onclick='chatClose_{$friendName}()'>
        <img src='../img/downArrow.png'>
      </div>
      <ul class='chatLog' id='chatLog_{$friendName}'>
      </ul>
      <div class='chatLog_down' id='chatLog_down_{$friendName}'><img src='../img/expand_circle_down_black_24dp.svg'></div>
      <input type='text' class='chat_txt' id='chat_txt_{$friendName}' placeholder='Aa' onkeyup='chatSend_{$friendName}()'>
    </div>

    <script>
      const chatLog_{$friendName} = document.getElementById('chatLog_{$friendName}');
      const chatLog_down_{$friendName} = document.querySelector('#chatLog_down_{$friendName}');

      function userClick_{$friendName}(){
        fetch('chatdata_get.php',{
          method: 'POST',
          headers:{
                  'Content-Type': 'application/json',
                  },
          body:JSON.stringify('{$friendName}')
        }).then(function(e){
          e.text().then(function({$friendName}){
            chatLog_{$friendName}.innerHTML = {$friendName};
            chatLog_{$friendName}.scrollTop = chatLog_{$friendName}.scrollHeight;
          })
        })
        interval = setInterval(()=>{
          if(chatLog_{$friendName}.scrollTop+chatLog_{$friendName}.clientHeight == chatLog_{$friendName}.scrollHeight){
            fetch('chatdata_get.php',{
              method: 'POST',
              headers:{
                      'Content-Type': 'application/json',
                      },
              body:JSON.stringify('{$friendName}')
            }).then(function(e){
              e.text().then(function({$friendName}){
                chatLog_{$friendName}.innerHTML = {$friendName};
                chatLog_{$friendName}.scrollTop = chatLog_{$friendName}.scrollHeight;
              })
            })
            chatLog_down_{$friendName}.style.display = 'none';
          } else {
            console.log('위에 보는중');
            chatLog_down_{$friendName}.style.display = 'block';
            function downClick(){
              chatLog_{$friendName}.scrollTop = chatLog_{$friendName}.scrollHeight;
            }
            chatLog_down_{$friendName}.addEventListener('click', downClick);
          }
        },1000);
        document.getElementById('chatting_{$friendName}').style.bottom = '0';
      }

      function chatClose_{$friendName}(){
        document.getElementById('chatting_{$friendName}').style.bottom = '-100%';
        console.log('채팅 종료');
        clearInterval(interval);
      }

      function chatSend_{$friendName}(){
        if(window.event.keyCode == 13){
          fetch('chatdata_send.php',{
            method: 'POST',
            headers:{
                    'Content-Type': 'application/json',
                    },
            body:JSON.stringify({
              friendname: document.querySelector('.username{$friendName}').innerHTML,
              sendtext: document.querySelector('#chat_txt_{$friendName}').value
            })
          }).then(function(e){
            e.text().then(function(a){
              document.querySelector('.chatLog').innerHTML = a;
              document.querySelector('#chat_txt_{$friendName}').value = '';
              document.querySelector('.chatLog').scrollTop = document.querySelector('.chatLog').scrollHeight;
              console.log(document.querySelector('.username{$friendName}').innerHTML);
            })
          })
        }
      }
    </script>
    
  ";
}
$chatAppBackUp = "
  <div class='friend_sidebar' id='friend_sidebar'>
    <div class='friend_barTop'>
      <div>친구 목록</div>
    </div>
    <ul class='friend_list' id='friend_list'>
        {$friendList}
    </ul>
  </div>
  
  <script>
    let interval;
  </script>
";

$user_sql = "select * from userinfo where nickname='{$_SESSION['usernickname']}'";
$user_result = mysqli_query($conn, $user_sql);
$user_row =  mysqli_fetch_array($user_result);
if($user_row['user_profileImg']==''){
  $user_row['user_profileImg'] = 'user.png';
}
if($user_row['user_grade']==''){
  $user_row['user_grade'] = 'Client';
}
$header = "
  <link rel='stylesheet' href='../CSS/chat.css'>
  <div class='windowBlack' id='windowBlack'></div>
  <!-- 헤더 -->
  <div class='header'>
    <!-- 메뉴 -->
    <img src='../img/menu_black_24dp.svg' class='menu' id='menu'>
    <!-- SA홈 아이콘 -->
    <a href='main.php'>
        <div class='home_text'>
          <div class='SA_HOME' id='SA_HOME'>
            <!--<div class='SA' id='SA'>SA</div>-->
          </div>
          <span>S</span>
          <span class='span2'>moke</span>
          <span>A</span>
          <span class='span4'>rea</span>
        </div>
      </a>
      <div class='white1'></div>
      <div class='white2'></div>
    <!-- 채팅 -->
    <img src='../img/sms_black_24dp.svg' class='chat_closeBtn' id='chat_closeBtn'>
  </div>
  <!--좌측 사이드바 -->
  <div class='menu_sidebar' id='menu_sidebar'>
    <div class='flip-card'>
      <div class='flip-card-inner'>
        <div class='flip-card-front'>
          <img src='../img/userprofile/{$user_row['user_profileImg']}'>
          <div class='userNickname'>{$_SESSION['usernickname']}</div>
        </div>
        <div class='flip-card-back'>
          <h1>User Grade</h1>
          <p>{$user_row['user_grade']}</p>
        </div>
      </div>
    </div>

    <div><a href='myinfo.php'>내 정보</a></div>
    <div><a href='friendpage.php?friend_send'>친구</a></div>
    <div><a href='logout.php' class='logoutBtn'>로그아웃</a></div>
    <img src='../img/expand_circle_down_black_24dp.svg' class='menu_closeBtn1' id='menu_closeBtn1'>
  </div>
  <!-- 우측 사이드바 -->
  {$chatAppBackUp}

  <script>
    function myinfo(){
      // location.href = '/HTML/myinfo.php';
    }
  </script>
";


?>