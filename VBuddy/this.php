<?php
// Start session management
session_start();

// Include database connection
include("dbconn.php");

// Handling form submission and image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directory to store uploaded images
    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    // $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
    // if ($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }

    // Check file size (limit to 2MB)
    // if ($_FILES["profilePicture"]["size"] > 2000000) {
    //     echo "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    // Allow only specific file formats
    // if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    //     echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
    //     $uploadOk = 0;
    // }

    // Upload file if no errors
    // if ($uploadOk == 1) {
    //     if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
    //         echo "The file " . htmlspecialchars(basename($_FILES["profilePicture"]["name"])) . " has been uploaded.";
    //         // Save $target_file to database linked to student record
    //     } else {
    //         echo "Sorry, there was an error uploading your file.";
    //     }
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentee Registration</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <style>
        html, body {
            min-height: 100%;
            padding: 0;
            margin: 0;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
        }
        h1 {
            margin: 0 0 20px;
            font-weight: 400;
            color: #946750;
        }

        .hidden {
            display: none;
        }
        .main-block {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url(assets/img/gallery/menteebg.jpg);
            background-position: left;
            background-repeat: no-repeat;
        }
        form {
            padding: 25px;
            margin: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: #f5f5f5;
            border-radius: 30px;
        }
        input, textarea {
            width: calc(100% - 18px);
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #946750;
            outline: none;
        }
        input::placeholder {
            color: #946750;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            background: #946750;
            font-size: 16px;
            color: #fff;
        }
        button:hover {
            background: #77483E;
        }

        #videoDiv {
            width: 600px;
            height: 450px;
            position: relative; /* Ensure the container properly contains the video */
            overflow: hidden;   /* Prevent overflow */
            margin: auto;       /* Center if needed */
        }

        #video {
            width: 100%;        /* Ensure the video stays within the parent dimensions */
            height: 100%;
            position: relative; /* Stay within the container */
        }
        @media (min-width: 568px) {
            .main-block {
                flex-direction: row;
            }
            .left-part, form {
                width: 50%;
            }
        }
    </style>
        <script defer src="face-api.min.js"></script>
        <script defer src="script.js"></script>
</head>
<body>
    <div class="main-block">
        <div class="left-part"></div>
        <form method="POST" action="this0.php" enctype="multipart/form-data">
            <h1>Mentee Registration</h1>
            <div class="info">
                <input type="text" name="name" id="name" placeholder="Username" required>
                <input type="text" name="studID" id="studID" placeholder="Student ID" required>
                <select name="courseid" id="courseid" style="height: 30px; width: 150px;">
                    <?php
                    // Establish database connection
                    $conn = new mysqli('localhost', 'root', '', 'vbuddy');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Retrieve unique courseid from the database and populate the dropdown
                    $query = "SELECT DISTINCT courseid FROM course";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $courseid = $row['courseid'];
                            echo "<option value='$courseid'>$courseid</option>";
                        }
                    } else {
                        echo "<option value=''>No course found</option>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </select>
            </div>
            <br/>
            <p>Result</p>
            <div>
                <input type="text" name="semester" id="semester" placeholder="Current Semester" required>
                <input type="text" name="GPA" id="GPA" placeholder="GPA" required>
                <input type="text" name="CGPA" id="CGPA" placeholder="CGPA" required>
            </div>
            <p>Optional:</p>
            <div>
                <input type="text" name="remarks" id="remarks" placeholder="Why do you want to be a mentee">
            </div>
            <div>
                <label for="profilePicture">Upload Profile Picture:</label>
                <input type="file" name="profilePicture" id="profilePicture" accept="image/*" required>
                <div class="button-box">
                    <button class="camera-button" onclick="openCamera(event);">
                    Capture Images
                    </button>
                    <div id="videoDiv" class="hidden">
                        <video id="video" width="400" height="400" autoplay></video>
                    </div>
                        <input type="hidden" id="capturedImage1" name="capturedImage1">
                        <img id="displayImage1" alt="Captured Image 1">
                        <input type="hidden" id="capturedImage2" name="capturedImage2">
                        <img id="displayImage2" alt="Captured Image 2">
                </div>
            </div>
            <div class="button-container">
                <button type="submit" name="submit">SUBMIT</button>
                <a href="bforedash.html" style="width: 100%;"><button type="button" name="cancel">CANCEL</button></a> 
            </div>
        </form>
    </div>

    <!-- <script defer src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
    <script>
        async function processImage() {
            const input = document.getElementById('profilePicture');
            const img = await faceapi.bufferToImage(input.files[0]);
            const fullFaceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();

            if (fullFaceDescription) {
                const descriptor = Array.from(fullFaceDescription.descriptor);
                // Send this descriptor to the server to save in the student profile
            }
        }

        document.getElementById('profilePicture').addEventListener('change', processImage);
    </script> -->
</body>
</html>