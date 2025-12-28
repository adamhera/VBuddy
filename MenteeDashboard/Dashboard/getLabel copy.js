const video = document.getElementById("video");


Promise.all([
  faceapi.nets.ssdMobilenetv1.loadFromUri("/models"),
  faceapi.nets.faceRecognitionNet.loadFromUri("/models"),
  faceapi.nets.faceLandmark68Net.loadFromUri("/models"),
]).then(() => {
  console.log("Models loaded successfully.");
});

function startWebcam() { //here change to openCamera(buttonId)
  document.getElementById('cameraContainer').style.display = 'block';
  navigator.mediaDevices
    .getUserMedia({
      video: true,
      audio: false,
    })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((error) => {
      console.error(error);
    });
}

console.log("YEs");


async function getLabeledFaceDescriptions() {
 // console.log(`Processing folder for assignID: ${assignID}`);

  // The descriptions array will hold descriptors for all valid images in the folder
  const descriptions = [];
  const numImages = 2; // Adjust this if the number of images per folder varies

  for (let i = 1; i <= numImages; i++) {
    try {
      // Load each image using assignID
      const img = await faceapi.fetchImage(`./Labels/2023977976/${i}.png`);
      // Detect the face, landmarks, and descriptors
      const detections = await faceapi
        .detectSingleFace(img)
        .withFaceLandmarks()
        .withFaceDescriptor();
      descriptions.push(detections.descriptor); // Add the descriptor to the list
      console.log(descriptions);
    } catch (error) {
      console.warn(`Image ${i}.png for assignID  not found or failed to process.`);
    }
  }

  if (descriptions.length === 0) {
    throw new Error(`No valid images found for assignID: `);
  }

  // Create a LabeledFaceDescriptors object for the assignID
  return new faceapi.LabeledFaceDescriptors('2023977976', descriptions);
}



video.addEventListener("play", async () => {
  const labeledFaceDescriptors = await getLabeledFaceDescriptions();
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);

  const canvas = faceapi.createCanvasFromMedia(video);
  document.body.append(canvas);

  const displaySize = { width: video.width, height: video.height };
  faceapi.matchDimensions(canvas, displaySize);

  setInterval(async () => {
    const detections = await faceapi
      .detectAllFaces(video)
      .withFaceLandmarks()
      .withFaceDescriptors();

    const resizedDetections = faceapi.resizeResults(detections, displaySize);

    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

    const results = resizedDetections.map((d) => {
      return faceMatcher.findBestMatch(d.descriptor);
    });
    results.forEach((result, i) => {
      const box = resizedDetections[i].detection.box;
      const drawBox = new faceapi.draw.DrawBox(box, {
        label: result,
      });
      drawBox.draw(canvas);
    });
  }, 100);
});
  