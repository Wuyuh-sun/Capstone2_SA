<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>좌표로 주소를 얻어내기</title>
  <style>
    .map_wrap {
      position: relative;
      width: 100%;
      height: 350px;
    }

    .title {
      font-weight: bold;
      display: block;
    }

    .hAddr {
      position: absolute;
      left: 10px;
      top: 10px;
      border-radius: 2px;
      background: #fff;
      background: rgba(255, 255, 255, 0.8);
      z-index: 1;
      padding: 5px;
    }

    #centerAddr {
      display: block;
      margin-top: 2px;
      font-weight: normal;
    }

    .bAddr {
      padding: 5px;
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
    }

    #input1 {
      width: 400px;
    }

    #input2 {
      width: 400px;
    }
  </style>
</head>

<body>
  <div class="map_wrap">
    <div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div>
    <div class="hAddr">
      <span class="title">지도중심기준 행정동 주소정보</span>
      <span id="centerAddr"></span>
    </div>
  </div>
  <label for="" class="">위도(Lat)</label><input type="text" id="clickLat" placeholder="위치를 찍으세요">
  <label for="" class="">경도(Lng)</label><input type="text" id="clickLng" placeholder="위치를 찍으세요">
  <input type="text" id="input1">
  <input type="text" id="input2">

  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=09f865a4c6589413cc8f263a0f217a30&libraries=services"></script>
  <script>
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
      mapOption = {
        center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
        level: 1 // 지도의 확대 레벨
      };

    // 지도를 생성합니다    
    var map = new kakao.maps.Map(mapContainer, mapOption);

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



          var resultInput = document.getElementById("input1");
          var resultInput2 = document.getElementById("input2");
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
</body>

</html>