<!DOCTYPE html>
<html>
<head>
<title>kaldap</title>
<style>
#video-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  position: relative;
}

#video-player {
  max-width: 85%;
  max-height: 85%;
}

#level-indicator {
  position: absolute;
  top: 10px;
  left: 10px;
  background-color: rgba(0, 0, 0, 0.5);
  color: #fff;
  padding: 5px;
  font-size: 16px;
  cursor: pointer;
}
</style>
</head>
<body>
<div id="video-container">
  <video id="video-player" autoplay controls>
    <source src="people.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div id="level-indicator"></div>
</div>
<audio id="notification-sound" loop>
  <source src="test.mp3" type="audio/mpeg">
  Your browser does not support the audio tag.
</audio>
<script>
var videoPlayer = document.getElementById("video-player");
var notificationSound = document.getElementById("notification-sound");
var levelIndicator = document.getElementById("level-indicator");
var lastDetectedObjectsCount = 0;
var isAlertPlaying = false;
var isBlinking = false;
var isNotificationShown = false;
var levelIntervals = [
  { level: "Level 1: 안전 단계", backgroundColor: "#87CEEB", minCount: 0 },
  { level: "Level 2: 주의 단계", backgroundColor: "#FFFF00", minCount: 10 },
  { level: "Level 3: 위험 단계", backgroundColor: "#FF0000", minCount: 25 }
];

videoPlayer.addEventListener("play", function() {
  var intervalId = setInterval(function() {
    var detectedObjectsCount = getDetectedObjectsCount();
    if (detectedObjectsCount !== lastDetectedObjectsCount) {
      updateLevelIndicator(detectedObjectsCount);
      lastDetectedObjectsCount = detectedObjectsCount;
    }
    if (!isAlertPlaying) {
      playAlertIfNeeded(detectedObjectsCount);
    }
  }, 10000); // 10초마다 업데이트

  videoPlayer.addEventListener("pause", function() {
    clearInterval(intervalId);
  });
});

function getDetectedObjectsCount() {
  return Math.floor(Math.random() * 50) + 1; // 1부터 50까지의 랜덤한 수 반환
}

function updateLevelIndicator(detectedObjectsCount) {
  for (var i = levelIntervals.length - 1; i >= 0; i--) {
    var levelInterval = levelIntervals[i];
    if (detectedObjectsCount >= levelInterval.minCount) {
      levelIndicator.innerText = levelInterval.level;
      document.body.style.backgroundColor = levelInterval.backgroundColor;
      if (i === levelIntervals.length - 1 && !isNotificationShown) {
        blinkBackground();
        playNotificationSound();
        isNotificationShown = true;
      }
      break;
    }
  }
}

function playAlertIfNeeded(detectedObjectsCount) {
  if (detectedObjectsCount > levelIntervals[1].minCount && detectedObjectsCount < 50) {
    playAlert();
  }
}

function playAlert() {
  isAlertPlaying = true;
  if (lastDetectedObjectsCount >= levelIntervals[2].minCount) {
    alert("많은 인원이 감지되었습니다!");
  }
}

function blinkBackground() {
  if (isBlinking) {
    return;
  }
  isBlinking = true;
  var count = 0;
  var intervalId = setInterval(function() {
    if (count === 10) {
      clearInterval(intervalId);
      document.body.style.backgroundColor = "#FFFFFF"; // 하얀색
      isBlinking = false;
    } else {
      document.body.style.backgroundColor = count % 2 === 0 ? "#FF0000" : "#FFFFFF";
      count++;
    }
  }, 500);
}

function playNotificationSound() {
  notificationSound.play();
}

levelIndicator.addEventListener("click", function() {
  if (isNotificationShown) {
    isNotificationShown = false;
    notificationSound.pause();
    notificationSound.currentTime = 0;
  }
});
</script>
</body>
</html>

<?php
$videoPath = 'test.mp4';


// 영상 재생 함수
function playVideo($videoPath) {
    $html = '<video width="320" height="240" controls>';
    $html .= '<source src="' . $videoPath . '" type="video/mp4">';
    $html .= 'Your browser does not support the video tag.';
    $html .= '</video>';

    echo $html;
}

// 영상 재생
playVideo($videoPath);
?>

