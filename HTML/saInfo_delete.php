<?
include("./db_connect.php");

// echo 'delete'.$_GET['idx'];

$data = array(
  'idx' => mysqli_real_escape_string($conn, $_POST['idx' . $_GET['idx']]),
  'placename' => mysqli_real_escape_string($conn, $_POST['placename' . $_GET['idx']]),
  'road_address' => mysqli_real_escape_string($conn, $_POST['road_address' . $_GET['idx']]),
  'address' => mysqli_real_escape_string($conn, $_POST['address' . $_GET['idx']]),
  'lat' => mysqli_real_escape_string($conn, $_POST['lat' . $_GET['idx']]),
  'lng' => mysqli_real_escape_string($conn, $_POST['lng' . $_GET['idx']])
);

// echo $data['idx'];

$sql = "DELETE FROM sa_info
        WHERE idx='{$data['idx']}'
          ";
$result = mysqli_query($conn, $sql);

echo ("
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <script>
      alert('삭제 성공하였습니다.');
      location.href = 'map_manager.php?delete';
    </script>");
?>