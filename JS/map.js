var mapContainer = document.getElementById("map"), // 지도를 표시할 div
  mapOption = {
    center: new kakao.maps.LatLng(35.90755787823137, 128.80109653454724), // 지도의 중심좌표
    level: 2, // 지도의 확대 레벨
  };

// 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption);

// 마커를 표시할 위치와 title 객체 배열입니다
var positions = [
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/1.png">` +
      `<div class="info">` +
      `  <div class="place_name">인문사회관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 인문사회관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "인문사회관 뒤",
    latlng: new kakao.maps.LatLng(35.90685055702087, 128.802894228696),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/2.png">` +
      `<div class="info">` +
      `  <div class="place_name">종합교육관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 종합교육관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "종합교육관 뒤",
    latlng: new kakao.maps.LatLng(35.90716325255311, 128.80292347658084),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/3-2.png">` +
      `<div class="info">` +
      `  <div class="place_name">제1 공학관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 제1 공학관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "제 1공학관 뒷문",
    latlng: new kakao.maps.LatLng(35.90859144108271, 128.80217776535017),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/4.png">` +
      `<div class="info">` +
      `  <div class="place_name">제3 공학관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 제3 공학관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "제 3공학관 뒷문",
    latlng: new kakao.maps.LatLng(35.909369616798855, 128.8027132461286),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/5.png">` +
      `<div class="info">` +
      `  <div class="place_name">제4 공학관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 제4 공학관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "제 4공학관 정문",
    latlng: new kakao.maps.LatLng(35.91016282313474, 128.80194757098496),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/6.png">` +
      `<div class="info">` +
      `  <div class="place_name">제2 공학관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 제2 공학관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "제 2공학관 뒷문",
    latlng: new kakao.maps.LatLng(35.90971305358485, 128.80129492663218),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/7.png">` +
      `<div class="info">` +
      `  <div class="place_name">조형관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 조형관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "조형관 뒷문",
    latlng: new kakao.maps.LatLng(35.90920725023216, 128.79972166741155),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/8.png">` +
      `<div class="info">` +
      `  <div class="place_name">중앙삼거리 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 중앙삼거리</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "중앙 삼거리",
    latlng: new kakao.maps.LatLng(35.908420985895084, 128.80122686484668),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/11.png">` +
      `<div class="info">` +
      `  <div class="place_name">웅비관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 웅비관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "웅비관 앞",
    latlng: new kakao.maps.LatLng(35.906976648210936, 128.79643688234347),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/12.png">` +
      `<div class="info">` +
      `  <div class="place_name">종합체육관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 종합체육관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="#2"><li></li></a>` +
      `    <a href="#3"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay('overlay')" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "종합체육관 옆",
    latlng: new kakao.maps.LatLng(35.90644782805857, 128.79955670834335),
  },
  {
    content:
      `<div class="wrap">` +
      `<img src="../img/saplace/9.png">` +
      `<div class="info">` +
      `  <div class="place_name">본관 흡연구역</div>` +
      `  <ul class="place_eval">` +
      `    <li>4.0</li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/fullstar.png"></li>` +
      `    <li><img src="../img/star.png"></li>` +
      `    <li>&nbsp;&nbsp;(100+)</li>` +
      `  </ul>` +
      `  <div class="place_address1">건물 주소</div>` +
      `  <div class="place_address2">경북 경산시 하양읍 가마실길 50 본관</div>` +
      `  <ul class="place_link">` +
      `    <a href="#1"><li></li></a>` +
      `    <a href="./bbs/bbs.php?placename=본관"><li></li></a>` +
      `    <a href="./faq/faq.php"><li></li></a>` +
      `  </ul>` +
      `  <div class="close" onclick="closeOverlay('overlay')" title="닫기"></div>` +
      `</div>` +
      `</div>` +
      `<div class="infoArrow"></div>`,
    title: "본관 옆",
    latlng: new kakao.maps.LatLng(35.90701113433643, 128.8016517972052),
  },
];

// 마커 이미지의 이미지 주소입니다
var imageSrc =
  "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";

for (var i = 0; i < positions.length; i++) {
  // 마커 이미지의 이미지 크기 입니다
  var imageSize = new kakao.maps.Size(24, 35);

  // 마커 이미지를 생성합니다
  var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);
  // 지도에 마커를 표시합니다
  var marker = new kakao.maps.Marker({
    map: map, // 마커를 표시할 지도
    position: positions[i].latlng, // 마커를 표시할 위치
    title: positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
    image: markerImage, // 마커 이미지
  });
  
  // 마커 위에 커스텀오버레이를 표시합니다
  // 마커를 중심으로 커스텀 오버레이를 표시하기위해 CSS를 이용해 위치를 설정했습니다
  var overlay = new kakao.maps.CustomOverlay({
    content: positions[i].content,
    // map: map, // 마커를 표시할 지도
    position: marker.getPosition(),
  });
  var closeBtn = new kakao.maps.CustomOverlay({
    content: positions[i].content,
    positions: marker.getPosition(),
  });


  // 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
  kakao.maps.event.addListener(
    marker,
    "click",
    openOverlay(overlay)
  );
  
}
function openOverlay(overlay) {
  return function () {
      overlay.setMap(map);
  };
}
// 커스텀 오버레이를 닫기 위해 호출되는 함수입니다
const closeOverlay = () => {
    overlay.setMap(null);
}
// for (var i = 0; i < positions.length; i ++) {
//   // 마커를 생성합니다
//   var marker = new kakao.maps.Marker({
//       map: map, // 마커를 표시할 지도
//       position: positions[i].latlng // 마커의 위치
//   });

//   // 마커에 표시할 인포윈도우를 생성합니다
//   var infowindow = new kakao.maps.InfoWindow({
//       content: positions[i].content // 인포윈도우에 표시할 내용
//   });

//   // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
//   // 이벤트 리스너로는 클로저를 만들어 등록합니다
//   // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
//   kakao.maps.event.addListener(marker, 'mousedown', makeOverListener(map, marker, infowindow));
//   kakao.maps.event.addListener(marker, 'click', makeOutListener(infowindow));
// }

// // 인포윈도우를 표시하는 클로저를 만드는 함수입니다
// function makeOverListener(map, marker, infowindow) {
//   return function() {
//       infowindow.open(map, marker);

//   };
// }

// // 인포윈도우를 닫는 클로저를 만드는 함수입니다
// function makeOutListener(infowindow) {
//   return function() {
//       infowindow.close();
//   };
// }
