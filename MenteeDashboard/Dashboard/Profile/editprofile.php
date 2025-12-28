<?php
include 'C:\xampp\htdocs\MainVbuddy\MentorDashboard\Dashboard\dbconn.php';
?>

<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query the database to retrieve user data
    $sql = "SELECT userID, username, name, age, email, address, phone_number, gender FROM user WHERE username = '$username'";
    $result = mysqli_query($dbconn, $sql);

    // If there is data in the result, then the code runs
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];
        $name = $row['name'];
        $age = $row['age'];
        $email = $row['email'];
        $address = $row['address'];
        $phoneNumber = $row['phone_number'];
        $gender = $row['gender'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile</title>
    <link rel="shortcut icon" href="images/university.png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="https://kit.fontawesome.com/2b25f4f529.js" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>

    <style>
        header {
            position: relative;
        }

        .edit-profile-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 90vh;
        }

        .edit-profile-container form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: var(--border-radius-2);
            padding: 3.5rem;
            background-color: var(--color-white);
            box-shadow: var(--box-shadow);
            width: 95%;
            max-width: 32rem;
        }

        .edit-profile-container form:hover {
            box-shadow: none;
        }

        .edit-profile-container form input[type="text"],
        .edit-profile-container form input[type="email"],
        .edit-profile-container form input[type="tel"] {
            border: none;
            outline: none;
            border: 1px solid var(--color-light);
            background: transparent;
            height: 2rem;
            width: 100%;
            padding: 0 0.5rem;
        }

        .edit-profile-container form .box {
            padding: 0.5rem 0;
        }

        .edit-profile-container form .box p {
            line-height: 2;
        }

        .btn {
            background: none;
            border: none;
            border: 2px solid var(--color-primary) !important;
            border-radius: var(--border-radius-1);
            padding: 0.5rem 1rem;
            color: var(--color-white);
            background-color: var(--color-primary);
            cursor: pointer;
            margin: 1rem 1.5rem 1rem 0;
            margin-top: 1.5rem;
        }

        .btn:hover {
            color: var(--color-primary);
            background-color: transparent;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo" title="Admin Dashboard">
      <a rel="noopener" href="../indexmenteedash.php">
        <img src="images/university.png" alt="" />
      </a
            <a href="../indexmenteedash.php">
                <h2>Mentee Dashboard</h2>
            </a>
        </div>

        <div class="navbar">
            <div class="navbar">
                <a href="../indexmenteedash.php">
                    <span class="material-icons-sharp" onclick="">logout</span>
                    <h3 style="font-size:10px">Back</h3>
                </a>
            </div>
            <div id="profile-btn" style="display: none;">
                <span class="material-icons-sharp">person</span>
            </div>
            <div class="theme-toggler">
                <span class="material-icons-sharp active">light_mode</span>
                <span class="material-icons-sharp">dark_mode</span>
            </div>
        </div>
    </header>

    <div class="edit-profile-container">
        <form method="POST" action="update_profile.php">
            <h2><b>Edit Profile</b></h2>
            <div class="box">
				<p>Name: <input type="text" name="name" value="<?php echo $name; ?>"></p>
			</div>
			<div class="box">
				<p>Username: <input type="text" name="username" value="<?php echo $username; ?>"></p>
			</div>
			<div class="box">
				<p>Age: <input type="text" name="age" value="<?php echo $age; ?>" ></p>

			</div>
			<div class="box">
				<p>Email: <input type="email" name="email" value="<?php echo $email; ?>"></p>
			</div>
			<div class="box">
				<p>Address: <input type="text" name="address" value="<?php echo $address; ?>"></p>
			</div>
			<div class="box">
				<p>Phone Number: <input type="tel" name="phoneNumber" value="<?php echo $phoneNumber; ?>"></p>
			</div>
			<div class="box">
				<p>Gender: <input type="text" name="gender" value="<?php echo $gender; ?>" readonly style="background-color: lightgray;"></p>
			</div>

            <div class="button">
                <input type="submit" value="Save" name="submit" class="btn" />
                <a href="../indexmenteedash.php" class="text-muted">Cancel</a>
            </div>
        </form>
    </div>
</body>

<script src="app.js"></script>

</html>

<?php
    } else {
        echo "No user data found.";
    }
} else {
    echo "Session username not set.";
}

// Close the database connection
mysqli_close($dbconn);
?>
