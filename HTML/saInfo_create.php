<?
include("./db_connect.php");

$data = array(
  'lat'=>mysqli_real_escape_string($conn, $_POST['lat']),
  'lng'=>mysqli_real_escape_string($conn, $_POST['lng']),
  'load_addr'=>mysqli_real_escape_string($conn, $_POST['load_addr']),
  'addr'=>mysqli_real_escape_string($conn, $_POST['addr']),
  'placename'=>mysqli_real_escape_string($conn, $_POST['placename']),
);

$sql = "INSERT INTO sa_info(placename, road_address, address, lat, lng) 
VALUES (
  '{$data['placename']}', 
  '{$data['load_addr']}',
  '{$data['addr']}',
  '{$data['lat']}',
  '{$data['lng']}'
  )";

$result = mysqli_multi_query($conn, $sql);
if($result === false){
  error_log(mysqli_error($conn));
} else {
  echo "
  <script>
    alert('마크 생성 완료');
    history.go(-1);
  </script>
  ";
}

?>