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
    <div class="findPWform" id="findPWform">
    <form action="sendMail.php" name="sendMail_form" method="POST">
        
            <div>Find PASSWORD</div>
            <input type="text" name="email" size="33" class="inputEmail" placeholder="이메일을 입력하세요" autocomplete="off" onkeyup="if(window.event.keyCode==13){check_input()}">
            <a href="#" class="certNumberBtn" onclick="check_input()">인증번호 전송</a>
        
    </form>
    <form action="">
        <input type="text" size="33" class="inputCtNumber" placeholder="인증번호를 입력하세요" autocomplete="off" disabled>
        <a href="#" class="next_2" onclick="return false">다음</a>
    </form>
    </div>
    


    <script src="../JS/findpw.js"></script>
</body>

</html>