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
// 지도생성
$CREATE_MAP = "
<script type='text/javascript' src='https://dapi.kakao.com/v2/maps/sdk.js?appkey=09f865a4c6589413cc8f263a0f217a30&libraries=services'></script>
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
$MARK_CREATE = "
<script>
  // 주소-좌표 변환 객체를 생성합니다
  var geocoder = new kakao.maps.services.Geocoder();

  var marker = new kakao.maps.Marker(); // 클릭한 위치를 표시할 마커입니다


  // 현재 지도 중심좌표로 주소를 검색해서 지도 좌측 상단에 표시합니다
  searchAddrFromCoords(map.getCenter(), displayCenterInfo);

  // 지도를 클릭했을 때 클릭 위치 좌표에 대한 주소정보를 표시하도록 이벤트를 등록합니다
  kakao.maps.event.addListener(map, 'click', function(mouseEvent) {
    searchDetailAddrFromCoords(mouseEvent.latLng, function(result, status) {
      if (status === kakao.maps.services.Status.OK) {
        var detailRoadAddr = !!result[0].road_address ? result[0].road_address.address_name : '';
        var detailAddr = result[0].address.address_name;

        var content1 = detailRoadAddr;
        var content2 = detailAddr;


        // 마커를 클릭한 위치에 표시합니다 
        marker.setPosition(mouseEvent.latLng);
        marker.setMap(map);

        // 지도에 클릭 이벤트를 등록합니다
        // 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다


        // 클릭한 위도, 경도 정보를 가져옵니다 
        var latlng = mouseEvent.latLng;

        // 마커 위치를 클릭한 위치로 옮깁니다
        marker.setPosition(latlng);

        // 위도 정보 저장
        var message_lat = latlng.getLat();
        // 경도 정보 저장
        var message_lng = latlng.getLng();

        var resultLat = document.getElementById('clickLat');
        var resultLng = document.getElementById('clickLng');
        resultLat.value = message_lat;
        resultLng.value = message_lng;



        var resultInput = document.getElementById('roadAddress');
        var resultInput2 = document.getElementById('Address');
        resultInput.value = content1;
        resultInput2.value = content2
      }
    });
  });

  // 중심 좌표나 확대 수준이 변경됐을 때 지도 중심 좌표에 대한 주소 정보를 표시하도록 이벤트를 등록합니다
  kakao.maps.event.addListener(map, 'idle', function() {
    searchAddrFromCoords(map.getCenter(), displayCenterInfo);
  });

  function searchAddrFromCoords(coords, callback) {
    // 좌표로 행정동 주소 정보를 요청합니다
    geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback);
  }

  function searchDetailAddrFromCoords(coords, callback) {
    // 좌표로 법정동 상세 주소 정보를 요청합니다
    geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
  }

  // 지도 좌측상단에 지도 중심좌표에 대한 주소정보를 표출하는 함수입니다
  function displayCenterInfo(result, status) {
    if (status === kakao.maps.services.Status.OK) {
      var infoDiv = document.getElementById('centerAddr');

      for (var i = 0; i < result.length; i++) {
        // 행정동의 region_type 값은 'H' 이므로
        if (result[i].region_type === 'H') {
          infoDiv.innerHTML = result[i].address_name;
          break;
        }
      }
    }
  }
</script>
";


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
        // overlay.setMap(null);
      };
      content.appendChild(closeBtn);
      overlay.setContent(content);

      kakao.maps.event.addListener(marker, 'click', function() {
        // overlay.setMap(map);
        const idx = document.getElementById(data.idx);
        if(data.idx == idx.value){
          document.getElementById(data.title).focus();
          for(let i=0; i<document.getElementsByTagName('tr').length; i++){
            document.getElementsByTagName('tr').item(i[0]).style.backgroundColor='rgb(190, 190, 190)';
            document.getElementsByTagName('tr').item(i).style.backgroundColor='white';
          }
          document.getElementById('tr_'+data.idx).style.backgroundColor = 'tomato';
        } 
      });
    }
";

// 마커 생성 폼
$mark_create_form = "";
if (isset($_GET['create'])) {
  $mark_create_form = "
  <!-- 지도 -->
      <div id='map'></div>
      {$CREATE_MAP}
      {$MARK_CREATE}
      <form action='saInfo_create.php' name='saInfo_create' id='map_insert' method='POST'>
        <ul>
          <li>
            <label for='lat'>위도(Lat)</label><input type='text' name='lat' id='clickLat' placeholder='위치를 찍으세요' readonly>
            <label for='lng'>경도(Lng)</label><input type='text' name='lng' id='clickLng' placeholder='위치를 찍으세요' readonly>
          </li>
          <li>
            <label for='load_addr'>도로명 주소(필수X)</label><input type='text' name='load_addr' id='roadAddress' placeholder='위치를 찍으세요' readonly>
            <label for='addr'>지번 주소</label><input type='text' name='addr' id='Address' placeholder='위치를 찍으세요' readonly>
            <label for='placename'>장소이름</label><input type='text' name='placename' id='insertPlaceName' placeholder='장소이름을 적으세요'>
          </li>
          <a href='#' class='insert_submit' onclick='inputCheck()'>생성하기</a>
        </ul>
        <div class='footer'></div>
      </form>
      <script>
        document.getElementById('btn_1').style.borderBottom = '3px solid red';
      </script>
  ";
}

