<?
include("./db_connect.php");
session_start();

$data = array(
  'jsonDataArray'=>json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR)
);

$sql1 = "INSERT INTO chatlog(send_username, get_username, msg) 
VALUES (
  '{$_SESSION['usernickname']}',
  '{$data['jsonDataArray']['friendname']}',
  '{$data['jsonDataArray']['sendtext']}'
  )
";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "select * from chatlog where 
(send_username = '{$_SESSION['usernickname']}' and get_username = '{$data['jsonDataArray']['friendname']}') or 
(send_username = '{$data['jsonDataArray']['friendname']}' and get_username = '{$_SESSION['usernickname']}')
";
$result2 = mysqli_query($conn, $sql2);
$chattingLog = "";
while($row = mysqli_fetch_array($result2)){
  if($row['send_username'] == $_SESSION['usernickname']){
    $chattingLog = $chattingLog . "
    <li class='chat_user'>
      <div class='chatMsg'>
      {$row['msg']}
      </div>
    </li>
    ";
  } else if($row['send_username'] == $data['jsonDataArray']['friendname']){
    $sql3 = "select * from userinfo where nickname='{$data['jsonDataArray']['friendname']}'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $chattingLog = $chattingLog . "
    <li class='chat_friend'>
      <img src='../img/userprofile/{$row3['user_profileImg']}'>
      <div class='group'>
        <div class='friend_name'>{$data['jsonDataArray']['friendname']}</div>
        <div class='chatMsg'>
        {$row['msg']}
        </div>
      </div>
    </li>
    ";
  }
}
// echo $_SESSION['usernickname'];
// echo $data['friendname'];
echo $chattingLog;
// echo $data['friendname']['sendtext'];
?>