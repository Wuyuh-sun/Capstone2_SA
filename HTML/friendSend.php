<?
include("./db_connect.php");
session_start();

$data = array(
  'username' => mysqli_real_escape_string($conn, $_POST['username']),
  'friendname' => mysqli_real_escape_string($conn, $_POST['friendname'])
);

// print_r($data);

$sql = "select * from friends where username='{$data['username']}' and friendname='{$data['friendname']}';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
print_r($row);
if($row['send'] == 1){
  echo "
  <script>
    alert('이미 요청을 보냈습니다.');
    location.href = 'friendpage.php?friend_send';
  </script>
  ";
} else if($row['friend'] == 1){
  echo "
  <script>
    alert('이미 등록된 친구입니다.');
    location.href = 'friendpage.php?friend_send';
  </script>
  ";
} else if($row['get'] == 1){
  echo "
  <script>
    alert('이미 요청받은 친구입니다.\\n요청을 수락해주세요.');
    // alert('요청을 수락해주세요.');
    location.href = 'friendpage.php?friend_get';
  </script>
  ";
}  else{
  $sql = "INSERT INTO friends(username, friendname, get, send, friend) 
          VALUES (
            '{$data['username']}', 
            '{$data['friendname']}',
            '',
            '1',
            ''
            );
          INSERT INTO friends(username, friendname, get, send, friend) 
          VALUES (
            '{$data['friendname']}', 
            '{$data['username']}',
            '1',
            '',
            ''
            );
          ";
  $result = mysqli_multi_query($conn, $sql);
  echo "
  <script>
    alert('요청을 성공적으로 보냈습니다.');
    location.href = 'friendpage.php?friend_send';
  </script>
  ";
}


?>
