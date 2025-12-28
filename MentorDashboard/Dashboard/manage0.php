<?php
session_start();

/* Include the db connection file */
include("dbconn.php");

// If user is logged in successfully, all data from username will be displayed in indexmenteedash.php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}

// If submit button is clicked
if (isset($_POST['submit'])) {
    // Get form data
    $topicid = $_POST['topic_id'];
    $date = $_POST['date'];
    $tname = $_POST['topic_name'];
    $tdesc = $_POST['description'];
    $platform = $_POST['platform'];
    $link = $_POST['link'];

    // Handling pdf file
    if (isset($_FILES['pdf_file']['name'])) {
        // If the 'pdf_file' field has an attachment
        $file_name = $_FILES['pdf_file']['name'];
        $file_tmp = $_FILES['pdf_file']['tmp_name'];

        // Move the uploaded pdf file into the pdf folder
        move_uploaded_file($file_tmp, "./pdf/" . $file_name);

        // Insert the submitted data from the form into the topic table
        $insertquery = "INSERT INTO topic (TOPICID, TOPIC, DATE, PLATFORM, LINK_MEETING, ATTACHMENT, DESCRIPTION, ASSIGNID) VALUES ('$topicid', '$tname', '$date', '$platform', '$link', '$file_name', '$tdesc', (SELECT ASSIGNID FROM assign WHERE MENTORID = (SELECT USERID FROM user WHERE USERNAME = '$username')))";

        // Execute insert query
        $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
        $iquery = mysqli_query($dbconn, $insertquery);

        // Check if insertion into topic table was successful
        if ($iquery) {
            ?>
			<?php
            echo "<script>alert('Succesfully!, Class is created succsfully :)');window.location.href = 'topic.php';</script>";
            ?>
			<?php
        } else {
            ?>
			
			<?php
            echo "<script>alert('Failed!, failed to submit the data, please try again later');window.location.href = 'topic.php';</script>";
			?>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible fade show text-center">
            <a class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Failed!</strong> File must be uploaded in PDF format!
        </div>
        <?php
    }
}
?>

<!-- Redirect to the topic page -->
<script>
    window.location.href = 'topic.php';
</script>