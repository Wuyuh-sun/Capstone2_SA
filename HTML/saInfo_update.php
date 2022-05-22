<?
include("./db_connect.php");

$data = array(
  'idx' => mysqli_real_escape_string($conn, $_POST['idx' . $_GET['idx']]),
  'placename' => mysqli_real_escape_string($conn, $_POST['placename' . $_GET['idx']]),
  'road_address' => mysqli_real_escape_string($conn, $_POST['road_address' . $_GET['idx']]),
  'address' => mysqli_real_escape_string($conn, $_POST['address' . $_GET['idx']]),
  'lat' => mysqli_real_escape_string($conn, $_POST['lat' . $_GET['idx']]),
  'lng' => mysqli_real_escape_string($conn, $_POST['lng' . $_GET['idx']]),
  'placeImg' => mysqli_real_escape_string($conn, $_FILES["placeImg{$_GET['idx']}"]['name'])
);
// var_dump($_FILES["{$_POST['placeImg'.$_GET['idx']]}"]);
// echo $_FILES["placeImg{$_GET['idx']}"];
// var_dump($_FILES["placeImg{$_GET['idx']}"]);
print_r($_FILES["placeImg{$_GET['idx']}"]);
// echo $data['placeImg'];

if ($data['placeImg'] == '') {
  $sql = "UPDATE sa_info 
              SET 
                idx = '{$data['idx']}',
                placename = '{$data['placename']}',
                road_address = '{$data['road_address']}',
                address = '{$data['address']}',
                lat = '{$data['lat']}',
                lng = '{$data['lng']}'
              WHERE
                idx ='{$data['idx']}'
         ";
  $result = mysqli_multi_query($conn, $sql);
} else {
  $sql = "UPDATE sa_info 
              SET 
                idx = '{$data['idx']}',
                placename = '{$data['placename']}',
                road_address = '{$data['road_address']}',
                address = '{$data['address']}',
                lat = '{$data['lat']}',
                lng = '{$data['lng']}',
                placeImg = '{$data['placeImg']}'
              WHERE
                idx ='{$data['idx']}'
         ";
  $result = mysqli_multi_query($conn, $sql);

  // 설정
  $uploads_dir = '../img/saplace';
  $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

  // 변수 정리
  $error = $_FILES["placeImg{$_GET['idx']}"]['error'];
  $name = $_FILES["placeImg{$_GET['idx']}"]['name'];
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
  move_uploaded_file($_FILES["placeImg{$_GET['idx']}"]['tmp_name'], "$uploads_dir/$name");
  // 파일 정보 출력
  echo "<h2>파일 정보</h2>
<ul>
	<li>파일명: $name</li>
	<li>확장자: $ext_a</li>
	<li>파일형식: {$_FILES["placeImg{$_GET['idx']}"]['type']}</li>
	<li>파일크기: {$_FILES["placeImg{$_GET['idx']}"]['size']} 바이트</li>
</ul>";
}

echo "
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <script>
    alert('수정완료');
    location.href = 'map_manager.php?update';
  </script>
";
?>
