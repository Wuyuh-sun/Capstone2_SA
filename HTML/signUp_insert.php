<?
include("./db_connect.php");

$data = array(
  'email'=>mysqli_real_escape_string($conn, $_POST['email']),
  'nickname'=>mysqli_real_escape_string($conn, $_POST['nickname']),
  'pw'=>mysqli_real_escape_string($conn, $_POST['pw'])
);

$sql = "INSERT INTO userinfo(email, password, nickname) 
VALUES (
  '{$data['email']}', 
  '{$data['pw']}',
  '{$data['nickname']}'
  )";

$result = mysqli_multi_query($conn, $sql);
if($result === false){
  $message = "<div class='text1'>회원가입을 실패했습니다</div>";
  error_log(mysqli_error($conn));
} else {
  $message = "<div class='text1'>회원가입을 성공했습니다!</div>";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/signUP_insert.css">
  <title>Smoke Area Map</title>
</head>

<body>
  <!-- 로그인 아이콘 -->
  <div class="SA_HOME" id="SA_HOME">
    <div class="SA" id="SA">SA</div>
    <div class="smokearea" id="smokearea">Smoke Area</div>
  </div>
  <div class="form">
    <?=$message?>
    <a href="index.php">Login</a>
  </div>
</body>

</html>