<?
include('./db_connect.php');
session_start();

$data = array(
  'nickname'=>mysqli_real_escape_string($conn, $_POST['nickname'])
);

// echo $data['nickname'];
$sql = "select * from userinfo where nickname='{$data['nickname']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// echo $row['nickname'];
if($row['nickname'] == null){
  // ini_set('display_errors', '0');
  $_SESSION["nicknameCheck"] = $data['nickname'];
  echo "
  <script>
    alert('사용 가능한 닉네임입니다.');
    location.href = 'signUp.php';
  </script>
  ";
} else {
  $_SESSION["nicknameCheck"] = "";
  echo "
  <script>
    alert('이미 사용중인 닉네임입니다.');
    location.href = 'signUp.php';
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
  <title>Document</title>
</head>
<body>
  <!-- <form action='signUp.php' method='POST'>
    <input type='hidden' name='nickname' value=''>
  </form> -->
</body>
</html>