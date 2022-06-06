<?
session_start();
if(!$_SESSION['useremail']){
  echo(" 
        <script> 
          window.alert('로그인 후 이용해주세요');
          location.href = 'index.php'; 
        </script> 
      ");
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel='stylesheet' href='../../CSS/bbs.css'>
  <link rel='stylesheet' href='../../CSS/bbs_write.css'>
  <link rel='stylesheet' href='../../CSS/bbs_read.css'>
  <title>Document</title>
</head>

<body>
  <div class='windowBlack' id='windowBlack'></div>
  <!-- 헤더 -->
  <div class='header'>
    <!-- 메뉴 -->
    <img src='../../img/menu_black_24dp.svg' class='menu' id='menu'>
    <!-- SA홈 아이콘 -->
    <a href='../main.php'>
      <div class='SA_HOME' id='SA_HOME'>
        <div class='SA' id='SA'>SA</div>
      </div>
    </a>
    <!-- 채팅 -->
    <img src='../../img/sms_black_24dp.svg' class='chat' id='chat'>
  </div>
  <!--좌측 사이드바 -->
  <div class='menu_sidebar' id='menu_sidebar'>
    <div><a href='../myinfo.php'>내 정보</a></div>
    <div><a href='../friendpage.php'>친구</a></div>
    <div><a href='../logout.php'>로그아웃</a></div>
    <img src='../../img/expand_circle_down_black_24dp.svg' class='menu_closeBtn1' id='menu_closeBtn1'>
  </div>
  <!-- 우측 사이드바 -->
  <div class='friend_sidebar' id='friend_sidebar'>
    <div class='friend_barTop'>
      <img src='../../img/expand_circle_down_black_24dp.svg' class='menu_closeBtn2' id='menu_closeBtn2'>
      <div>친구 목록</div>
    </div>
  </div>

  <!-- 게시판 -->
  <!-- 게시판 메뉴 -->
  <div class='bbs_list' id='bbs_list'>
    <ul class='bbs_list_placename1'>
      <a href='?placename=인문사회관'><li>인문사회관</li></a>
      <a href='?placename=종합교육관'><li>종합교육관</li></a>
      <a href='?placename=중앙삼거리'><li>중앙삼거리</li></a>
      <a href='?placename=종합체육관'><li>종합체육관</li></a>
    </ul>
    <ul class='bbs_list_placename2'>
      <a href='?placename=제1 공학관'><li>제1 공학관</li></a>
      <a href='?placename=제2 공학관'><li>제2 공학관</li></a>
      <a href='?placename=제3 공학관'><li>제3 공학관</li></a>
      <a href='?placename=제4 공학관'><li>제4 공학관</li></a>
    </ul>
    <ul class='bbs_list_placename3'>
      <a href='?placename=조형관'><li>조형관</li></a>
      <a href='?placename=웅비관'><li>웅비관</li></a>
      <a href='?placename=본관'><li>본관</li></a>
    </ul>
    <div class='bbs_menuBtn'>MENU</div>
  </div>



  <div class='bbs_form'>
    <h1 class='bbs_title'>게시판 - {$placename}</h1>

    <input type='' class='content_title' value='제목' disabled>

    <div class='contentBox1'>
      <div class='contentBox1_1'>
        <div class='content_author'>작성자</div>
        <div class='content_date'>날짜</div>
      </div>
      <div class='contentBox1_2'>
        <a class='content_update' href='#'>수정하기</a>
        <a class='content_delete' href='#'>삭제하기</a>
      </div>
    </div>

    <textarea class='content_content' name='' id=''  disabled maxlength='5000'>Lorem ipsum 
    </textarea>
    <div class='good_icon' id='good_icon'><img src='../../img/좋아요.png' id='goodIcon_img'></div>
    <div class='comm_icon' id='comm_icon'><img src='../../img/댓글.png' id='commIcon_img'></div>

    <form action='' name='' class='comm_form'>
      <input type='text' class='comm_text' placeholder='댓글을 입력하세요' maxlength='70'>
      <a href='#' class='comm_submit'>등록</a>
    </form>

    <div class='commView_form' id='commView_form'>
      <ul class='bbs_comm'>
        <div class='comm_info'> 
          <li>우윤하</li>
          <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, culp</li>
        </div>
        <div class='comm_cmd'>
          <a href='#' class='comm_delete'>삭제</a>
          <a href='#' class='comm_comm'>댓글달기</a>
        </div>
      </ul>
    </div>

  </div>















  <script src='../../JS/menu.js'></script>
  <script src='../../JS/bbs.js'></script>
  <script src='../../JS/writecheck.js'></script>
  <script src='../../JS/bbs_read_style.js'></script>
  
  <!-- 추가안함 -->
  <script src='../../JS/bbs_contentCheck.js'></script>
</body>

</html>