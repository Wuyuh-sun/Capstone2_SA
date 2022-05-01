<?php 
  $conn = mysqli_connect("localhost", "root","","SA");

  $data = array(
    'email'=>mysqli_real_escape_string($conn, $_POST['email'])
  );
  $ranNum = sprintf('%06d',rand(000000,999999));
  $sql = "select * from userinfo where email='{$data['email']}'";
  


  $result = mysqli_query($conn, $sql);

  $num_match = mysqli_num_rows($result);

  $row = mysqli_fetch_array($result); 

  if (!$num_match){
    echo("
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
      <script> 
        window.alert('등록되지 않은 계정입니다.') 
        history.go(-1)  
      </script>
      "); 
  }  else {
    session_start();
    $_SESSION["findPW_email"] = $row["email"];
    unset($_SESSION["findPW_checkNUM"]); 
    $_SESSION["findPW_checkNUM"] = $ranNum;

    // 로드할 프로그램 경로(경로에 맞게 수정하세요)
    $libLoad = $_SERVER['DOCUMENT_ROOT']."/HTML/smtpSendMail.php";
    include_once $libLoad;

    // 환경설정 - 기본
    $config = array(
        'host'=>'smtp.naver.com', // SMTP 호스트 주소
        'smtp_id'=>'wjh0970', //SMTP 아이디
        'smtp_pw'=>'dndbsgk416510!', //SMTP 비밀번호
        'port'=>'465', //SMTP 포트
        'debug'=>1, // 디버그 , 0: 미사용, 1: 사용
        'msg'=>1, // 메시징뷰 , 0: 미사용, 1: 사용
        'charset'=>'UTF-8', // SMTP 언어셋
        'ctype'=>'text/html', // SMTP 내용 컨텐츠타입        
    );


    /*
    // 네이버 일경우 
    $config = array(
        'host'=>'smtp.naver.com', // SMTP 호스트 주소 (465포트는 SSL보안서버 적용으로 -> 본래는 이렇게 해주어야함 ssl://smtp.naver.com)
        'smtp_id'=>'naver1devgroup', //SMTP 아이디
        'smtp_pw'=>'naver1devgroup', //SMTP 비밀번호
        'port'=>'465', //SMTP 포트
        'debug'=>1, // 디버그 , 0: 미사용, 1: 사용
        'msg'=>1, // 메시징뷰 , 0: 미사용, 1: 사용
        'charset'=>'UTF-8', // SMTP 언어셋
        'ctype'=>'text/html', // SMTP 내용 컨텐츠타입        
    );
    */

    // 메일 라이브러리 초기화
    $ssm = new smtpSendMail($config);

    // 메일 발송데이터
    $parmData = array(
        'to'=>"{$data['email']}",
        'from'=>'wjh0970@naver.com',
        'name'=>'SA_DEVTEAM',
        'subject'=>'SA 비밀번호 인증',
        'body'=>"SA 앱 비밀번호 인증 번호입니다.<br>".$ranNum."<br> SA 앱을 이용해주셔서 감사합니다.",
        'cc'=>'',
        'bcc'=>''
    );

    // 파일첨부 
    // $ssm->attach($_SERVER['DOCUMENT_ROOT']."/파일1.zip","파일1.zip"); 
    // $ssm->attach($_SERVER['DOCUMENT_ROOT']."/파일2.zip","파일2.zip");

    // 메일 발송
    $ssm->send_mail($parmData);  

    

    
  }
  echo("
          <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
          <script> 
            location.href = 'findPW2_5.php' 
          </script>
        ");
  
  ?>