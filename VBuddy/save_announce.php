<?php
include("dbconn.php");

// Query the database to retrieve user data
$sql = "SELECT userID, name FROM user";
$result = mysqli_query($dbconn, $sql);

// If there is data in the result, then the code runs
if ($result && mysqli_num_rows($result) > 0) {
    ?>
    <html>
    <head>
        
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
            }

            h1 {
                color: #333;
                text-align: center;
            }

            .form-container {
                max-width: 500px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            textarea {
                width: 100%;
                resize: vertical;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
            }

            input[type="checkbox"] {
                margin-right: 5px;
            }

            input[type="submit"] {
                display: block;
                margin-top: 10px;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
    <div class="form-container">
        <h1>Send Announcement</h1>
        <form name="form" method="post" action="save_announce0.php">
            <textarea rows="10" cols="50" name="announce_to_other" placeholder="Enter your announcement here"></textarea>
            <br>
            <label>Send to:</label>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $userID = $row['userID'];
                $name = $row['name'];
                ?>
                <input type="checkbox" id="checkbox_<?php echo $userID; ?>" value="<?php echo $userID; ?>" name="userID[]" onchange="handleCheckboxChange(this)">
                <label for="checkbox_<?php echo $userID; ?>"><?php echo $name; ?></label>
                <?php
            }
            ?>
            <input type="submit" value="Submit" name="submit">

            <script>
                function handleCheckboxChange(checkbox) {
                    // Get all checkboxes with the same name attribute
                    var checkboxes = document.getElementsByName(checkbox.name);

                    // Iterate over the checkboxes
                    for (var i = 0; i < checkboxes.length; i++) {
                        // Uncheck checkboxes except for the current one
                        if (checkboxes[i] !== checkbox) {
                            checkboxes[i].checked = false;
                        }
                    }
                }
            </script>
        </form>
    </div>

    </body>
    </html>
    <?php
} else {
    echo "No user data found.";
}

// Close the database connection
mysqli_close($dbconn);
?>
