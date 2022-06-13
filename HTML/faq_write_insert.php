<?
include("./db_connect.php");

$data = array(
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'desc'=>mysqli_real_escape_string($conn, $_POST['desc']),
  'placename'=>$_POST["placename"],
  'notice'=>$_POST["notice"],
  'qna'=>$_POST["qna"]
);
session_start();

$sql = "INSERT INTO faq_main(placename, author, title, content, regdate, qna, bbs_comm, good, notice) 
VALUES (
  '{$data['placename']}',
  '{$_SESSION["usernickname"]}',
  '{$data['title']}',
  '{$data['desc']}',
  NOW(),
  '{$data['qna']}',
  NULL,
  NULL,
  '{$data['notice']}'
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
      location.href='faq.php?placename={$data['placename']}';
    </script>
  ";
}

mysqli_close($conn);
?>