// 마커 수정 폼
$mark_update_form = "";
if (isset($_GET['update'])) {
  $sql = "select * from sa_info";
  $result = mysqli_query($conn, $sql);
  $marker_info = '';
  $delete_list_tr = "";
  while ($row = mysqli_fetch_array($result)) {
    $marker_info = $marker_info . "
          {
            content:
              `<div class='wrap'>` +
              `<img src='../img/saplace/'>` +
              `<div class='info'>` +
              `  <div class='place_name'>{$row['placename']} 흡연구역</div>` +
              `  <div class='place_address1'>건물 주소</div>` +
              `  <div class='place_address2'>{$row['road_address']}</div>` +
              `  <div class='place_address3'>{$row['address']}</div>` +
              `  <ul class='place_link'>` +
              `    <a href='#1'><li></li></a>` +
              `    <a href='./bbs/bbs.php?placename={$row['placename']}'><li></li></a>` +
              `    <a href='./faq/faq.php'><li></li></a>` +
              `  </ul>` +
              `</div>` +
              `</div>` +
              `<div class='infoArrow'></div>`,
            title:'{$row['placename']}',
            latlng: new kakao.maps.LatLng({$row['lat']}, {$row['lng']}),
            idx: {$row['idx']}
          },
          ";
    $delete_list_tr = $delete_list_tr . "
    <tr align='center' id='tr_{$row['idx']}'>
      <form action='saInfo_update.php?idx={$row['idx']}' name='saInfo_update{$row['idx']}' method='POST' enctype='multipart/form-data'>
        <td><input type='text' name='idx{$row['idx']}' id='{$row['idx']}' class='idx' value='{$row['idx']}' readonly></td>
        <td><input type='text' name='placename{$row['idx']}' id='{$row['placename']}' value='{$row['placename']}'></td>
        <td><input type='text' name='road_address{$row['idx']}' value='{$row['road_address']}'></td>
        <td><input type='text' name='address{$row['idx']}' value='{$row['address']}'></td>
        <td><input type='text' name='lat{$row['idx']}' value='{$row['lat']}'></td>
        <td><input type='text' name='lng{$row['idx']}' value='{$row['lng']}'></td>
        <td><a href='../img/saplace/{$row['placeImg']}' class='placeImg_now' target='_blank'>{$row['placeImg']}</a></td>
        <td><input type='file' name='placeImg{$row['idx']}'></td>
        <td><a href='#' onclick='updateCheck{$row['idx']}()'><img src='../img/update.png' alt='update' class='updateImg'></a></td>
      </form>
    </tr>
    <script>
    function updateCheck{$row['idx']}(){
      if (!document.saInfo_update{$row['idx']}.placename{$row['idx']}.value) {
        alert('장소 이름 데이터를 넣어주세요');
        document.saInfo_update{$row['idx']}.placename{$row['idx']}.focus();
        return;
      }
      if (!document.saInfo_update{$row['idx']}.address{$row['idx']}.value) {
        alert('지번 주소 데이터를 넣어주세요');
        document.saInfo_update{$row['idx']}.address{$row['idx']}.focus();
        return;
      }
      if (!document.saInfo_update{$row['idx']}.lat{$row['idx']}.value) {
        alert('위도 데이터를 넣어주세요');
        document.saInfo_update{$row['idx']}.lat{$row['idx']}.focus();
        return;
      }
      if (!document.saInfo_update{$row['idx']}.lng{$row['idx']}.value) {
        alert('경도 데이터를 넣어주세요');
        document.saInfo_update{$row['idx']}.lng{$row['idx']}.focus();
        return;
      }
      document.saInfo_update{$row['idx']}.submit();
    }
    </script>
    ";
  }
  $update_list = "
  <label for='lat' class='lat_label'>위도(Lat)</label><input type='text' id='clickLat' class='clickLat' placeholder='위치를 찍으세요' readonly>
  <label for='lng' class='lng_label'>경도(Lng)</label><input type='text' id='clickLng' class='clickLng' placeholder='위치를 찍으세요' readonly>
  <label for='load_addr' class='load_addr_label'>도로명 주소(필수X)</label><input type='text' id='roadAddress' class='roadAddress' placeholder='위치를 찍으세요' readonly>
  <label for='addr' class='addr_label'>지번 주소</label><input type='text' id='Address' class='Address'  placeholder='위치를 찍으세요' readonly>

  <div id='map_update'>
    <table>
      <thead>
        <th>번호</th>
        <th>장소이름</th>
        <th>도로명 주소(필수X)</th>
        <th>지번 주소</th>
        <th>위도</th>
        <th>경도</th>
        <th>장소 이미지 파일</th>
        <th>장소 이미지 선택</th>
        <th>UPDATE</th>
      </thead>
      {$delete_list_tr}
    </table>
  </div>
  ";
  $mark_update_form = "
  <div id='map'></div>
      {$CREATE_MAP}
      {$MARK_CREATE}
      {$update_list}
      <div class='footer2'></div>
      <script>
      var positions = [
        {$marker_info}
      ];
      {$marker_control}
        document.getElementById('btn_2').style.borderBottom = '3px solid red';
      </script>
  ";
}

