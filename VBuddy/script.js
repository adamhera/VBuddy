
var Mentor = document.getElementById("");
var test = document.getElementById("test");

function handleRegisterTextHover() {
  if (Mentor.style.opacity === "0") {
    test.style.opacity = "1";
  } else {
    test.style.opacity = "0";
  }
}

Mentor.addEventListener("mouseenter", function() {
  handleRegisterTextHover();
});

Mentor.addEventListener("mouseleave", function() {
  handleRegisterTextHover();
});

Promise.all([
  faceapi.nets.ssdMobilenetv1.loadFromUri("/models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("/models"),
  faceapi.nets.faceLandmark68Net.loadFromUri("/models"),
]).then(() => console.log("Models loaded successfully."));

function openCamera(event) {
  event.preventDefault();

  navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
      const video = document.getElementById('video');
      video.srcObject = stream;
      video.play();

      const element = document.getElementById('videoDiv');
      element.classList.remove('hidden');

      const captureCount = 2;
      const interval = 2000;
      let captured = 0;

      const captureInterval = setInterval(() => {
        const capturedImage = captureImage(video);

        if (captured === 0) {
          document.getElementById('capturedImage1').value = capturedImage;
          document.getElementById('displayImage1').src = capturedImage;
        } else if (captured === 1) {
          document.getElementById('capturedImage2').value = capturedImage;
          document.getElementById('displayImage2').src = capturedImage;
        }

        captured++;
        if (captured >= captureCount) {
          clearInterval(captureInterval);
          stream.getTracks().forEach(track => track.stop());
          element.classList.add('hidden');
        }
      }, interval);
    })
    .catch((error) => {
      console.error('Error accessing webcam:', error);
    });
}

function captureImage(video) {
  const canvas = document.createElement('canvas');
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;

  const ctx = canvas.getContext('2d');
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

  return canvas.toDataURL('image/png');
}





