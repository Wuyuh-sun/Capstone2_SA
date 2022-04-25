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
    <link rel="stylesheet" href="../CSS/signUP.css">
    <title>Smoke Area Map</title>
</head>

<body>
    <!-- 로그인 아이콘 -->
    <div class="SA_HOME" id="SA_HOME">
        <div class="SA" id="SA">SA</div>
        <div class="smokearea" id="smokearea">Smoke Area</div>
    </div>

    <!-- 회원가입 창 -->
    <form action="signUp_insert.php" name="signUP_Form" class="signUP_Form" method="POST">
        <div class="form_in" id="signUPform">
            <div class="text1">SignUp</div>
            <input type="text" name="email" id="inputEmail" class="inputEmail" placeholder="이메일을 입력하세요" autocomplete="off" onchange="emailCheck()">

            <input type="text" name="pw" id="inputPW" class="inputPW" placeholder="PASSWORD를 입력하세요" autocomplete="off" maxlength="20"  onchange="pwCheck()">

            <input type="text" name="pw_check" id="inputPW_check" class="inputPW_check" placeholder="PASSWORD를 확인해주세요" autocomplete="off" maxlength="20" onchange="pwCheck_2()">

            <div class="text2">- 영문, 숫자, 특수문자를 섞어 6~20자 이내로 만드십시오</div>
            <div class="text3">- 공백은 사용할 수 없습니다.</div>

            <input type="text" name="nickname" id="inputNickName" class="inputNickName" placeholder="닉네임을 입력하세요" autocomplete="off" maxlength="20"  onchange="nickNameCheck()">

            <input type="button" class="adult_check" value="성인인증">
            <div class="text4">※성인인증을 완료해주세요</div>
            <a href="#" class="signUpBtn" onclick="check_input()">회원가입</a>
        </div>
    </form>

<script src="../JS/signUP.js"></script>
</body>

</html>