// 마커 삭제 폼
$mark_delete_form = "";
if (isset($_GET['delete'])) {
  $sql = "select * from sa_info";
  $result = mysqli_query($conn, $sql);
  $marker_info = '';
  $delete_list_tr = "";
  while ($row = mysqli_fetch_array($result)) {
    $marker_info = $marker_info . "
          {
            content:
              `<div class='wrap'>` +
              `<img src='../img/saplace/'>` +
              `<div class='info'>` +
              `  <div class='place_name'>{$row['placename']} 흡연구역</div>` +
              `  <div class='place_address1'>건물 주소</div>` +
              `  <div class='place_address2'>{$row['road_address']}</div>` +
              `  <div class='place_address3'>{$row['address']}</div>` +
              `  <ul class='place_link'>` +
              `    <a href='#1'><li></li></a>` +
              `    <a href='./bbs/bbs.php?placename={$row['placename']}'><li></li></a>` +
              `    <a href='./faq/faq.php'><li></li></a>` +
              `  </ul>` +
              `</div>` +
              `</div>` +
              `<div class='infoArrow'></div>`,
            title:'{$row['placename']}',
            latlng: new kakao.maps.LatLng({$row['lat']}, {$row['lng']}),
            idx: {$row['idx']}
          },
          ";
    $delete_list_tr = $delete_list_tr . "
    <tr align='center' id='tr_{$row['idx']}'>
      <form action='saInfo_delete.php?idx={$row['idx']}' name='saInfo_delete{$row['idx']}' method='POST' enctype='multipart/form-data'>
        <td><input type='text' name='idx{$row['idx']}' id='{$row['idx']}' class='idx' value='{$row['idx']}' readonly></td>
        <td><input type='text' name='placename{$row['idx']}' id='{$row['placename']}' value='{$row['placename']}' readonly></td>
        <td><input type='text' name='road_address{$row['idx']}' value='{$row['road_address']}' readonly></td>
        <td><input type='text' name='address{$row['idx']}' value='{$row['address']}' readonly></td>
        <td><input type='text' name='lat{$row['idx']}' value='{$row['lat']}' readonly></td>
        <td><input type='text' name='lng{$row['idx']}' value='{$row['lng']}' readonly></td>
        <td><a href='../img/saplace/{$row['placeImg']}' class='placeImg_now' target='_blank'>{$row['placeImg']}</a></td>
        
        <td><a href='#' onclick='deleteCheck{$row['idx']}()'><img src='../img/delete.png' alt='update' class='deleteImg'></a></td>
      </form>
    </tr>
    <script>
    function deleteCheck{$row['idx']}(){
      document.saInfo_delete{$row['idx']}.submit();
    }
    </script>
    ";
  }
  $delete_list = "
  
  <div id='map_update'>
    <table>
      <thead>
        <th>번호</th>
        <th>장소이름</th>
        <th>도로명 주소(필수X)</th>
        <th>지번 주소</th>
        <th>위도</th>
        <th>경도</th>
        <th>장소 이미지 파일</th>
        
        <th>DELETE</th>
      </thead>
      {$delete_list_tr}
    </table>
  </div>
  ";
  $mark_delete_form = "
  <div id='map'></div>
  {$CREATE_MAP}
  {$delete_list}
  <div class='footer2'></div>
  <script>
  var positions = [
    {$marker_info}
  ];
  {$marker_control}
    document.getElementById('btn_3').style.borderBottom = '3px solid red';
  </script>
  ";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/main.css">
  <link rel="stylesheet" href="../CSS/map_manager.css">
  <title>Document</title>
</head>

<body>
  <?=$header?>

  <!-- 지도 관리 -->
  <div class="manage_form">
    <!-- button -->
    <ul class="mark_btn">
      <a href="?create">
        <li id='btn_1'>마커 생성</li>
      </a>
      <a href="?update">
        <li id='btn_2'>마커 수정</li>
      </a>
      <a href="?delete">
        <li id='btn_3'>마커 삭제</li>
      </a>
    </ul>
    <?= $mark_create_form ?>
    <?= $mark_update_form ?>
    <?= $mark_delete_form ?>
  </div>


  <script src="../JS/menu.js"></script>
  <script src="../JS/map_mark_create.js"></script>

</body>

</html>