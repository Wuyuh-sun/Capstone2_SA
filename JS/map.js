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
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "인문사회관 뒤",
    latlng: new kakao.maps.LatLng(35.90685055702087, 128.802894228696),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "종합교육관 뒤",
    latlng: new kakao.maps.LatLng(35.90716325255311, 128.80292347658084),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "제 1공학관 뒷문",
    latlng: new kakao.maps.LatLng(35.90859144108271, 128.80217776535017),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "제 3공학관 뒷문",
    latlng: new kakao.maps.LatLng(35.909369616798855, 128.8027132461286),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "제 4공학관 정문",
    latlng: new kakao.maps.LatLng(35.91016282313474, 128.80194757098496),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "제 2공학관 뒷문",
    latlng: new kakao.maps.LatLng(35.90971305358485, 128.80129492663218),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "조형관 뒷문",
    latlng: new kakao.maps.LatLng(35.90920725023216, 128.79972166741155),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "중앙 삼거리",
    latlng: new kakao.maps.LatLng(35.908420985895084, 128.80122686484668),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "본관 옆",
    latlng: new kakao.maps.LatLng(35.90701113433643, 128.8016517972052),
  },
  {
    content:
      '<div class="wrap">' +
      '    <div class="info">' +
      '        <div class="title">' +
      "            카카오 스페이스닷원" +
      '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
      "        </div>" +
      '        <div class="body">' +
      '            <div class="img">' +
      '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
      "           </div>" +
      '            <div class="desc">' +
      '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
      '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
      '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
      "            </div>" +
      "        </div>" +
      "    </div>" +
      "</div>",
    title: "웅비관 앞",
    latlng: new kakao.maps.LatLng(35.906976648210936, 128.79643688234347),
  },
  {
    content:
    `<div class="wrap">` +
    `<img src="../img/saplace/12.png">` +
    `<div class="info">` +
    `  <div class="place_name">종합체육관 흡연구역</div>`+
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
    `  <div class="close" onclick="closeOverlay()" title="닫기"></div>` +
    `</div>` +
  `</div>` +
  `<div class="infoArrow"></div>`,
    title: "종합체육관 옆",
    latlng: new kakao.maps.LatLng(35.90644782805857, 128.79955670834335),
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

  // 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
  kakao.maps.event.addListener(marker, "click", function () {
    overlay.setMap(map);
  });

  // 커스텀 오버레이를 닫기 위해 호출되는 함수입니다
  function closeOverlay() {
    overlay.setMap(null);
  }
}

// 커스텀 오버레이에 표시할 컨텐츠 입니다
// 커스텀 오버레이는 아래와 같이 사용자가 자유롭게 컨텐츠를 구성하고 이벤트를 제어할 수 있기 때문에
// 별도의 이벤트 메소드를 제공하지 않습니다
var content =
  '<div class="wrap">' +
  '    <div class="info">' +
  '        <div class="title">' +
  "            카카오 스페이스닷원" +
  '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' +
  "        </div>" +
  '        <div class="body">' +
  '            <div class="img">' +
  '                <img src="https://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
  "           </div>" +
  '            <div class="desc">' +
  '                <div class="ellipsis">제주특별자치도 제주시 첨단로 242</div>' +
  '                <div class="jibun ellipsis">(우) 63309 (지번) 영평동 2181</div>' +
  '                <div><a href="https://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div>' +
  "            </div>" +
  "        </div>" +
  "    </div>" +
  "</div>";

// // 마커 위에 커스텀오버레이를 표시합니다
// // 마커를 중심으로 커스텀 오버레이를 표시하기위해 CSS를 이용해 위치를 설정했습니다
// var overlay = new kakao.maps.CustomOverlay({
//     content: content,
//     map: map,
//     position: marker.getPosition()
// });

// // 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
// kakao.maps.event.addListener(marker, 'click', function() {
//     overlay.setMap(map);
// });

// // 커스텀 오버레이를 닫기 위해 호출되는 함수입니다
// function closeOverlay() {
//     overlay.setMap(null);
// }
