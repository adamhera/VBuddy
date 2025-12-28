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
        /* Your existing styles here */

        /* Custom styles for the square container */
        .square-container {
            position: relative;
            width: 500px;
            height: 500px;
            border: 1px solid var(--color-light);
            border-radius: 10px;
            margin: 0 auto;
            background-color: var(--color-white);
        }

        /* Custom styles for the clock */
        .clock {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: bold;
            color: var(--color-primary);
        }
    </style>
</head>

<body>
    <div class="edit-profile-container">
        <form>
            <!-- Your form content here -->
        </form>
    </div>

      <div class="container-center"> <!-- Added a container to center the .square-container -->
        <div class="square-container">
            <div class="clock">
                <p>Sorry, your enrollment registration is still in process. Please log in back after 2-3 days.</p>
    <br/>
                <div class="button">
                    <a href="index.html" class="text-muted">Go to Home Page</a>
                </div>
            </div>
        </div>
    </div>

    
  

    <script src="app.js"></script>
</body>

</html>

<style>
    /* Your existing styles here */

    /* Custom styles for the square container */
    .container-center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Set the height to 100vh to center vertically */
    }

    .square-container {
        position: relative;
        width: 500px;
        height: 500px;
        border: 1px solid var(--color-light);
        border-radius: 10px;
        background-color: var(--color-white);
    }

    /* Custom styles for the clock */
    .clock {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: var(--color-primary);
    }
</style>