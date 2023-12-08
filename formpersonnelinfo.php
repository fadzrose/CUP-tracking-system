<?php
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    // Process the form data here when the form is submitted
    $xidMem = $_GET['id']; // Retrieve the ID from the URL parameter

    $xname = $_POST['psName'];
    $xposition = $_POST['psPosition'];
    $xphone = $_POST['psPhone'];

    $sqlupd = "UPDATE `personnel` SET `name` = '$xname' , `position` = '$xposition', `phone` = '$xphone' WHERE  `personnelId` = '$xidMem';";
    //echo "SQL query: " . $sqlupd; // Check the formed SQL query

    $result = mysqli_query($dbc, $sqlupd); // $connection is your database connection object

    if (!$result) {
        // Handle the query error
        echo "Warning: Failed to save. MySQL Error: " . mysqli_error($dbc);
    } else {
        // Query executed successfully
        echo '<script>alert("Personnel details have been saved");</script>';
        print '<script>window.location.assign("loginpage.php");</script>';
    }
   
}
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Password Form with Visible Icon Button</title>
    <style>
        .password-container {
            position: relative;
        }

        .password-input {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .button {

            border: 2px solid #ff8fab;

            transition-duration: 0.4s;
        }

        .button:hover {
            background-color: #04AA6D;

            color: white;
        }

        .header {
            padding: 10px;
            text-align: center;
            background: #ff8fab;
            color: black;
            font-size: 30px;

        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #ff8fab;
            color: white;
            text-align: center;
        }

        .card {

            max-width: 500px;
            margin: auto;
            text-align: center;
            font-family: arial;
            padding: 20px;
            box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
            background: #ffe5ec
        }

        input[type=email] {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=password],
        select {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=text],
        select {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Styles for the select element */
        #mySelect {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Styles for the options within the select element */
        #mySelect option {
            background-color: pink;
            color: #333;
        }

        /* Style for selected option */
        #mySelect option:checked {
            background-color: #ffe5ec;
            color: black;
        }
    </style>
</head>

<body style="background: #ffe5ec;">
    <div class="header">

        <p>Creative Unit Production System</p>
    </div>
    <br>

    <div class="container-fluid card" align="center" style="background-color: #f9ccd5;">
        <div style="width: 30rem;">
            <div class="card-body ">

                <h5 class="card-title" style="background:#ff8fab; border: 1px solid #ffe5ec;
            border-radius: 4px; padding: 10px 20px;">Personnel Details</h5>

                <p class="card-text">
                <form align="center" action="" method="post" class="form">
                    <div>
                        <label for="psName">Name : </label>
                        <input type="text" id="psName" name="psName" class="form-control " placeholder="Enter Name" required>
                        <label for="mySelect"><br>Position : </label>

                        <select class="custom-select" id="mySelect" name="psPosition">
                            <option value="" selected disabled>
                                Please select the position
                            </option>
                            <option value="Administrator">Administrator</option>
                            <option value="Manager">Manager</option>
                            <option value="Editor">Editor</option>
                            <option value="Graphic Designer">Graphic Designer</option>
                            <option value="Illustrator">Illustrator</option>


                        </select>

                        <label for="psPhone"><br>Phone Number : </label>
                        <input type="text" id="psPhone" name="psPhone" class="form-control " placeholder="Enter Phone Number" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-light">Submit</button>
                </form>

                </p>
            </div>
        </div>
    </div>

    <div class="footer">
        <br>
        <p>Copyright &copy; 2023 Ana Muslim Sdn Bhd. All rightsreserved.</p>

    </div>

    <script>

    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</body>

</html>