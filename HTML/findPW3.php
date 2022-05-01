<?
session_start();

if(isset($_SESSION["useremail"])){
  echo(" 
        <script> 
            window.alert('이미 로그인 되어 있습니다');
            location.href = 'main.php'; 
        </script> 
      ");
}
if(isset($_SESSION["findPW_email"])){
    $email_value = $_SESSION["findPW_email"];
  } else{
    echo(" 
          <script> 
              window.alert('접근 권한이 없습니다.');
              history.go(-1);
          </script> 
        ");
    $email_value = "";
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/findPW3.css">
    <title>Smoke Area Map</title>
</head>

<body>
    <!-- 로그인 아이콘 -->
    <div class="SA_HOME" id="SA_HOME">
        <div class="SA" id="SA">SA</div>
        <div class="smokearea" id="smokearea">Smoke Area</div>
    </div>
    <div class="graywindow"></div>
    <!-- 로그인 창 -->
    <form action="findPW_update.php" name="findPW_update_form" method="POST">
        <div class="findPWform" id="findPWform">
            <div>Find PASSWORD</div>
            <input type="text" name="newPW" size="33" id="inputNewPW" class="inputNewPW" placeholder="새로운 비밀번호를 입력하세요" onchange="newPwCheck()">
            <input type="text" name="newPW_check" size="33" id="inputRePW" class="inputRePW" placeholder="비밀번호를 재입력하세요" onchange="newPwCheck2()">
            <a href="#" class="next_3" onclick="check_input()">다음</a>
        </div>
    </form>


    <script src="../JS/findPW3_check.js"></script>
</body>

</html>