<?
  session_start();
  if(!$_SESSION["useremail"]){
    echo(" 
          <script> 
            window.alert('로그인 후 이용해주세요');
            location.href = 'index.php'; 
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
  <link rel="stylesheet" href="../../CSS/faq.css">
  <title>Document</title>
</head>

<body>
  <div class="windowBlack" id="windowBlack"></div>
  <!-- 헤더 -->
  <div class="header">
    <!-- 메뉴 -->
    <img src="../img/menu_black_24dp.svg" class="menu" id="menu">
    <!-- SA홈 아이콘 -->
    <a href="main.php">
      <div class="SA_HOME" id="SA_HOME">
        <div class="SA" id="SA">SA</div>
      </div>
    </a>
    <!-- 채팅 -->
    <img src="../img/sms_black_24dp.svg" class="chat" id="chat">
  </div>
  <!--좌측 사이드바 -->
  <div class="menu_sidebar" id="menu_sidebar">
    <div><a href="myinfo.php">내 정보</a></div>
    <div><a href="friendpage.php">친구</a></div>
    <div><a href="logout.php">로그아웃</a></div>
    <img src="../img/expand_circle_down_black_24dp.svg" class="menu_closeBtn1" id="menu_closeBtn1">
  </div>
  <!-- 우측 사이드바 -->
  <div class="friend_sidebar" id="friend_sidebar">
    <div class="friend_barTop">
      <img src="../img/expand_circle_down_black_24dp.svg" class="menu_closeBtn2" id="menu_closeBtn2">
      <div>친구 목록</div>
    </div>
  </div>

  <!-- 게시판 -->
  <!-- 게시판 메뉴 -->
  <div class="bbs_list" id="bbs_list">
    <ul class="bbs_list_placename1">
      <a href="#menu1"><li>인문사회관</li></a>
      <a href="#menu2"><li>종합교육관</li></a>
      <a href="#menu3"><li>중앙삼거리</li></a>
      <a href="#menu4"><li>종합체육관</li></a>
    </ul>
    <ul class="bbs_list_placename2">
      <a href="#menu5"><li>제1 공학관</li></a>
      <a href="#menu6"><li>제2 공학관</li></a>
      <a href="#menu7"><li>제3 공학관</li></a>
      <a href="#menu8"><li>제4 공학관</li></a>
    </ul>
    <ul class="bbs_list_placename3">
      <a href="#menu9"><li>조형관</li></a>
      <a href="#menu10"><li>웅비관</li></a>
      <a href="#menu11"><li>본관</li></a>
    </ul>
    <div class="bbs_menuBtn">MENU</div>
  </div>

  <!-- 게시판 본문 -->
  <div class="bbs_form">
    <h1 class="bbs_title">건의함 - 본관</h1>
    <a href="#1">
      <div class="bbs_notice">
        <img src="../img/bell.png"> 공지 필독
      </div>
    </a>
    <a href="#2">
      <div class="bbs_hot">
        <img src="../img/bell.png"> 자주 묻는 Q/A
      </div>
    </a>
    <a href="faq_write.php">
      <div class="bbs_write">글쓰기</div>
    </a>
    <ul class="bbs_article_list">
      <li>
        <div>
          <a href=""><h3>제목입니다</h3></a>
          <span>내용 미리보기 입니다.</span>
        </div>
        <div>
          <p>
            <span>00분 전</span>
            <span>홍길동</span>
          </p>
          <p>
            <img src="../img/사진.png" class="li_pic">0</img>
            <img src="../img/댓글.png" class="li_comm">00</img>
            <img src="../img/좋아요.png" class="li_good">00</img>
          </p>
        </div>
      </li>
      <li>
        <div>
          <a href=""><h3>제목입니다</h3></a>
          <span>내용 미리보기 입니다.</span>
        </div>
        <div>
          <p>
            <span>00분 전</span>
            <span>홍길동</span>
          </p>
          <p>
            <img src="../img/사진.png" class="li_pic">0</img>
            <img src="../img/댓글.png" class="li_comm">00</img>
            <img src="../img/좋아요.png" class="li_good">00</img>
          </p>
        </div>
      </li>
      <li>
        <div>
          <a href=""><h3>제목입니다</h3></a>
          <span>내용 미리보기 입니다.</span>
        </div>
        <div>
          <p>
            <span>00분 전</span>
            <span>홍길동</span>
          </p>
          <p>
            <img src="../img/사진.png" class="li_pic">0</img>
            <img src="../img/댓글.png" class="li_comm">00</img>
            <img src="../img/좋아요.png" class="li_good">00</img>
          </p>
        </div>
      </li>
      <li>
        <div>
          <a href=""><h3>제목입니다</h3></a>
          <span>내용 미리보기 입니다.</span>
        </div>
        <div>
          <p>
            <span>00분 전</span>
            <span>홍길동</span>
          </p>
          <p>
            <img src="../img/사진.png" class="li_pic">0</img>
            <img src="../img/댓글.png" class="li_comm">00</img>
            <img src="../img/좋아요.png" class="li_good">00</img>
          </p>
        </div>
      </li>
      <li>
        <div>
          <a href=""><h3>제목입니다</h3></a>
          <span>내용 미리보기 입니다.</span>
        </div>
        <div>
          <p>
            <span>00분 전</span>
            <span>홍길동</span>
          </p>
          <p>
            <img src="../img/사진.png" class="li_pic">0</img>
            <img src="../img/댓글.png" class="li_comm">00</img>
            <img src="../img/좋아요.png" class="li_good">00</img>
          </p>
        </div>
      </li>
      <li>
        <div>
          <a href=""><h3>제목입니다</h3></a>
          <span>내용 미리보기 입니다.</span>
        </div>
        <div>
          <p>
            <span>00분 전</span>
            <span>홍길동</span>
          </p>
          <p>
            <img src="../img/사진.png" class="li_pic">0</img>
            <img src="../img/댓글.png" class="li_comm">00</img>
            <img src="../img/좋아요.png" class="li_good">00</img>
          </p>
        </div>
      </li>
      <li>
        <div>
          <a href=""><h3>제목입니다</h3></a>
          <span>내용 미리보기 입니다.</span>
        </div>
        <div>
          <p>
            <span>00분 전</span>
            <span>홍길동</span>
          </p>
          <p>
            <img src="../img/사진.png" class="li_pic">0</img>
            <img src="../img/댓글.png" class="li_comm">00</img>
            <img src="../img/좋아요.png" class="li_good">00</img>
          </p>
        </div>
      </li>
    </ul>
  </div>

  </div>





  <script src="../JS/menu.js"></script>
  <script src="../JS/bbs.js"></script>

</body>

</html>