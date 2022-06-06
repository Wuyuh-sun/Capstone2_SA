<?
include("./db_connect.php");
session_start();

// $data = array(
//   'friendname'=>json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR)
// );


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
  // const chatLayoutOpenBtn = document.getElementById('friend_list');
  // const chatLayout = document.getElementById('chatting');
  // const chatLayoutCloseBtn = document.getElementById('chatCloseBtn');
  // const chatLog = document.querySelector('.chatLog');
  

  // function chatSend(){
  //   if(window.event.keyCode == 13){
  //     fetch('chatdata_send.php',{
  //       method: 'POST',
  //       headers:{
  //               'Content-Type': 'application/json',
  //               },
  //       body:JSON.stringify({
  //         friendname: document.querySelector('.username').innerHTML,
  //         sendtext: document.querySelector('.chat_txt').value
  //       })
  //     }).then(function(e){
  //       e.text().then(function(a){
  //         document.querySelector('.chatLog').innerHTML = a;
  //         document.querySelector('.chat_txt').value = '';
  //         document.querySelector('.chatLog').scrollTop = document.querySelector('.chatLog').scrollHeight;
  //         console.log('{$row['friendname']}');
  //       })
  //     })
  //   }
  // }
  let interval;

  // function chatOpen(){
  //   chatLayout.style.bottom = '0';
  // }
  // function chatClose(){
  //   chatLayout.style.bottom = '-100%';
  //   console.log('채팅 종료');
  //   clearInterval(interval);
  // }
  // chatLayoutOpenBtn.addEventListener('click', chatOpen);
  // chatLayoutCloseBtn.addEventListener('click', chatClose);

  
  
  </script>
";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/chat.css">
  <title>Document</title>
</head>

<body>
  <?= $chatAppBackUp ?>

</body>

</html>