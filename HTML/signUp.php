<?
include('./db_connect.php');
session_start();


if (isset($_SESSION['useremail'])) {
    echo ("
        <script> 
            window.alert('이미 로그인 되어 있습니다');
            location.href = 'main.php'; 
        </script> 
      ");
}
// if(header("Refresh:0")){
//     unset($_SESSION["emailCheck"]);
//     unset($_SESSION["nicknameCheck"]);
// }

$signUpForm = "
<div class='signUP_Form'>
    <div class='form_in' id='signUPform'>
        <div class='text1'>SignUp</div>

        <form action='emailCheck.php' name='emailCheck_Form' method='POST'>
            <input type='email' name='email' id='inputEmail' class='inputEmail' placeholder='이메일을 입력하세요' autocomplete='off' onkeyup='emailCheck()' value='{$_SESSION["emailCheck"]}'>
            <a href='#' class='emailCheckBtn' onclick='check_email()'>중복 확인</a>
        </form>
        <script>
            const email = document.getElementById('inputEmail');
            if(email.value == ''){
                email.style.backgroundImage='url(../img/x_red.png)';
            } else if(email.value == '{$_SESSION["emailCheck"]}'){
                email.style.backgroundImage='url(../img/check_red.png)';
            }
            function emailCheck(){
                if(email.value ==''){
                    email.style.backgroundImage='url(../img/x_red.png)';
                } else if(email.value != '{$_SESSION["emailCheck"]}'){
                    email.style.backgroundImage='url(../img/x_red.png)';
                } else if(email.value == '{$_SESSION["emailCheck"]}'){
                    email.style.backgroundImage='url(../img/check_red.png)';
                }
              }
            function check_email(){
                if (!document.emailCheck_Form.email.value) { 
                alert('이메일을 입력하세요'); 
                document.emailCheck_Form.email.focus();
                return;
                }
                document.emailCheck_Form.submit();
            }
        </script>

        <form action='nicknameCheck.php' name='nicknameCheck_Form' method='POST'>
            <input type='text' name='nickname' id='inputNickName' class='inputNickName' placeholder='닉네임을 입력하세요' autocomplete='off' maxlength='20' onkeyup='nickNameCheck()' value='{$_SESSION["nicknameCheck"]}'>
            <a href='#' class='nicknameCheckBtn' onclick='check_nickname()'>중복 확인</a>
        </form>
        <script>
            const nickname = document.getElementById('inputNickName');
            if(nickname.value == ''){
                nickname.style.backgroundImage='url(../img/x_red.png)';
            } else if(nickname.value == '{$_SESSION["nicknameCheck"]}'){
                nickname.style.backgroundImage='url(../img/check_red.png)';
            }
            function nickNameCheck(){
                if(nickname.value ==''){
                    nickname.style.backgroundImage='url(../img/x_red.png)';
                } else if(nickname.value != '{$_SESSION["nicknameCheck"]}'){
                    nickname.style.backgroundImage='url(../img/x_red.png)';
                } else if(nickname.value == '{$_SESSION["nicknameCheck"]}'){
                    nickname.style.backgroundImage='url(../img/check_red.png)';
                }
            }
            function check_nickname(){
                if (!document.nicknameCheck_Form.nickname.value) { 
                alert('닉네임을 입력하세요'); 
                document.nicknameCheck_Form.nickname.focus();
                return;
                }
                document.nicknameCheck_Form.submit();
            }
         </script>

        <form action='signUp_insert.php' name='signUP_Form' method='POST'>
            <input type='hidden' name='email' value='{$_SESSION["emailCheck"]}'>
            <input type='hidden' name='nickname' value='{$_SESSION["nicknameCheck"]}'>

            <input type='password' name='pw' id='inputPW' class='inputPW' placeholder='PASSWORD를 입력하세요' autocomplete='off' maxlength='20' onkeyup='pwCheck()'>

            <input type='password' name='pw_check' id='inputPW_check' class='inputPW_check' placeholder='PASSWORD를 확인해주세요' autocomplete='off' maxlength='20' onkeyup='pwCheck_2()'>

            <div class='text2'>- 영문, 숫자, 특수문자를 섞어 6~20자 이내로 만드십시오</div>
            <div class='text3'>- 공백은 사용할 수 없습니다.</div>

            <a href='#' class='signUpBtn' onclick='check_input()'>회원가입</a>
        </form>
        <script>
            const pw1 = document.getElementById('inputPW');
            const pw2 = document.getElementById('inputPW_check');

            function pwCheck(){
                if(pw1.value !=''){
                    pw1.style.backgroundImage='url(../img/check_red.png)';
                } else{
                    pw1.style.backgroundImage='url(../img/x_red.png)';
                }
                if(pw1.value.length < 6){
                    pw1.style.backgroundImage='url(../img/x_red.png)';
                }
              }
              function pwCheck_2(){
                if(pw1.value == pw2.value){
                  pw2.style.backgroundImage='url(../img/check_red.png)';
                }
                else{
                  pw2.style.backgroundImage='url(../img/x_red.png)';
                }
              }

            function check_input(){
                if (!document.emailCheck_Form.email.value) { 
                  alert('이메일을 입력하세요'); 
                  document.emailCheck_Form.email.focus();
                  return;
                } else if(document.emailCheck_Form.email.value != '{$_SESSION["emailCheck"]}'){
                    alert('이메일을 중복 확인을 해주세요'); 
                    document.emailCheck_Form.email.focus();
                    return;
                }
                if (!document.nicknameCheck_Form.nickname.value) { 
                    alert('닉네임을 입력하세요'); 
                    document.nicknameCheck_Form.nickname.focus();
                    return;
                  } else if(document.nicknameCheck_Form.nickname.value != '{$_SESSION["nicknameCheck"]}'){
                    alert('닉네임 중복 확인을 해주세요'); 
                    document.nicknameCheck_Form.nickname.focus();
                    return;
                }
                if (!document.signUP_Form.pw.value) { 
                  alert('비밀번호를 입력하세요'); 
                  document.signUP_Form.pw.focus();
                  return;
                }
                if (document.signUP_Form.pw.value.length < 6 || document.signUP_Form.pw.value.length > 20) { 
                    alert('비밀번호를 6자 이상 20자 이하로 해주세요'); 
                    document.signUP_Form.pw.focus();
                    return;
                  }
                if (!document.signUP_Form.pw_check.value) { 
                  alert('비밀번호 확인을 입력하세요'); 
                  document.signUP_Form.pw_check.focus();
                  return;
                } else if(pw1.value != pw2.value){
                    alert('비밀번호를 확인하세요'); 
                    document.signUP_Form.pw_check.focus();
                    return;
                }
                document.signUP_Form.submit();
              }
        </script>
    </div>
</div>

";





?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../CSS/signUP.css'>
    <title>Smoke Area Map</title>
</head>

<body>
    <!-- 로그인 아이콘 -->
    <div class='SA_HOME' id='SA_HOME'>
        <div class='SA' id='SA'>SA</div>
        <div class='smokearea' id='smokearea'>Smoke Area</div>
    </div>

    <!-- 회원가입 창 -->
    <?= $signUpForm ?>

    <!-- <script src="../JS/signUP.js"></script> -->
</body>

</html>