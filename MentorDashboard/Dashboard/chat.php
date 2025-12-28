<?php

session_start();
include("dbconn.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/university.png" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">
body {
  margin: 0;
  padding: 0;
  background-color: #f4f7f6;
  margin-top: 0;
}


.card {
    background: #fff;
    transition: .5s;
    border: 0;
    margin-bottom: 30px;
    border-radius: .55rem;
    position: relative;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
}
.chat-app .people-list {
    width: 280px;
    position: absolute;
    left: 0;
    top: 0;
    padding: 20px;
    z-index: 7
}

.chat-app .chat {
   
    border-left: 1px solid #eaeaea
}

.people-list {
    -moz-transition: .5s;
    -o-transition: .5s;
    -webkit-transition: .5s;
    transition: .5s
}

.people-list .chat-list li {
    padding: 10px 15px;
    list-style: none;
    border-radius: 3px
}

.people-list .chat-list li:hover {
    background: #efefef;
    cursor: pointer
}

.people-list .chat-list li.active {
    background: #efefef
}

.people-list .chat-list li .name {
    font-size: 15px
}

.people-list .chat-list img {
    width: 45px;
    border-radius: 50%
}

.people-list img {
    float: left;
    border-radius: 50%
}

.people-list .about {
    float: left;
    padding-left: 8px
}

.people-list .status {
    color: #999;
    font-size: 13px
}

.chat .chat-header {
    padding: 15px 20px;
    border-bottom: 2px solid #f4f7f6
}

.chat .chat-header img {
    float: left;
    border-radius: 40px;
    width: 40px
}

.chat .chat-header .chat-about {
    float: left;
    padding-left: 10px
}

.chat .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff
}

.chat .chat-history ul {
    padding: 0
}

.chat .chat-history ul li {
    list-style: none;
    margin-bottom: 30px
}

.chat .chat-history ul li:last-child {
    margin-bottom: 0px
}

.chat .chat-history .message-data {
    margin-bottom: 15px
}

.chat .chat-history .message-data img {
    border-radius: 40px;
    width: 40px
}

.chat .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px
}

.chat .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative
}

.chat .chat-history .message:after {
    bottom: 100%;
    left: 7%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .my-message {
    background: #efefef
}

.chat .chat-history .my-message:after {
    bottom: 100%;
    left: 30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #efefef;
    border-width: 10px;
    margin-left: -10px
}

.chat .chat-history .other-message {
    background: #e8f1f3;
    text-align: right
}

.chat .chat-history .other-message:after {
    border-bottom-color: #e8f1f3;
    left: 93%
}

.chat .chat-message {
    padding: 20px
}

.online,
.offline,
.me {
    margin-right: 2px;
    font-size: 8px;
    vertical-align: middle
}

.online {
    color: #86c541
}

.offline {
    color: #e47297
}

.me {
    color: #1d8ecd
}

.float-right {
    float: right
}

.clearfix:after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0
}

@media only screen and (max-width: 767px) {
    .chat-app .people-list {
        height: 465px;
        width: 100%;
        overflow-x: auto;
        background: #fff;
        left: -400px;
        display: none
    }
    .chat-app .people-list.open {
        left: 0
    }
    .chat-app .chat {
        margin: 0
    }
    .chat-app .chat .chat-header {
        border-radius: 0.55rem 0.55rem 0 0
    }
    .chat-app .chat-history {
        height: 300px;
        overflow-x: auto
    }
}

@media only screen and (min-width: 768px) and (max-width: 992px) {
    .chat-app .chat-list {
        height: 650px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: 600px;
        overflow-x: auto
    }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
    .chat-app .chat-list {
        height: 480px;
        overflow-x: auto
    }
    .chat-app .chat-history {
        height: calc(100vh - 350px);
        overflow-x: auto
    }
}



    </style>

</head>

<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">V-Buddy Chat App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="discussion.php">
            <i class="fas fa-arrow-left"></i> Back
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="indexmentodash.php">
            <i class="fas fa-home"></i> Home
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<?php

if (isset($_GET['topicid']) && isset($_GET['userid']) && isset($_GET['groupid'])) {
  $userid = $_GET['userid'];
  $topicid =  $_GET['topicid'];
  $group=$_GET['groupid'];

  $query = "SELECT a.TOPICID,a.MEMBERID,a.CONTENT,a.TIME,a.ATTACHMENT,b.TOPICID,b.TOPIC,b.DATE,b.PLATFORM,b.LINK_MEETING,b.DESCRIPTION,b.ASSIGNID FROM discuss a JOIN topic b WHERE MEMBERID = '$userid' AND a.TOPICID='$topicid' Group by DISCUSSID ORDER BY TIME ASC ";
  $result = mysqli_query($dbconn, $query);
  $userRow = mysqli_fetch_array($result);

  
  if($userRow==null){
    echo "Dont be shy,start the chat first!!";
    $chatactivator=0;
    echo $chatactivator;
  }
  else {


  $memberid = $userRow['MEMBERID'];
  $topicid = $userRow['TOPICID'];
 

$chatactivator="chat is now active !";
 echo $chatactivator; 
}
 }
