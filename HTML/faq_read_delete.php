<?
// echo "11";

include("./db_connect.php");
session_start();

$data = array(
  'title'=>mysqli_real_escape_string($conn, $_POST['title']),
  'author'=>mysqli_real_escape_string($conn, $_POST['author']),
  'placename'=>mysqli_real_escape_string($conn, $_POST['placename'])
);
// echo $data['title'];

$sql = "DELETE FROM faq_main
        WHERE title='{$data['title']}' AND author='{$data['author']}'
          ";
$result = mysqli_query($conn, $sql);

echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('삭제 성공하였습니다.');
      location.href = 'bbs.php?placename={$data['placename']}';
    </script>");

// echo $_SESSION['placename'];
// echo $_SESSION['recent_bbs_title'];
?>