<?
include("./db_connect.php");
session_start();

$sql = "select * from friends where username='{$_SESSION['usernickname']}' and friend='1' order by friendname;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
  $sql2 = "select * from userinfo where nickname='{$row['friendname']}'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  $friendName = $row['friendname'];
  $friendList = $friendList . "
    <li onclick='userClick_{$friendName}()' class='friend_li{$friendName}'>
      <img src='../img/userprofile/{$row2['user_profileImg']}' alt='프로필 사진'>
      <div class='username {$friendName}'>{$friendName}</div>
    </li>
    <script>
      // function userClick_{$friendName}(){
      //   fetch('chatdata_get.php',{
      //     method: 'POST',
      //     headers:{
      //             'Content-Type': 'application/json',
      //             },
      //     body:JSON.stringify(document.getElementById('text1').value)
      //   }).then(function(e){
      //     e.text().then(function(a){
            
      //     })
      //   })
      // }
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
  <!-- 채팅 레이아웃 -->
  <div class='chatting' id='chatting'>
    <div class='chatCloseBtn' id='chatCloseBtn'>
      <img src='../img/downArrow.png'>
    </div>
    <ul class='chatLog'>

      <li class='chat_user'>
        <div class='chatMsg'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum atque accusantium odit vitae excepturi, nihil pariatur dicta odio aspernatur animi perspiciatis quia molestiae numquam, quidem libero cum ex fuga possimus.
        Neque est doloribus alias cumque rem perferendis animi adipisci molestias ad deserunt blanditiis pariatur fugiat quod nisi ipsam, autem possimus omnis? A quas quam dolorum quia voluptatem iure nostrum facilis.
        </div>
      </li>
      <li class='chat_friend'>
        <img src='../img/user.png'>
        <div class='group'>
          <div class='friend_name'>name</div>
          <div class='chatMsg'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum atque accusantium odit vitae excepturi, nihil pariatur dicta odio aspernatur animi perspiciatis quia molestiae numquam, quidem libero cum ex fuga possimus.
          Neque est doloribus alias cumque rem perferendis animi adipisci molestias ad deserunt blanditiis pariatur fugiat quod nisi ipsam, autem possimus omnis? A quas quam dolorum quia voluptatem iure nostrum facilis.</div>
        </div>
      </li>
      <li class='chat_user'>
        <div class='chatMsg'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum atque accusantium odit vitae excepturi, nihil pariatur dicta odio aspernatur animi perspiciatis quia molestiae numquam, quidem libero cum ex fuga possimus.
        Neque est doloribus alias cumque rem perferendis animi adipisci molestias ad deserunt blanditiis pariatur fugiat quod nisi ipsam, autem possimus omnis? A quas quam dolorum quia voluptatem iure nostrum facilis.
        </div>
      </li>
      <li class='chat_friend'>
        <img src='../img/user.png'>
        <div class='group'>
          <div class='friend_name'>name</div>
          <div class='chatMsg'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum atque accusantium odit vitae excepturi, nihil pariatur dicta odio aspernatur animi perspiciatis quia molestiae numquam, quidem libero cum ex fuga possimus.
          Neque est doloribus alias cumque rem perferendis animi adipisci molestias ad deserunt blanditiis pariatur fugiat quod nisi ipsam, autem possimus omnis? A quas quam dolorum quia voluptatem iure nostrum facilis.</div>
        </div>
      </li>
    </ul>
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

  <script>
    // const friendSidebar = document.getElementById("friend_sidebar");
    // const friendClose = document.getElementById("menu_closeBtn2");

    // function chatCloseClick() {
    //   friendSidebar.style.right = "-310px";
    //   console.log("1");
    //   // windowBlack.style.display = 'none';
    // }
    // friendClose.addEventListener("click", chatCloseClick);
  </script>
</body>

</html>