?>

<?php
if (isset($_GET['topicid']) && isset($_GET['userid'])) {
  $userid=$_GET['userid'];
  $topicid=$_GET['topicid'];
  $newquery = "SELECT a.*,b.USERNAME FROM discuss a JOIN user b WHERE MEMBERID != '$userid' AND TOPICID='$topicid' AND b.USERID=a.MEMBERID ORDER BY TIME ASC ";
  $newresult = mysqli_query($dbconn, $newquery);
  $newuserRow = mysqli_fetch_array($newresult);

}
?>




<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container">
<div class="row clearfix">
<div class="col-lg-12">
<div class="card chat-app">
<div class="chat">
<div class="chat-header clearfix">
<div class="row">
<div class="col-lg-6">
    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
    </a>
    <div class="chat-about">
        <h6 class="m-b-0">Group:  <?php echo $group; ?></h6>
        <small>Group topic: <?php echo $topicid; ?></small>
    </div>
</div>

</div>
</div>
<!--your chat-->
<div class="chat-history">
    <ul class="m-b-0">
        <?php
        mysqli_data_seek($result, 0); // Reset the internal pointer to the beginning
        mysqli_data_seek($newresult, 0); // Reset the internal pointer to the beginning
        
        // Fetch the first row from each result set
        $userRow = mysqli_fetch_array($result);
        $newuserRow = mysqli_fetch_array($newresult);
        
        // Loop until there are no more rows in both result sets
        while ($userRow !== null || $newuserRow !== null) {
            // Compare the timestamps to determine which message should be displayed first
            if ($userRow !== null && ($newuserRow === null || $userRow['TIME'] < $newuserRow['TIME'])) {
                $studentID = $userRow['CONTENT'];
                $timestamp = $userRow['TIME'];
                $file=$userRow['ATTACHMENT'];
             
                if($file==null){  echo '<li class="clearfix">
                    <div class="message-data text-right">
                        <span class="message-data-time">' . $timestamp . '</span>
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                    </div>
                    <div class="message other-message float-right">' . $studentID . '</div>
                </li>';}
                else{  echo '<li class="clearfix">
                    <div class="message-data text-right">
                        <span class="message-data-time">' . $timestamp . '</span>
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                    </div>
                    <div class="message other-message float-right">' . $studentID . '</div>
                     <div class="message other-message float-right">Sent attachment: ' . $file . '<a href="download.php?filename=' . urlencode($file) . ' "><p>   Download</p></a></div>
                </li>';
            }
                
            
                
                $userRow = mysqli_fetch_array($result);
            } else {
                $newstudentID = $newuserRow['CONTENT'];
                $newtimestamp = $newuserRow['TIME'];
                $newname = $newuserRow['USERNAME'];
                 $newfile = $newuserRow['ATTACHMENT'];



                   if($newfile==null){  echo '<li class="clearfix">
                    <div class="message-data">
                        <span class="message-data-time">FROM: ' . $newname . '</span>
                    </div>
                    <div class="message-data">
                        <span class="message-data-time">' . $newtimestamp . '</span>
                    </div>
                    <div class="message my-message">' . $newstudentID . '</div>
                  
                </li>';}
                else{  echo '<li class="clearfix">
                    <div class="message-data">
                        <span class="message-data-time">FROM: ' . $newname . '</span>
                    </div>
                    <div class="message-data">
                        <span class="message-data-time">' . $newtimestamp . '</span>
                    </div>
                    <div class="message my-message">' . $newstudentID . '</div>
                  
                     <div class="message my-message">ATTACHMENT:' . $newfile . '<a href="download.php?filename=' . urlencode($newfile) . '"><p>Download</p></a></div>
                </li>';
            }
              
                
                $newuserRow = mysqli_fetch_array($newresult); // Move to the next row in the second result set
            }
        }
        echo '<script>window.scrollTo(0, document.body.scrollHeight);</script>';

        ?>
        <button onclick="goToTop()" style="position: fixed; bottom: 20px; right: 20px;">Go to Top</button>

    </ul>
</div>
<div class="chat-message clearfix">
 <form method="POST" action="chat0.php?topicid=<?php echo $topicid; ?>&memberid=<?php echo $userid; ?>&groupid=<?php echo $group; ?>" enctype="multipart/form-data">
  <div class="input-group mb-0">
    <div class="input-group-prepend">
      <button type="submit" name="submit" id="submit-button" class="btn btn-primary">
        <i class="fa fa-send"></i>
      </button>
    </div>

    <div class="input-group-prepend">
      <label for="fileInput" class="btn btn-outline-secondary input-group-text">
      <input type="file" name="pdf_file" class="form-control" accept=".pdf" />   </i>
      </label>
    </div>

    <input type="file" id="fileInput" style="display: none;" />
    <input type="text" class="form-control" name="content" id="content" style="height:53px" placeholder="Enter text here...">
  </div>
</form>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">	
</script>
<script>
function goToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
</body>
</html>