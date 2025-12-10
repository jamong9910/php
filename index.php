<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>방탈출 사진 핫스팟 데모</title>
<style>
  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    background: #111;
    overflow: hidden;
  }

  .image-wrapper {
    position: relative;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
  }

  #backgroundImg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100vw;
    height: auto;
    min-height: 100vh;
    object-fit: cover;
  }

  .hotspot {
    position: absolute;
    cursor: pointer;
    background: rgba(255, 0, 0, 0.2); /* 테스트용 */
    border-radius: 6px;
  }
</style>
</head>
<body>

<div class="image-wrapper">
  <img id="backgroundImg" src="room.jpg" alt="방탈출 사진">

  <div class="hotspot" id="tv"></div>
  <div class="hotspot" id="hs-box"></div>
</div>

<script>
const hotspots = [
  {
    id: "tv",
    x: 42.71,
    y: 37.04,
    w: 18.75,
    h: 23.15,
    onClick: () => openTvPuzzle()
  },
  {
    id: "hs-box",
    x: 70.0,
    y: 60.0,
    w: 12.0,
    h: 15.0,
    onClick: () => openHintBox()
  }
];

// TV 퍼즐 열기
function openTvPuzzle() {
  const answer = prompt("TV에는 밝기 조절 화면이 흐릿하게 보인다.\n3자리 비밀번호를 입력하세요.");

  if (answer === null) return; // 취소

  if (answer === "243") {
    alert("정답!\n문이 열렸습니다! 🎉");
  } else {
    alert("비밀번호가 틀렸습니다.");
  }
}

// 힌트 상자
function openHintBox() {
  alert("힌트: TV 화면 모서리를 자세히 보면 밝기 수치가 2 • 4 • 3 으로 적혀 있다.");
}

function updateHotspots() {
  const img = document.getElementById("backgroundImg");
  const wrapper = document.querySelector(".image-wrapper");

  const rect = img.getBoundingClientRect();
  const width = rect.width;
  const height = rect.height;
  const offsetX = rect.left;
  const offsetY = rect.top;

  hotspots.forEach(h => {
    const el = document.getElementById(h.id);

    el.style.left = offsetX + (width * (h.x / 100)) + "px";
    el.style.top = offsetY + (height * (h.y / 100)) + "px";
    el.style.width = (width * (h.w / 100)) + "px";
    el.style.height = (height * (h.h / 100)) + "px";

    el.onclick = h.onClick;
  });
}

window.addEventListener("load", updateHotspots);
window.addEventListener("resize", updateHotspots);
</script>

</body>
</html>
