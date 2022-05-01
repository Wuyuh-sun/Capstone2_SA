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
echo "
      <script>
        console.log('{$_SESSION["findPW_checkNUM"]}')
      </script>
";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/findPW2.css">
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
    <form action="sendMail.php" name="sendMail_form" method="POST">
        <div class="findPWform" id="findPWform">
            <div>Find PASSWORD</div>
            <input type="text" name="email" size="33" class="inputEmail" placeholder="이메일을 입력하세요" autocomplete="off" disabled value=<?=$email_value?> >
            <a href="#" class="certNumberBtn" onclick="return false">인증번호를<br>전송했습니다</a>
        </div>
    </form>
    <form action="number_check.php" name="numCheck_form" method="POST">
        <input type="text" name="numCheck" size="33" class="inputCtNumber" placeholder="인증번호를 입력하세요" autocomplete="off">
        <a href="#" class="next_2" onclick="check_Num()">다음</a>
    </form>
        
    </form>

    <script src="../JS/pwNumCheck.js"></script>
</body>

</html>