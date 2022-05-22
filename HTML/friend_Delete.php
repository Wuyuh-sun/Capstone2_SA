<?
include("./db_connect.php");
session_start();

$data = array(
  'username' => mysqli_real_escape_string($conn, $_POST['userName']),
  'friendname' => mysqli_real_escape_string($conn, $_POST['cancelName'])
);

// print_r($data);
$sql = "DELETE FROM friends
        WHERE username='{$data['username']}' AND friendname='{$data['friendname']}';
        DELETE FROM friends
        WHERE username='{$data['friendname']}' AND friendname='{$data['username']}';
          ";
$result = mysqli_multi_query($conn, $sql);

echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      // alert('취소 성공하였습니다.');
      location.href = 'friendpage.php?friend_list';
    </script>");
?>