<?php
session_start();
if(isset($_SESSION['username'])){
?>
<html>
<body>
Hi, <?php echo $_SESSION['username']; ?> [<a href="logout.php">Logout</a>]
</body>
</html>
<?php
} else {
header("Location: login.php");
}
?>
