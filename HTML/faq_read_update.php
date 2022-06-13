<?
include("./db_connect.php");
session_start();

$data = array(
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'desc'=>mysqli_real_escape_string($conn, $_POST['desc'])
);
// echo $data['title'];

$sql = "UPDATE faq_main 
                SET 
                  content = '{$data['desc']}'
                WHERE
                  title ='{$data['title']}'
          ";
$result = mysqli_query($conn, $sql);

echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('수정 성공하였습니다.');
      // location.href = 'faq.php?placename={$_SESSION['placename']}&title={$_SESSION['recent_bbs_title']}';
      history.go(-3);
    </script>");

// echo $_SESSION['placename'];
// echo $_SESSION['recent_bbs_title'];
?>