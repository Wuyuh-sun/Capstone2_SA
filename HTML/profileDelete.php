<?
include("./db_connect.php");
session_start();

$sql = "UPDATE userinfo 
        SET 
          user_profileImg = 'user.png'
        WHERE
          idx ='{$_SESSION['idx']}'
        ";
  $result = mysqli_multi_query($conn, $sql);
  echo "
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <script>
    // alert('수정완료');
    location.href = 'myinfo.php';
  </script>
";
?>