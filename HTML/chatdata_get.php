<?
include("./db_connect.php");
session_start();

$data = array(
  'friendname'=>json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR)
);
$sql = "select * from chatlog where 
(send_username = '{$_SESSION['usernickname']}' and get_username = '{$data['friendname']}') or 
(send_username = '{$data['friendname']}' and get_username = '{$_SESSION['usernickname']}')
";
$result = mysqli_query($conn, $sql);

$chattingLog.$data['friendnam'] = "";
while($row = mysqli_fetch_array($result)){

  if($row['send_username'] == $_SESSION['usernickname']){
    $chattingLog.$data['friendnam'] = $chattingLog.$data['friendnam'] . "
    <li class='chat_user'>
      <div class='chatMsg'>
      {$row['msg']}
      </div>
    </li>
    ";
  } else if($row['send_username'] == $data['friendname']){
    $sql2 = "select * from userinfo where nickname='{$data['friendname']}'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    if($row2['user_profileImg']==''){
      $row2['user_profileImg'] = 'user.png';
    }
    $chattingLog.$data['friendnam'] = $chattingLog.$data['friendnam'] . "
    <li class='chat_friend'>
      <img src='../img/userprofile/{$row2['user_profileImg']}'>
      <div class='group'>
        <div class='friend_name'>{$data['friendname']}</div>
        <div class='chatMsg'>
        {$row['msg']}
        </div>
      </div>
    </li>
    ";
  }
}

echo $chattingLog.$data['friendnam'];

// echo $_SESSION['usernickname'];
// echo $data['friendname'];
?>