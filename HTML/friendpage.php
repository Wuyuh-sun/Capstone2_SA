<?
include("./db_connect.php");
session_start();
if (!$_SESSION["useremail"]) {
  echo (" 
          <script> 
            window.alert('로그인 후 이용해주세요');
            location.href = 'index.php'; 
          </script> 
        ");
}
if ($_SESSION["user_grade"] == "root") {
  include("./header_admin.php");
}
if ($_SESSION["user_grade"] == NULL) {
  include("./header.php");
}
// print_r($_SESSION);

// 친구 보내기 폼
$send_friend_form = "";
if (isset($_GET['friend_send'])) {
  $data = array(
    'friendname' => mysqli_real_escape_string($conn, $_POST['friend_name'])
  );
  $sql = "select * from userinfo where email='{$_SESSION["useremail"]}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $sql2 = "select * from userinfo where nickname='{$data['friendname']}'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  if ($row['user_profileImg'] == '') {
    $row['user_profileImg'] = 'user.png';
  }
  if ($row2['user_profileImg'] == '') {
    $row2['user_profileImg'] = 'user.png';
  }
  $send_friend_form = "
  <div class='sendForm' name='sendForm'>
  <div class='myinfo_text'>내 프로필</div>
  <ul class='sendForm_ul'>
    <li>
      <img src='../img/userprofile/{$row['user_profileImg']}' alt='프로필 사진'>
      <input type='text' value='{$_SESSION["usernickname"]}' readonly>
    </li>
  </ul>
  <form action='friendpage.php?friend_send' name='friend_send' method='POST'>
    <input type='text' name='friend_name' class='friend_name' id='friend_name' placeholder='친구 요청을 보낼 닉네임을 입력하세요' autocomplete='off' onkeyup='if(window.event.keyCode==13)' value='{$data['friendname']}'>
  </form>

  <div class='not_select' id='not_select'>대상을 찾을 수 없습니다.</div>
  <ul class='select_friendForm_ul' id='select_friendForm_ul'>
    <li>
      <img src='../img/userprofile/{$row2['user_profileImg']}' alt='프로필 사진'>
      <form action='friendSend.php' name='friendSend' method='POST'>
        <input type='hidden' name='username' value='{$_SESSION["usernickname"]}'>
        <input type='text' name='friendname' value='{$data['friendname']}' readonly>
        <button class='get_accept' onclick='send_friend()'>보내기</button>
      </form>
    </li>
  </ul>
  </div>
  <script>
    function send_friend(){
      document.friendSend.submit();
    }
    document.getElementById('btn_1').style.borderBottom = '3px solid steelblue';
  </script>
  ";
  if (isset($_POST['friend_name'])) {
    $sql = "select * from userinfo where nickname='{$_POST['friend_name']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    // print_r($row);
    if ($row == "") {
      $send_friend_form = $send_friend_form . "
      <script>
        document.getElementById('not_select').style.display = 'flex';
      </script>
    ";
    } else {
      $send_friend_form = $send_friend_form . "
      <script>
        const sendName = document.getElementById('friend_name');
        if (sendName.value == '{$_SESSION["usernickname"]}') { 
          // alert('본인 이외의 요청할 닉네임을 적으세요.'); 
          sendName.focus();
          document.getElementById('not_select').style.display = 'flex';
          document.getElementById('not_select').innerText = '본인 이외의 요청할 닉네임을 적으세요.';
        } else{
          document.getElementById('select_friendForm_ul').style.display = 'flex';
        }  
      </script>
    ";
    }
  }
}
// 친구 목록 폼
$list_friend_form = "";
if (isset($_GET['friend_list'])) {
  $sql = "select * from friends where username='{$_SESSION["usernickname"]}' and friend='1' order by friendname;";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result)) {
    $sql2 = "select * from userinfo where nickname='{$row['friendname']}'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    if ($row2['user_profileImg'] == '') {
      $row2['user_profileImg'] = 'user.png';
    }
    $friendName = $row['friendname'];
    $friendList_li = $friendList_li . "
    <li>
    <form 
      action='friend_Delete.php' 
      name='delete_{$row['friendname']}' 
      method='POST'
      >
        <img src='../img/userprofile/{$row2['user_profileImg']}' alt='프로필 사진'>
        <input type='hidden' name='userName' value='{$_SESSION["usernickname"]}' readonly>
        <input type='text' name='cancelName' value='{$row['friendname']}' readonly>
        <button type='button' class='send_message' onclick='ex_{$friendName}()'>채팅</button>
        <button type='button' class='get_delete' onclick='Delete_{$row['friendname']}()'>삭제</button>
      </form>
    </li>
    <script>
      function ex_{$friendName}(){
        friend_chatOpenClick();
        document.querySelectorAll('.chatting').forEach(function(i){
          i.style.bottom='-100%';
          console.log('이전 채팅 종료');
          clearInterval(interval);
        })
        userClick_{$friendName}();
        
      }

      function Delete_{$row['friendname']}(){
        document.delete_{$row['friendname']}.submit();
      }
    </script>
    ";
  }
  $list_friend_form = "
  <div class='friend_getForm'>
    <ul class='getForm_ul'>
      {$friendList_li}
    </ul>
  </div>
  <div class='guideScroll'></div>
      <script>
        document.getElementById('btn_2').style.borderBottom = '3px solid steelblue';
      </script>
  ";
}
// 받은 친구 폼
$get_friend_form = "";
if (isset($_GET['friend_get'])) {
  $sql = "select * from friends where username='{$_SESSION["usernickname"]}' and get='1' order by idx desc;";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result)) {
    $sql2 = "select * from userinfo where nickname='{$row['friendname']}'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    if ($row2['user_profileImg'] == '') {
      $row2['user_profileImg'] = 'user.png';
    }
    $getList_li = $getList_li . "
    <li>
      <img src='../img/userprofile/{$row2['user_profileImg']}' alt='프로필 사진'>
      <form 
      action='friendGet_accept.php' 
      name='friendGet_accept_{$row['friendname']}' 
      method='POST'
      >
        <input type='hidden' name='userName' value='{$_SESSION["usernickname"]}' readonly>
        <input type='text' name='friendname' value='{$row['friendname']}' readonly>
        <button class='get_accept' onclick='getAccept_{$row['friendname']}()'>수락</button>
        <button class='get_delete' onclick='return getCancel_{$row['friendname']}(this.form)'>삭제</button>
      </form>
    </li>
    <script>
      function getAccept_{$row['friendname']}(){
        document.friendGet_accept_{$row['friendname']}.submit();
      }
      function getCancel_{$row['friendname']}(frm){
        frm.action='friendGet_cancel.php';
        frm.submit();
      }
    </script>
    ";
  }
  $get_friend_form = "
  <div class='friend_getForm'>
    <ul class='getForm_ul'>
      {$getList_li}
    </ul>
  </div>
  <div class='guideScroll'></div>
      <script>
        document.getElementById('btn_3').style.borderBottom = '3px solid steelblue';
      </script>
  ";
}
// 보낸 친구 폼
$sendList_friend_form = "";
if (isset($_GET['friend_sendList'])) {
  $sql = "select * from friends where username='{$_SESSION["usernickname"]}' and send='1' order by idx desc;";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_array($result)) {
    $sql2 = "select * from userinfo where nickname='{$row['friendname']}'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    if ($row2['user_profileImg'] == '') {
      $row2['user_profileImg'] = 'user.png';
    }
    // print_r($row);
    $sendList_li = $sendList_li . "
    <li>
      <img src='../img/userprofile/{$row2['user_profileImg']}' alt='프로필 사진'>
      <form 
      action='friendSend_Cancel.php' 
      name='friendSend_CancelForm_{$row['friendname']}' 
      method='POST'
      >
        <input type='hidden' name='userName' value='{$_SESSION["usernickname"]}' readonly>
        <input type='text' name='cancelName' value='{$row['friendname']}' readonly>
        <button class='send_delete' onclick='sendCancel_{$row['friendname']}()'>취소</button>
      </form>
    </li>
    <script>
      function sendCancel_{$row['friendname']}(){
        document.friendSend_CancelForm_{$row['friendname']}.submit();
      }
    </script>
    ";
  }
  $sendList_friend_form = "
  <div class='friend_sendListForm'>
    <ul class='sendListForm_ul'>
      {$sendList_li}
    </ul>
  </div>
  <div class='guideScroll'></div>
      <script>
        document.getElementById('btn_4').style.borderBottom = '3px solid steelblue';
      </script>
  ";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/friendpage.css">
  <link rel="stylesheet" href="../CSS/header.css">
  <title>Document</title>
</head>

<body>
  <?= $header ?>
  <!-- 친구 관리 -->
  <div class='friendForm'>
    <ul class='mark_btn1'>
      <a href='?friend_send'>
        <li id='btn_1'>친구 보내기</li>
      </a>
      <a href='?friend_list'>
        <li id='btn_2'>친구 목록</li>
      </a>
    </ul>
    <ul class='mark_btn2'>
      <a href='?friend_get'>
        <li id='btn_3'>받은 친구 요청</li>
      </a>
      <a href='?friend_sendList'>
        <li id='btn_4'>보낸 친구 요청</li>
      </a>
    </ul>
  </div>
  

  <?= $send_friend_form ?>
  <?= $list_friend_form ?>
  <?= $get_friend_form ?>
  <?= $sendList_friend_form ?>

  <script src="../JS/menu.js"></script>
</body>

</html>