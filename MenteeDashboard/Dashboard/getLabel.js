const video = document.getElementById("video");

Promise.all([
  faceapi.nets.ssdMobilenetv1.loadFromUri("/MainVbuddy/models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("/MainVbuddy/models"),
  faceapi.nets.faceLandmark68Net.loadFromUri("/MainVbuddy/models"),
]);

function startWebcam(assignID, topicID, menteeID, dateAttend, username) {
  document.getElementById("cameraContainer").style.display = "block";
  document.getElementById("captureBtn").style.display = "block";

  navigator.mediaDevices
    .getUserMedia({
      video: true,
      audio: false,
    })
    .then((stream) => {
      video.srcObject = stream;
      video.addEventListener("play", () =>
        handleFaceDetection(assignID, topicID, menteeID, dateAttend, username)
      );
    })
    .catch((error) => {
      console.error("Error starting webcam:", error);
    });
}

async function getLabeledFaceDescriptions(username) {
  const labels = [username]; // Load only the logged-in user's face
  return Promise.all(
    labels.map(async (label) => {
      const descriptions = [];
      for (let i = 1; i <= 2; i++) {
        try {
          const img = await faceapi.fetchImage(`./labels/${label}/${i}.png`);
          const detections = await faceapi
            .detectSingleFace(img)
            .withFaceLandmarks()
            .withFaceDescriptor();
          descriptions.push(detections.descriptor);
        } catch (error) {
          console.error(`Error loading image for label ${label}: ${error}`);
        }
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  );
}

async function handleFaceDetection(assignID, topicID, menteeID, dateAttend, username) {
  const labeledFaceDescriptors = await getLabeledFaceDescriptions(username);
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

  const canvas = faceapi.createCanvasFromMedia(video);
  cameraContainer.appendChild(canvas);

  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);

  let detectedLabels = [];

  setInterval(async () => {
    const detections = await faceapi
      .detectAllFaces(video)
      .withFaceLandmarks()
      .withFaceDescriptors();

    const resizedDetections = faceapi.resizeResults(detections, displaySize);
    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

    detectedLabels = detections.map((d) =>
      faceMatcher.findBestMatch(d.descriptor).label
    );

    detections.forEach((detection, i) => {
      const box = resizedDetections[i].detection.box;
      const result = faceMatcher.findBestMatch(detection.descriptor);
      const drawBox = new faceapi.draw.DrawBox(box, {
        label: result.toString(),
      });
      drawBox.draw(canvas);
    });
  }, 100);

  captureBtn.addEventListener("click", () => {
    if (!detectedLabels.includes(username)) {
      alert("Face does not match the logged-in user.");
      return; // Stop here to prevent additional actions
    }
    takeAttendance(assignID, topicID, menteeID, dateAttend);
  });
}

async function takeAttendance(assignID, topicID, menteeID, dateAttend) {
  try {
    const formData = new FormData();
    formData.append("assignID", assignID);
    formData.append("topicID", topicID);
    formData.append("menteeID", menteeID);
    formData.append("dateAttend", dateAttend);

    const response = await fetch("process_attendance.php", {
      method: "POST",
      body: formData,
    });

    const result = await response.text();

    // Show the result in a single alert box and prevent further alerts
    if (result.includes("Error")) {
      console.error(result); // Show error if any
    } else {
      alert(result); // Show success message for attendance
    }

    // Stop the webcam
    const stream = video.srcObject;
    const tracks = stream.getTracks();
    tracks.forEach((track) => track.stop());

    // Hide the camera container
    document.getElementById("cameraContainer").style.display = "none";

    // Use a slight delay before reloading to prevent multiple alerts
    setTimeout(() => {
      location.reload();
    }, 1000); // 1 second delay before reload
  } catch (error) {
    alert("Error taking attendance: " + error.message);
  }
}
