

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css">
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
    <form action="login.php" name="login_form" method="POST">
        <div class="loginform" id="loginform">
            <!-- 로그인 상단 -->
            <div class="login_top" id="login_top">
                <div>Login</div>
                <input type="text" size="33" class="loginEmail" name="email" placeholder="EMAIL을 입력하세요" autocomplete="off">
                <input type="text" size="33" class="loginPW" name="pw" placeholder="PASSWORD를 입력하세요" autocomplete="off">
                <!-- 로그인 중간 -->
                <div class="login_center" id="login_center">
                    <input type="checkbox" class="IDSAVE">
                    <div>Email 저장</div>
                    <a href="#" class="loginBtn" onclick="check_input()">로그인</a>
                </div>
            </div>
            <!-- 로그인 하단 -->
            <div class="login_bottom" id="login_bottom">
                <div><a href="./findPW2.html">비밀번호 찾기</a></div>
                <div><a href="./signUp.php">회원가입</a></div>
            </div>
        </div>
    </form>

    <script src="../JS/loginStyle.js"></script>
    <script src="../JS/login.js"></script>
</body>

</html>