<?
session_start();

if($_SESSION["useremail"]){
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
    <form action="">
        <div class="findPWform" id="findPWform">
            <div>Find PASSWORD</div>
            <input type="text" size="33" class="inputNewPW" placeholder="새로운 비밀번호를 입력하세요">
            <input type="text" size="33" class="inputRePW" placeholder="비밀번호를 재입력하세요">
            <input type="button" class="next_3" value="다음">
        </div>
    </form>


</body>

</html>