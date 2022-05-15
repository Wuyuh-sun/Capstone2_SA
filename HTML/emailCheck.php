<?
include('./db_connect.php');
session_start();

$data = array(
  'email'=>mysqli_real_escape_string($conn, $_POST['email'])
);

// echo $data['email'];
$sql = "select * from userinfo where email='{$data['email']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// echo $row['email'];
if($row['email'] == null){
  // ini_set('display_errors', '0');
  $_SESSION["emailCheck"] = $data['email'];
  echo "
  <script>
    alert('사용 가능한 이메일입니다.');
    location.href = 'signUp.php';
  </script>
  ";
} else {
  $_SESSION["emailCheck"] = "";
  echo "
  <script>
    alert('이미 가입한 이메일입니다.');
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
    <input type='hidden' name='email' value=''>
  </form> -->
</body>
</html>