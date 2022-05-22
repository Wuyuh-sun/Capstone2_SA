<?
include("./db_connect.php");
session_start();

$data = array(
  'username' => mysqli_real_escape_string($conn, $_POST['userName']),
  'friendname' => mysqli_real_escape_string($conn, $_POST['friendname'])
);

// echo "수락 페이지";

$sql = "DELETE FROM friends
        WHERE username='{$data['username']}' AND friendname='{$data['friendname']}';
        DELETE FROM friends
        WHERE username='{$data['friendname']}' AND friendname='{$data['username']}';
        INSERT INTO friends(username, friendname, get, send, friend) 
        VALUES (
          '{$data['username']}', 
          '{$data['friendname']}',
          '',
          '',
          '1'
          );
        INSERT INTO friends(username, friendname, get, send, friend) 
        VALUES (
          '{$data['friendname']}', 
          '{$data['username']}',
          '',
          '',
          '1'
          );
          ";
$result = mysqli_multi_query($conn, $sql);

echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      // alert('삭제 성공하였습니다.');
      location.href = 'friendpage.php?friend_get';
    </script>");
?>