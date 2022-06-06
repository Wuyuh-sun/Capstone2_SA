<?
include("../db_connect.php");

$data = array(
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'desc'=>mysqli_real_escape_string($conn, $_POST['desc']),
  'placename'=>$_POST["placename"]
);
session_start();

$sql = "INSERT INTO bbs_main(author, title, content, regdate, img_file, bbs_comm, good, notice, placename) 
VALUES (
  '{$_SESSION["usernickname"]}',
  '{$data['title']}',
  '{$data['desc']}',
  NOW(),
  NULL,
  NULL,
  NULL,
  3,
  '{$data['placename']}'
  )";

$result = mysqli_query($conn, $sql);
if($result === false){
  echo "
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('글쓰기를 실패하였습니다.');
      history.go(-1);
    </script>
  ";
  error_log(mysqli_error($conn));
} else {
  echo "
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('글쓰기를 성공하였습니다.');
      location.href='bbs.php?placename={$data['placename']}';
    </script>
  ";
}

mysqli_close($conn);
?>
