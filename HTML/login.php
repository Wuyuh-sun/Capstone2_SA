<?
$conn = mysqli_connect("localhost", "root","","SA");

$data = array(
  'email'=>mysqli_real_escape_string($conn, $_POST['email']),
  'pw'=>mysqli_real_escape_string($conn, $_POST['pw'])
);

$sql = "select * from userinfo where email='{$data['email']}'";

$result = mysqli_query($conn, $sql);

$num_match = mysqli_num_rows($result); 

if (!$num_match){
  echo("
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
    echo(" 
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
      echo(" 
        <script> location.href = 'main.php'; 
        </script> 
      ");
    }
  }
?>
