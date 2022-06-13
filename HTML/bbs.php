<?
  session_start();
  if($_SESSION["user_grade"] == "root"){
    include("./header_admin.php");
  }
  if($_SESSION["user_grade"] == NULL){
    include("./header.php");
  }
  if(!$_SESSION["useremail"]){
    echo(" 
          <script> 
            window.alert('로그인 후 이용해주세요');
            location.href = 'index.php'; 
          </script> 
        ");
  }
  
  $placename = $_GET['placename'];

  include("./db_connect.php");
  $sql = "select * from bbs_main where placename='$placename' order by idx desc";
  $result = mysqli_query($conn, $sql);

  $list = '';
  
  // 리스트
  while($row = mysqli_fetch_array($result)){
    $list = $list."
  <li>
    <div>
      <a href='bbs.php?placename={$placename}&title={$row['title']}&idx={$row['idx']}'><h3>{$row['title']}</h3></a>
      <div class='content'>{$row['content']}</div>
    </div>
    <div>
      <p>
        <span>{$row['regdate']}</span>
        <span>{$row['author']}</span>
      </p>
      <p>
        <img src='../../img/댓글.png' class='li_comm'>{$row['bbs_comm']}</img>
        <img src='../../img/좋아요.png' class='li_good'>{$row['good']}</img>
      </p>
    </div>
  </li>";
  }
  

  // 게시판 폼
  $bbs_form = "";
  if(isset($placename)){
    $noticeSql = "select * from bbs_main where placename='$placename' and notice=1 order by idx desc";
    $noticeSql_result = mysqli_query($conn, $noticeSql);
    $notice_row = mysqli_fetch_array($noticeSql_result);

    $goodSql = "select * from bbs_main where placename='$placename' and good order by idx desc";
    $goodSql_result = mysqli_query($conn, $goodSql);
    $hot_row = mysqli_fetch_array($goodSql_result);
    $bbs_form = "
    <div class='bbs_form'>
    <h1 class='bbs_title'>게시판 - {$placename}</h1>
    <a href='bbs.php?placename={$placename}&title={$notice_row['title']}&idx={$notice_row['idx']}'>
      <div class='bbs_notice'>
        <img src='../../img/bell.png'> 게시판 공지
      </div>
    </a>
    <a href='bbs.php?placename={$placename}&title={$hot_row['title']}&idx={$hot_row['idx']}'>
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
    if($_SESSION['user_grade'] == 'root'){
      $bbs_form = "";
      $write_form = "
      <form class='bbs_form' name='bbs_form' action='bbs_write_insert.php' method='POST'>
        <a href='bbs.php?placename={$placename}' class='closeBtn'></a>
        <div class='writetext'>글 쓰기</div>
        <label class='notice_chk'><input type='checkbox' name='notice' value=1>공지</label>
        <input type='text' name='title' id='write_title' class='write_title' placeholder='제목을 입력하세요' maxlength='50'>
        <input type='hidden' name='placename' value='{$placename}'>
        <textarea class='write_desc' id='write_desc' name='desc' maxlength='5000' placeholder='내용을 입력하세요'></textarea>
        <a href='#' class='write_submit' onclick='writeCheck_input()'>완료</a>
      </form>
      ";
    } else{
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
  }
  // 글 읽기
  $bbsRead_form = "";
  if(isset($_GET['title'])){

    $sql = "select * from bbs_main where placename='$placename' AND title='{$_GET['title']}' AND idx='{$_GET['idx']}'";
    $result = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_array($result);
    

    //댓글 리스트
    $comm_sql = "select * from bbs_comm where bbs_idx='{$_GET['idx']}' AND placename='$placename' AND title='{$_GET['title']}'";
    $comm_result = mysqli_query($conn, $comm_sql);
    $comm_list = '';
    while($comm_row = mysqli_fetch_array($comm_result)){

      //대댓글 리스트
      $comm_comm_sql="select * from bbs_comm_comm 
      where 
      bbs_idx='{$_GET['idx']}' AND 
      placename='$placename' AND 
      title='{$_GET['title']}' AND
      comm_idx='{$comm_row['idx']}'
      ";
      $comm_comm_result = mysqli_query($conn, $comm_comm_sql);
      $comm_comm_list="";
      while($comm_comm_row = mysqli_fetch_array($comm_comm_result)){
        $comm_comm_list= $comm_comm_list."
        <li>
          <div>↪</div>
          <div>{$comm_comm_row['comm_comm_author']}</div>
          <div>{$comm_comm_row['comm_comm_content']}</div>
          <div onclick='comm_comm_delete{$comm_comm_row['idx']}()'>삭제</div>
        </li>
        <script>
          function comm_comm_delete{$comm_comm_row['idx']}(){
            let user = '{$_SESSION['usernickname']}';
            if(user != '{$comm_comm_row['comm_comm_author']}'){
              alert('삭제 권한이 없습니다!');
            } else{
              fetch('bbsComm_comm_delete.php',{
                method: 'POST',
                headers:{
                        'Content-Type': 'application/json',
                        },
                body:JSON.stringify({
                  bbs_idx: '{$row2['idx']}',
                  comm_comm_idx: '{$comm_comm_row['idx']}'
                })
              }).then(function(e){
                e.text().then(function(a){
                  location.reload();
                  
                })
              })
            }
            
          }
        </script>
        ";
      }

      $comm_list = $comm_list."
      <ul class='bbs_comm'>
        <div class='comm_info'> 
          <li>{$comm_row['comm_author']}</li>
          <li>{$comm_row['comm_content']}</li>
        </div>
        <div class='comm_cmd'>
          <div class='comm_delete' onclick='comm_delete{$comm_row['idx']}()'>삭제</div>
          <div class='comm_comm' onclick='comm_comm_open{$comm_row['idx']}()'>댓글달기</div>
        </div>
      </ul>
      <form action='bbsComm_comm_insert.php' class='comm_comm_form comm_comm_form{$comm_row['idx']}' method='POST'>
        <input type='text' name='comm_comm_content' placeholder='대댓글을 입력하세요' maxlength='70'>
        <input type='hidden' name='bbs_idx' value='{$_GET['idx']}'>
        <input type='hidden' name='placename' value='{$_GET['placename']}'>
        <input type='hidden' name='title' value='{$_GET['title']}'>
        <input type='hidden' name='comm_idx' value='{$comm_row['idx']}'>
        <input type='hidden' name='comm_author' value='{$comm_row['comm_author']}'>
        <input type='hidden' name='comm_content' value='{$comm_row['comm_content']}'>
        <input type='hidden' name='comm_comm_author' value='{$_SESSION['usernickname']}'>
        <input type='submit' class='comm_comm_submitBtn' value='등록'>
      </form>
      <ul class='bbs_comm_comm'>
        {$comm_comm_list}
      </ul>
      <script>
        function comm_delete{$comm_row['idx']}(){
          let user = '{$_SESSION['usernickname']}';
          if( user != '{$comm_row['comm_author']}'){
            alert('삭제 권한이 없습니다!');
          } else{
            fetch('bbs_comm_delete.php',{
              method: 'POST',
              headers:{
                      'Content-Type': 'application/json',
                      },
              body:JSON.stringify({
                bbs_idx: '{$row2['idx']}',
                comm_idx: '{$comm_row['idx']}'
              })
            }).then(function(e){
              e.text().then(function(a){
                location.reload();
              })
            })
          }
        }

        function comm_comm_open{$comm_row['idx']}(){
          
          const comm_commLayout = document.querySelector('.comm_comm_form{$comm_row['idx']}');
          if(comm_commLayout.style.display == 'inline-block'){
            comm_commLayout.style.display = 'none';
            
          } else{
            comm_commLayout.style.display = 'inline-block';
            
          }
        }
      </script>
      ";
    }
    $good_sql = "
    select * from good_data where click_user='{$_SESSION['usernickname']}' AND placename='$placename' AND title='{$_GET['title']}' AND content_idx='{$_GET['idx']}'
    ";
    $good_result = mysqli_query($conn, $good_sql);
    $good_row = mysqli_fetch_array($good_result);
    if($good_row['good'] == 1){
      $goodImg = "<img src='../../img/좋아요2.png' id='goodIcon_img'>";
    } else{
      $goodImg = "<img src='../../img/좋아요.png' id='goodIcon_img'>";
    }
    $bbs_form = "";
    $bbsRead_form = "
    <div class='bbs_form'>
    <h1 class='bbs_title'>게시판 - {$placename}</h1>
    <input type='text' class='content_title' value='{$row2['title']}' disabled>
    <div class='contentBox1'>
      <div class='contentBox1_1'>
        <div class='content_author'>{$row2['author']}</div>
        <div class='content_date'>{$row2['regdate']}</div>
      </div>
      <div class='contentBox1_2'>
      <a class='content_update' href='#' onclick='checkUpdateInfo()'>수정하기</a>
      <a class='content_delete' href='#' onclick='checkDeleteInfo()'>삭제하기</a>

      <form action='bbs_read_delete.php' name='bbs_read_delete' method='POST'>
        <input type='hidden' name='title' id='delete_title' value='{$row2['title']}'>
        <input type='hidden' name='author' value='{$row2['author']}'>
        <input type='hidden' name='placename' value='{$placename}'>
      </form>

      </div>
    </div>
    <textarea class='content_content' disabled maxlength='5000'>{$row2['content']} 
    </textarea>
    <div class='good_icon' id='good_icon' onclick='good_{$_GET['idx']}()'>{$goodImg}</div>
    <div class='comm_icon' id='comm_icon'><img src='../../img/댓글.png' id='commIcon_img'></div>
    
    <form action='bbs_comm_insert.php' name='' class='comm_form' method='POST'>
      <input type='text' name='comm' class='comm_text' placeholder='댓글을 입력하세요' maxlength='70' autocomplete='off'>
      <input type='hidden' name='bbs_idx' value='{$_GET['idx']}'>
      <input type='hidden' name='placename' value='{$placename}'>
      <input type='hidden' name='title' value='{$row2['title']}'>
      <a href='#' class='comm_submit' onclick='comm_inputCheck()'>등록</a>
    </form>

    <div class='commView_form' id='commView_form'>
      {$comm_list}
    </div>

  </div>
  <script>
    const nickname = '{$_SESSION['usernickname']}';
    const author = '{$row2['author']}';
    
    function checkUpdateInfo(){
      if(nickname != author){
        alert('수정 권한이 없습니다!');
        location.href = '{$url}';
      } else{
        location.href = '{$url}&update';
      }
    }
    function checkDeleteInfo(){
      if(nickname != author){
        alert('삭제 권한이 없습니다!');
        location.href = '{$url}';
      } else{
        if(confirm('정말로 삭제 하시겠습니까?(삭제하면 복구가 불가능합니다.)') == true){
          
          document.bbs_read_delete.submit();
        } else {
          location.href = '{$url}';
        }
      }
    }
    function good_{$_GET['idx']}(){
      fetch('good_update.php',{
        method: 'POST',
        headers:{
                'Content-Type': 'application/json',
                },
        body:JSON.stringify({
              placename: '{$placename}',
              title: '{$_GET['title']}',
              idx: '{$_GET['idx']}'
            })
      }).then(function(e){
        e.text().then(function(a){
          console.log(a);
          if(a == '1'){
            console.log('좋아요임');
            document.querySelector('#good_icon').innerHTML = 
            '<img src=\'../../img/좋아요2.png\' id=\'goodIcon_img\'>';
          } 
          if(a == '0'){
            console.log('취소임');
            document.querySelector('#good_icon').innerHTML = 
            '<img src=\'../../img/좋아요.png\' id=\'goodIcon_img\'>';
          }
        })
      })
    }
    function comm_inputCheck(){
      if(!document.querySelector('.comm_text').value){
        alert('댓글 입력 후 등록해주세요'); 
        document.querySelector('.comm_text').focus(); 
        return;
      }
      document.querySelector('.comm_form').submit();
    }
  </script>
    ";
    // echo  $_SESSION["usernickname"];

    // 글 읽기 수정
    if(isset($_GET['update'])){
      
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
      <input type='text' name='title' class='content_title' id='write_title' value='{$row2['title']}' readonly>
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
    if(isset($_GET['delete'])){
      if($_SESSION['usernickname'] != $row2['author']){
        echo "
        <script>
        alert('접근권한이 없습니다.');
        // history.go(-1);
        </script>
        ";
      }
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
  <link rel="stylesheet" href="../CSS/header.css">
  <title>Document</title>
</head>

<body>
  <?=$header?>
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