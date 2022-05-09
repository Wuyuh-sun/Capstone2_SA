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
  $placename = $_GET['placename'];

  include("../db_connect.php");
  $sql = "select * from bbs_main where placename='$placename' order by idx desc";
  $result = mysqli_query($conn, $sql);

  $list = '';
  
  // 리스트
  while($row = mysqli_fetch_array($result)){
    $list = $list."
  <li>
    <div>
      <a href='bbs.php?placename={$placename}&title={$row['title']}'><h3>{$row['title']}</h3></a>
      <span>{$row['content']}</span>
    </div>
    <div>
      <p>
        <span>{$row['regdate']}</span>
        <span>{$row['author']}</span>
      </p>
      <p>
        <img src='../../img/사진.png' class='li_pic'>0</img>
        <img src='../../img/댓글.png' class='li_comm'>00</img>
        <img src='../../img/좋아요.png' class='li_good'>00</img>
      </p>
    </div>
  </li>";
  }
  // 게시판 폼
  $bbs_form = "";
  if(isset($placename)){
    $bbs_form = "
    <div class='bbs_form'>
    <h1 class='bbs_title'>게시판 - {$placename}</h1>
    <a href='#1'>
      <div class='bbs_notice'>
        <img src='../../img/bell.png'> 게시판 공지
      </div>
    </a>
    <a href='#2'>
      <div class='bbs_hot'>
        <img src='../../img/hot.png'> 인기글
      </div>
    </a>
    <a href='?placename={$placename}&write=write'>
      <div class='bbs_write'>글쓰기</div>
    </a>
    <ul class='bbs_article_list'>
      {$list}
    </ul>
  </div>
    ";
  }
  // 글쓰기 폼
  $http_host = $_SERVER['HTTP_HOST'];
  $request_uri = $_SERVER['REQUEST_URI'];
  $url = 'http://' . $http_host . $request_uri;
  $write_form = "";
  if(isset($_GET["write"])){
    $bbs_form = "";
    $write_form = "
    <form class='bbs_form' name='bbs_form' action='bbs_write_insert.php' method='POST'>
    <a href='bbs.php?placename={$placename}' class='closeBtn'></a>
    <div class='writetext'>글 쓰기</div>
    <input type='text' name='title' id='write_title' class='write_title' placeholder='제목을 입력하세요' maxlength='50'>
    <input type='hidden' name='placename' value='{$placename}'>
    <textarea class='write_desc' id='write_desc' name='desc' maxlength='5000' placeholder='내용을 입력하세요'></textarea>
    <a href='#' class='write_submit' onclick='writeCheck_input()'>완료</a>
    </form>
    ";
  }
  // 글 읽기
  $bbsRead_form = "";
  if(isset($_GET['title'])){

    $sql = "select * from bbs_main where placename='$placename' AND title='{$_GET['title']}'";
    $result = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_array($result);
    // echo $row2['author'];
    // echo $_SESSION["usernickname"];
    
    $bbs_form = "";
    $bbsRead_form = "
    <div class='bbs_form'>
    <h1 class='bbs_title'>게시판 - {$placename}</h1>
    <input type='text' class='content_title' value={$row2['title']} disabled>
    <div class='contentBox1'>
      <div class='contentBox1_1'>
        <div class='content_author'>{$row2['author']}</div>
        <div class='content_date'>{$row2['regdate']}</div>
      </div>
      <div class='contentBox1_2'>
        <a class='content_update' href='#' onclick='checkUpdateInfo()'>수정하기</a>
        <a class='content_delete' href='#' onclick='checkDeleteInfo()'>삭제하기</a>
      </div>
    </div>
    <textarea class='content_content' disabled maxlength='5000'>{$row2['content']} 
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
    ";
    echo "
          <script>
            const nickname = '{$_SESSION['usernickname']}';
            const author = '{$row2['author']}'
            function checkUpdateInfo(){
              if(nickname != author){
                alert('수정 권한이 없습니다!');
                location.href = '{$url}';
              } else{
                
                location.href = '{$url}&mode=update';
              }
            }
            function checkDeleteInfo(){
              if(nickname != author){
                alert('삭제 권한이 없습니다!');
                location.href = '{$url}';
              } else{
                if(confirm('정말로 삭제 하시겠습니까?(삭제하면 복구가 불가능합니다.)') == true){
                  alert('확인누름');
                } else {
                  location.href = '{$url}';
                }
              }
            }
          </script>
        ";
    // echo  $_SESSION["usernickname"];

    // 글 읽기 수정
    if(isset($_GET['mode'])){
      
      if($_SESSION['usernickname'] != $row2['author']){
        echo "
        <script>
        alert('접근권한이 없습니다.');
        // history.go(-1);
        </script>
        ";
      }
      $bbsRead_form = "
    <div class='bbs_form'>
    <form action='bbs_read_update.php' name='bbs_form' method='POST'>
      <h1 class='bbs_title'>게시판 - {$placename}</h1>
      <input type='text' name='title' class='content_title' id='write_title' value={$row2['title']} readonly>
      <div class='contentBox1'>
        <div class='contentBox1_1'>
          <div class='content_author'>{$row2['author']}</div>
          <div class='content_date'>{$row2['regdate']}</div>
        </div>
        <div class='contentBox1_2'>
          <a class='content_update2' href='#' onclick='writeCheck_input()'>수정완료</a>
        </div>
      </div>
      <textarea class='content_content' name='desc' id='write_desc' maxlength='5000' autofocus>{$row2['content']} 
      </textarea>
    </form>
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
    ";
    $_SESSION['placename'] = $placename;
    $_SESSION['recent_bbs_title'] = $row2['title'];
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../CSS/bbs.css">
  <link rel="stylesheet" href="../../CSS/bbs_write.css">
  <link rel="stylesheet" href="../../CSS/bbs_read.css">
  <title>Document</title>
</head>

<body>
  <div class="windowBlack" id="windowBlack"></div>
  <!-- 헤더 -->
  <div class="header">
    <!-- 메뉴 -->
    <img src="../../img/menu_black_24dp.svg" class="menu" id="menu">
    <!-- SA홈 아이콘 -->
    <a href="../main.php">
      <div class="SA_HOME" id="SA_HOME">
        <div class="SA" id="SA">SA</div>
      </div>
    </a>
    <!-- 채팅 -->
    <img src="../../img/sms_black_24dp.svg" class="chat" id="chat">
  </div>
  <!--좌측 사이드바 -->
  <div class="menu_sidebar" id="menu_sidebar">
    <div><a href="../myinfo.php">내 정보</a></div>
    <div><a href="../friendpage.php">친구</a></div>
    <div><a href="../logout.php">로그아웃</a></div>
    <img src="../../img/expand_circle_down_black_24dp.svg" class="menu_closeBtn1" id="menu_closeBtn1">
  </div>
  <!-- 우측 사이드바 -->
  <div class="friend_sidebar" id="friend_sidebar">
    <div class="friend_barTop">
      <img src="../../img/expand_circle_down_black_24dp.svg" class="menu_closeBtn2" id="menu_closeBtn2">
      <div>친구 목록</div>
    </div>
  </div>

  <!-- 게시판 -->
  <!-- 게시판 메뉴 -->
  <div class="bbs_list" id="bbs_list">
    <ul class="bbs_list_placename1">
      <a href="?placename=인문사회관"><li>인문사회관</li></a>
      <a href="?placename=종합교육관"><li>종합교육관</li></a>
      <a href="?placename=중앙삼거리"><li>중앙삼거리</li></a>
      <a href="?placename=종합체육관"><li>종합체육관</li></a>
    </ul>
    <ul class="bbs_list_placename2">
      <a href="?placename=제1 공학관"><li>제1 공학관</li></a>
      <a href="?placename=제2 공학관"><li>제2 공학관</li></a>
      <a href="?placename=제3 공학관"><li>제3 공학관</li></a>
      <a href="?placename=제4 공학관"><li>제4 공학관</li></a>
    </ul>
    <ul class="bbs_list_placename3">
      <a href="?placename=조형관"><li>조형관</li></a>
      <a href="?placename=웅비관"><li>웅비관</li></a>
      <a href="?placename=본관"><li>본관</li></a>
    </ul>
    <div class="bbs_menuBtn">MENU</div>
  </div>

  <!-- 게시판 본문 -->
  <!-- <div class="bbs_form">
    <h1 class="bbs_title">게시판 - 본관</h1>
    <a href="#1">
      <div class="bbs_notice">
        <img src="../../img/bell.png"> 게시판 공지
      </div>
    </a>
    <a href="#2">
      <div class="bbs_hot">
        <img src="../../img/hot.png"> 인기글
      </div>
    </a>
    <a href="bbs_write.php">
      <div class="bbs_write">글쓰기</div>
    </a>
    <ul class="bbs_article_list">
      <?=$list?>
    </ul>
  </div> -->
  <?=$bbs_form?>
  <?=$write_form?>
  <?=$bbsRead_form?>



  <script src="../../JS/menu.js"></script>
  <script src="../../JS/bbs.js"></script>
  <script src="../../JS/writecheck.js"></script>
  <script src="../../JS/bbs_read_style.js"></script>
</body>

</html>