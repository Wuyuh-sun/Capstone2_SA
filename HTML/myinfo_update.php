<?
include("./db_connect.php");
session_start();

$data = array(
  'email' => mysqli_real_escape_string($conn, $_POST['email']),
  'pw' => mysqli_real_escape_string($conn, $_POST['pw']),
  'nickname' => mysqli_real_escape_string($conn, $_POST['nickname']),
  'user_profileImg' => mysqli_real_escape_string($conn, $_FILES['profileImgFile']['name'])
);

if ($data['user_profileImg'] == '') {
  // print_r($data);
  $sql = "UPDATE userinfo 
              SET 
                email = '{$data['email']}',
                password = '{$data['pw']}',
                nickname = '{$data['nickname']}'
              WHERE
                idx ='{$_SESSION['idx']}';
          UPDATE friends
              SET 
                username = '{$data['nickname']}'
              WHERE
                username ='{$_SESSION["usernickname"]}';
          UPDATE friends 
              SET 
                friendname = '{$data['nickname']}'
              WHERE
                friendname ='{$_SESSION["usernickname"]}';
         ";
  $result = mysqli_multi_query($conn, $sql);

  if ($result === false) {
    echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('변경에 실패했습니다');
      history.go(-1);
    </script>");
  } else {
    echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('변경에 성공했습니다.'); 
      location.href = 'myinfo.php';
    </script>");
    $sql = "select * from userinfo where email='{$data['email']}'";
    $result = mysqli_query($conn, $sql);
    $num_match = mysqli_num_rows($result);

    if (!$num_match) {
      echo ("
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <script> 
          window.alert('등록되지 않은 계정입니다.') 
          history.go(-1)  
        </script>
        ");
    } else {
      $row = mysqli_fetch_array($result);
      $db_pw = $row["password"];
      mysqli_close($conn);

      if ($data['pw'] != $db_pw) {
        echo (" 
          <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
          <script> 
            window.alert('비밀번호가 틀립니다!') 
            history.go(-1) 
          </script> 
        ");
        exit;
      } else {
        session_start();
        $_SESSION["useremail"] = $row["email"];
        $_SESSION["usernickname"] = $row["nickname"];
        $_SESSION["userpassword"] = $row["password"];
        $_SESSION["idx"] = $row["idx"];
        echo (" 
            <script> location.href = 'myinfo.php'; 
            </script> 
          ");
      }
    }
  }
} else {
  $sql = "UPDATE userinfo 
              SET 
                email = '{$data['email']}',
                password = '{$data['pw']}',
                nickname = '{$data['nickname']}',
                user_profileImg = '{$data['user_profileImg']}'
              WHERE
                idx ='{$_SESSION['idx']}';
          UPDATE friends
              SET 
                username = '{$data['nickname']}'
              WHERE
                username ='{$_SESSION["usernickname"]}';
          UPDATE friends 
              SET 
                friendname = '{$data['nickname']}'
              WHERE
                friendname ='{$_SESSION["usernickname"]}';
            ";
  $result = mysqli_multi_query($conn, $sql);

  // 설정
  $uploads_dir = '../img/userprofile';
  $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

  // 변수 정리
  $error = $_FILES["profileImgFile"]['error'];
  $name = $_FILES["profileImgFile"]['name'];
  $ext_e = explode('.', $name);
  $ext_a = array_pop($ext_e);

  // 오류 확인
  if ($error != UPLOAD_ERR_OK) {
    switch ($error) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        echo "파일이 너무 큽니다. ($error)";
        break;
      case UPLOAD_ERR_NO_FILE:
        echo "파일이 첨부되지 않았습니다. ($error)";
        break;
      default:
        echo "파일이 제대로 업로드되지 않았습니다. ($error)";
    }
    exit;
  }
  // 확장자 확인
  if (!in_array($ext_a, $allowed_ext)) {
    echo "허용되지 않는 확장자입니다.";
    exit;
  }

  // 파일 이동
  move_uploaded_file($_FILES["profileImgFile"]['tmp_name'], "$uploads_dir/$name");
  // 파일 정보 출력
  echo "<h2>파일 정보</h2>
  <ul>
    <li>파일명: $name</li>
    <li>확장자: $ext_a</li>
    <li>파일형식: {$_FILES["profileImgFile"]['type']}</li>
    <li>파일크기: {$_FILES["profileImgFile"]['size']} 바이트</li>
  </ul>";

  echo "
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <script>
    // alert('수정완료');
    location.href = 'myinfo.php';
  </script>
";
}




mysqli_close($conn);
