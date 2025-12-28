<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('fpdf/fpdf.php');

// Create new PDF document
$pdf = new FPDF('P', 'mm', 'A4', true, 'UTF-8');

// Set document information
$pdf->SetCreator('Your Creator');
$pdf->SetAuthor('Your Author');
$pdf->SetTitle('Attendance Report');
$pdf->SetSubject('Attendance Report');
$pdf->SetKeywords('Attendance, Report');

// Set default font
$pdf->SetFont('helvetica', '', 12);

// Add a page
$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Times', 'B', 15);
$pdf->Cell(0, 8, 'Vbuddy Mentorship System', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 13);
$pdf->Cell(0, 8, 'Attendance Report', 0, 1, 'C');

// Add a line
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Line(20, $pdf->GetY() + 5, 190, $pdf->GetY() + 5);

$pdf->Ln(9);

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'vbuddy';

// Create a new MySQLi instance
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch additional details from the database
$topicid = isset($_GET['topicid']) ? $_GET['topicid'] : '';
$assignid = isset($_GET['assignid']) ? $_GET['assignid'] : '';
$menteeid = isset($_GET['menteeid']) ? $_GET['menteeid'] : '';

$query = "SELECT A.ASSIGNID, A.MENTEEID, U.NAME AS MENTEE_NAME, A.DATEATTEND, A.ATTENDSTATUS, T.TOPIC,
          B.MENTORID, T.TOPICID, M.NAME AS MENTOR_NAME
          FROM ATTENDANCE A
          INNER JOIN ASSIGN B ON A.ASSIGNID = B.ASSIGNID
          INNER JOIN USER U ON A.MENTEEID = U.USERID
          INNER JOIN USER M ON B.MENTORID = M.USERID
          INNER JOIN TOPIC T ON A.TOPICID = T.TOPICID
          WHERE A.topicid = '$topicid'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);

if ($row) {
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->Cell(10, 5, 'Assign ID: ' . $row['ASSIGNID'], 0, 1, 'L');
    $pdf->Cell(10, 5, 'Mentor ID: ' . $row['MENTORID'], 0, 1, 'L');
    $pdf->Cell(10, 5, 'Name of Mentor: ' . $row['MENTOR_NAME'], 0, 1, 'L');
    $pdf->Cell(10, 5, 'Topic: ' . $row['TOPIC'], 0, 1, 'L');
    $pdf->Cell(10, 5, 'Date Attend: ' . $row['DATEATTEND'], 0, 1, 'L');

    $pdf->Ln(5);

    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->Cell(30, 10, 'Assign ID', 0, 0, 'C');
    $pdf->Cell(30, 10, 'Mentee ID', 0, 0, 'C');
    $pdf->Cell(75, 10, 'Name of Mentee', 0, 0, 'C');
    $pdf->Cell(28, 10, 'Date Attend', 0, 0, 'C');
    $pdf->Cell(25, 10, 'Attend Status', 0, 1, 'C');

    $query = "SELECT A.ASSIGNID, A.MENTEEID, U.NAME AS MENTEE_NAME, A.DATEATTEND, A.ATTENDSTATUS
              FROM ATTENDANCE A
              INNER JOIN USER U ON A.MENTEEID = U.USERID
              WHERE A.ASSIGNID = '{$row['ASSIGNID']}' AND A.TOPICID = '{$row['TOPICID']}'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($result)) {
        $pdf->SetFont('helvetica', '', 9);
        $pdf->Cell(30, 10, $row['ASSIGNID'], 0, 0, 'C');
        $pdf->Cell(30, 10, $row['MENTEEID'], 0, 0, 'C');
        $pdf->Cell(75, 10, $row['MENTEE_NAME'], 0, 0, 'C');
        $pdf->Cell(28, 10, $row['DATEATTEND'], 0, 0, 'C');
        $pdf->Cell(25, 10, $row['ATTENDSTATUS'], 0, 1, 'C');
    }
} else {
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(0, 10, 'No attendance records found.', 0, 1, 'C');
}

$conn->close();


// Output the PDF as a download
$pdf->Output('attendance_report.pdf', 'D');
?>
