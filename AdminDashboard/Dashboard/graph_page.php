<?php 
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Graph Page</title>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Activites Report</title>
    <link rel="shortcut icon" href="images/dashboard.png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <style>
    header {
      position: relative;
    }

    .exam {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      height: auto;
      width: 85%;
      margin: auto;
    }
		
    .chart-container {
      width: 600px;
      height: 300px;
      margin: 20px auto;
    }
	
  </style>
</head>

<!-- Header for Admin Dashboard (nav button) -->
<body>
 <header>
    <div class="logo" title="Student Dashboard">
      <a rel="noopener" href="index.html">
        <img src="images/dashboard.png" alt="" />
      </a>
	  
	   
      <a href="index.html">
        <h2 style= font-size:18px>Admin Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
	  <a href="Report.php">
        <span class="material-icons-sharp" onclick="">logout</span>
        <h3  style= font-size:10px>Back</h3>
      </a>
	  
      <a href="index2.php">
        <span class="material-icons-sharp">home</span>
        <h3  style= font-size:10px>Home</h3>
      </a>
    </div>
        <div id="profile-btn" style="display: none;">
            <span class="material-icons-sharp">person</span>
        </div>
        <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>
    </header>
  

<main>
    <h2><center>Graph of Class Created for Group by Months</center></h2>

    <div class="chart-container">
      <canvas id="topicChart"></canvas>
    </div>

    <?php
    // Retrieve the query parameters from the URL
    $assignid = $_GET['assignid'];
    $mentorid = $_GET['mentorid'];
    $mentor_name = $_GET['mentor_name'];

    // Database connection details
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'vbuddy';

    // Create a new MySQLi instance
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch topic data for the assign ID and month from the database
    $query = "SELECT DATE_FORMAT(date, '%M') AS month, COUNT(*) AS topic_count FROM topic WHERE assignid = '$assignid' GROUP BY month";
    $result = $conn->query($query);

    // Prepare an array to store the data points
    $dataPoints = array();

    // Fetch and store the data points
    while ($row = $result->fetch_assoc()) {
      $dataPoints[] = array(
        'month' => $row['month'],
        'count' => (int)$row['topic_count']
      );
    }

    // Convert the data to JSON format for JavaScript usage
    $dataPointsJSON = json_encode($dataPoints);

    // Close the database connection
    $conn->close();
    ?>

    <script>
      // Retrieve the data points from PHP and parse them
      var dataPoints = <?php echo $dataPointsJSON; ?>;

      // Extract the month and count data into separate arrays
      var months = [];
      var counts = [];
      dataPoints.forEach(function(dataPoint) {
        months.push(dataPoint.month);
        counts.push(dataPoint.count);
      });

      // Define an array of colors for the bar chart
      var colors = ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(255, 205, 86, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)', 'rgba(201, 203, 207, 0.5)'];

      // Create a chart using Chart.js
      var ctx = document.getElementById('topicChart').getContext('2d');
     var topicChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: months,
    datasets: [{
      label: 'Topics by Month',
      data: counts,
      backgroundColor: colors.slice(0, months.length),
      borderColor: colors.slice(0, months.length),
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        suggestedMax: 10,
        ticks: {
          stepSize: 1
        }
      }
    },
    plugins: {
      legend: {
        display: true,
        labels: {
          generateLabels: function(chart) {
            var data = chart.data;
            if (data.labels.length && data.datasets.length) {
              return data.labels.map(function(label, i) {
                var dataset = data.datasets[0];
                var backgroundColor = dataset.backgroundColor[i];
                var borderColor = dataset.borderColor[i];
                var borderWidth = dataset.borderWidth;

                return {
                  text: label,
                  fillStyle: backgroundColor,
                  strokeStyle: borderColor,
                  lineWidth: borderWidth,
                  hidden: false,
                  index: i
                };
              });
            }
            return [];
          }
        }
      }
    }
  }
});

    </script>


<div class="exam timetable">

<h2>List of Group, Mentor, and Mentee</h2>
		  <span class="closeBtn" onclick="timeTableAll()">X</span>
	
<?php
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';

// Retrieve the user ID from the query parameter
if (isset($_GET['assignid'])) {
  $assignid = $_GET['assignid'];

  // Retrieve the feedback information from the database
  $query = "SELECT topicid, topic, date, platform, attachment, description FROM topic 
            WHERE assignid = '$assignid'
            ORDER BY date ASC";

  $result = mysqli_query($conn, $query);

  // Display the feedback information
  if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Topic ID</th>";
    echo "<th>Topic</th>";
    echo "<th>Date</th>";
    echo "<th>Platform</th>";
    echo "<th>Attachment</th>";
    echo "<th>Description</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_array($result)) {	
      echo "<tr>";
      echo "<td>" . $row['topicid'] . "</td>";
      echo "<td>" . $row['topic'] . "</td>";
      echo "<td>" . $row['date'] . "</td>";
      echo "<td>" . $row['platform'] . "</td>";
      echo "<td>" . $row['attachment'] . "</td>";
      echo "<td>" . $row['description'] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No data found.";
  }
} else {
  echo "Invalid request.";
}
?>


  </div>
</main
</body>
<script src="app.js"></script>

</html>
