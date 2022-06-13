<?
include("./db_connect.php");
include("./header_admin.php");
session_start();

if (!$_SESSION["useremail"]) {
  echo (" 
        <script> 
          window.alert('로그인 후 이용해주세요');
          location.href = 'index.php'; 
        </script> 
      ");
} else if ($_SESSION["user_grade"] != "root") {
  echo (" 
        <script> 
          window.alert('접근권한이 없습니다.');
          location.href = 'main.php'; 
        </script> 
      ");
}

$sql = "select * from sa_info";
$result = mysqli_query($conn, $sql);


// echo $row['placename'];


// 지도생성
$CREATE_MAP = "
<script type='text/javascript' src='https://dapi.kakao.com/v2/maps/sdk.js?appkey=09f865a4c6589413cc8f263a0f217a30'></script>
<script>

  var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(35.90755787823137, 128.80109653454724), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

  // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
  var map = new kakao.maps.Map(mapContainer, mapOption); 
</script>
";
// 지도중심좌표이동
$MAP_SETCENTER = "
<script>
  function setCenter() {            
    // 이동할 위도 경도 위치를 생성합니다 
    var moveLatLon = new kakao.maps.LatLng(33.452613, 126.570888);
    
    // 지도 중심을 이동 시킵니다
    map.setCenter(moveLatLon);
  }
  setCenter();
</script>
";
// 지도타입변환
$MAP_TYPECHANGE = "
<script>
  // 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
  var mapTypeControl = new kakao.maps.MapTypeControl();

  // 지도 타입 컨트롤을 지도에 표시합니다
  map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);

  function getInfo() {
    // 지도의 현재 중심좌표를 얻어옵니다 
    var center = map.getCenter(); 
    
    // 지도의 현재 레벨을 얻어옵니다
    var level = map.getLevel();
    
    // 지도타입을 얻어옵니다
    var mapTypeId = map.getMapTypeId(); 
    
    // 지도의 현재 영역을 얻어옵니다 
    var bounds = map.getBounds();
    
    // 영역의 남서쪽 좌표를 얻어옵니다 
    var swLatLng = bounds.getSouthWest(); 
    
    // 영역의 북동쪽 좌표를 얻어옵니다 
    var neLatLng = bounds.getNorthEast(); 
    
    // 영역정보를 문자열로 얻어옵니다. ((남,서), (북,동)) 형식입니다
    var boundsStr = bounds.toString();
    
    
    var message = '지도 중심좌표는 위도 ' + center.getLat() + ', <br>';
    message += '경도 ' + center.getLng() + ' 이고 <br>';
    message += '지도 레벨은 ' + level + ' 입니다 <br> <br>';
    message += '지도 타입은 ' + mapTypeId + ' 이고 <br> ';
    message += '지도의 남서쪽 좌표는 ' + swLatLng.getLat() + ', ' + swLatLng.getLng() + ' 이고 <br>';
    message += '북동쪽 좌표는 ' + neLatLng.getLat() + ', ' + neLatLng.getLng() + ' 입니다';
    
    // 개발자도구를 통해 직접 message 내용을 확인해 보세요.
    // ex) console.log(message);
    console.log(message);
  }
</script>
";


$marker_info = '';
while ($row = mysqli_fetch_array($result)) {
  $marker_info = $marker_info . "
          {
            content:
              `<div class='wrap'>` +
              `<img src='../img/saplace/{$row['placeImg']}'>` +
              `<div class='info'>` +
              `  <div class='place_name'>{$row['placename']} 흡연구역</div>` +
              `  <div class='place_address1'>건물 주소</div>` +
              `  <div class='place_address2'>{$row['road_address']}</div>` +
              `  <div class='place_address3'>{$row['address']}</div>` +
              `  <ul class='place_link'>` +
              `    <a href='#1'><li></li></a>` +
              `    <a href='./bbs.php?placename={$row['placename']}'><li></li></a>` +
              `    <a href='./faq.php?placename={$row['placename']}'><li></li></a>` +
              `  </ul>` +
              `</div>` +
              `</div>` +
              `<div class='infoArrow'></div>`,
            title:'{$row['placename']}',
            latlng: new kakao.maps.LatLng({$row['lat']}, {$row['lng']}),
          },
          ";
}
$marker_control = "
// 마커 이미지의 이미지 주소입니다
    var imageSrc =
      'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png';

    for (let i = 0; i < positions.length; i++) {
      var data = positions[i];
      displayMarker(data);
    }

    function displayMarker(data) {
      // 마커 이미지의 이미지 크기 입니다
      var imageSize = new kakao.maps.Size(24, 35);

      // 마커 이미지를 생성합니다
      var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);
      var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: data.latlng, // 마커를 표시할 위치
        title: data.title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
        image: markerImage, // 마커 이미지
      });
      var overlay = new kakao.maps.CustomOverlay({
        // content: data.content,
        // map: map, // 마커를 표시할 지도
        position: marker.getPosition()
      });

      var content = document.createElement('div');
      content.innerHTML = data.content;
      content.style.cssText = 'background: white; border: 1px solid black';

      var closeBtn = document.createElement('button');
      closeBtn.onclick = function() {
        overlay.setMap(null);
      };
      content.appendChild(closeBtn);
      overlay.setContent(content);

      kakao.maps.event.addListener(marker, 'click', function() {
        overlay.setMap(map);
      });
    }
";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/main.css">
  <link rel="stylesheet" href="../CSS/header.css">
  <title>Document</title>
</head>

<body>
  
  <?= $header ?>
  
  <!-- 지도 -->
  <div id="map"></div>

  <script src="../JS/menu.js"></script>
  <?= $CREATE_MAP ?>
  <!-- <?= $MAP_SETCENTER ?> -->
  <!-- <?= $MAP_TYPECHANGE ?> -->


  <script>
    var positions = [
      <?= $marker_info ?>
    ];
    document.getElementById
    <?= $marker_control ?>
  </script>

</body>

</html>