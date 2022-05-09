<?
  include("./db_connect.php");
  session_start();

  $email_value = $_SESSION["findPW_email"];
  $data = array(
    'pw'=>mysqli_real_escape_string($conn, $_POST['newPW'])
  );

  $sql = "UPDATE userinfo 
                SET 
                  password = '{$data['pw']}'
                WHERE
                  email ='{$email_value}'
          ";
  $result = mysqli_query($conn, $sql);

  if($result == false){
    echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('변경에 실패했습니다');
      history.go(-1);
    </script>");
  } else{
    $message = "<div class='text1' style='font-size:1.1em'>비밀번호 변경을 <br> 성공했습니다!</div>";
    unset($_SESSION["findPW_email"]);
    unset($_SESSION["findPW_checkNUM"]);
  }


// echo "hi";
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