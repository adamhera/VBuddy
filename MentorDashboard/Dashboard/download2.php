<?php
session_start();
include("dbconn.php");

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}

// Retrieve the filename from the URL parameter
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    // Path to the PDF file
    $file = 'pdf/' . $filename; // Assuming the PDF files are stored in the 'pdf' folder

    // Set the headers to indicate the file type and force the download
    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');

    // Read the file and output its content
    readfile($file);
} else {
    // Handle the case when the filename parameter is not provided
    echo "File not found.";
}
?>