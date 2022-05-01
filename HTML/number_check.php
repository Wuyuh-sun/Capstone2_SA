<?
$check_num = $_POST["numCheck"];

session_start();

if(isset($_SESSION["findPW_checkNUM"]) == $check_num){
  echo "
        <script>
          alert('인증에 성공했습니다');
          location.href = 'findPW3.php';
        </script>
  ";
} else {
  echo "
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <script>
          alert('인증에 실패했습니다');
          history.go(-1);
        </script>
  ";
}

?>