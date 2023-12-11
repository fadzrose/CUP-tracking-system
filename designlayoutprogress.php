<?php
require 'dbconnect.php';
$qpersonnels = query("SELECT * FROM personnel");
?>

<?php
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    // Process the form data here when the form is submitted
    $xprojid = $_GET['id']; // Retrieve the ID from the URL parameter

    $xprojstart = $_POST['DLstart'];
    $xprojdue = $_POST['DLdue'];
    $xapprovalstat = $_POST['DLstatus'];
    $xpercentage = $_POST['DLprogress'];
    $xcover = $_FILES['projectCover']['name'];
    $tempname = $_FILES['projectCover']['tmp_name'];
    $folder = "cover/" . $xcover;
    if (move_uploaded_file($tempname, $folder)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }


    //$xprojstart = $_POST['MRStartDate'];
    $xMRdue = $_POST['MRTargetDate'];
    $xMRdone = $_POST['MRActualDate'];

    $xCDstart = $_POST['CDStartDate'];
    $xCDdue = $_POST['CDTargetDate'];
    $xCDdone = $_POST['CDActualDate'];

    $xITstart = $_POST['ITStartDate'];
    $xITdue = $_POST['ITTargetDate'];
    $xITdone = $_POST['ITActualDate'];

    $xICstart = $_POST['ICStartDate'];
    $xICdue = $_POST['ICTargetDate'];
    $xICdone = $_POST['ICActualDate'];

    $xGLTstart = $_POST['GLTStartDate'];
    $xGLTdue = $_POST['GLTTargetDate'];
    $xGLTdone = $_POST['GLTActualDate'];

    $xGLCstart = $_POST['GLCStartDate'];
    $xGLCdue = $_POST['GLCTargetDate'];
    $xGLCdone = $_POST['GLCActualDate'];

    $xPCstart = $_POST['PCStartDate'];
    //$xprojdue = $_POST['PCTargetDate'];
    $xPCdone = $_POST['PCActualDate'];

    $xPDPstart = $_POST['PDPStartDate'];
    $xPDPdue = $_POST['PDPTargetDate'];
    $xPDPdone = $_POST['PDPActualDate'];

    $sqlinDL = "INSERT INTO `design_layout` (`designLayoutId`, `statusApproval`, `progressPercentage`, `projectCover`, `projectId`) VALUES ('', '$xapprovalstat', '$xpercentage', '$xcover', '$xprojid')";
    //echo "SQL query: " . $sqlupd; // Check the formed SQL query
    $sqlinMR = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'Manuscript Readiness', '$xprojstart', '$xMRdue','$xMRdone','', '$xprojid')";
    $sqlinCD = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'Concept Development', '$xCDstart', '$xCDdue','$xCDdone','', '$xprojid')";
    $sqlinIT = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'Illustration (Text)', '$xITstart', '$xITdue','$xITdone','', '$xprojid')";
    $sqlinIC = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'Illustration (Cover)', '$xICstart', '$xICdue','$xICdone','', '$xprojid')";
    $sqlinGLT = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'Graphic Layout (Text)', '$xGLTstart', '$xGLTdue','$xGLTdone','', '$xprojid')";
    $sqlinGLC = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'Graphic Layout (Cover)', '$xGLCstart', '$xGLCdue','$xGLCdone','', '$xprojid')";
    $sqlinPC = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'Proofing & Correction', '$xPCstart', '$xprojdue','$xPCdone','', '$xprojid')";
    $sqlinPDP = "INSERT INTO `dl_milestones` (`actionItemId`, `actionItem`, `startDate`, `targetDate`, `actualDate`, `status`, `projectId`) VALUES ('', 'PDP & ISBN Application', '$xPDPstart', '$xPDPdue','$xPDPdone','', '$xprojid')";


    $sqlQueries = [
        $sqlinDL, $sqlinMR, $sqlinCD, $sqlinIT, $sqlinIC,
        $sqlinGLT, $sqlinGLC, $sqlinPC, $sqlinPDP
    ];

    // Combine all queries into a single string separated by semicolons
    $combinedQueries = implode(';', $sqlQueries);

    // Execute multiple queries
    if (mysqli_multi_query($dbc, $combinedQueries)) {
        do {
            // Check each query result
            if ($result = mysqli_store_result($dbc)
            ) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($dbc));

        // All queries executed successfully
        echo '<script>alert("All queries executed successfully.");</script>';
        print '<script>window.location.assign("allprojectlist.php");</script>';
    } else {
        // At least one query failed
        echo "Warning: Failed to save. MySQL Error: " . mysqli_error($dbc);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Design & Layout</title>
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
            display: inline-block;
            /* or display: block; */
            width: auto;
            height: auto;
            max-width: 100%;
            margin: 1%;
            text-align: left;
            font-family: Arial, sans-serif;
            /* Updated font-family */
            padding: 20px;
            box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
            background: #ffe5ec;
        }


        .card-header {
            background-color: #f8f9fc;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 20px;
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

        input[type=number],
        select {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=date],
        select {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=file],
        select {

            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            align-items: center;

            box-sizing: border-box;
        }

        /* Styles for the select element */
        .css-dropdown select {
            width: 100%;
            padding: 10px 20px;
            margin: 1px 0;
            display: inline-block;
            border: 1px solid pink;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Styles for the options within the select element */
        .css-dropdown select option {
            background-color: pink;
            color: #333;
        }

        /* Style for selected option */
        .css-dropdown select option:checked {
            background-color: #ffe5ec;
            color: black;
        }

        /* The sidebar menu */
        .sidebar {
            height: 100%;
            /* 100% Full-height */
            width: 0;
            /* 0 width - change this with JavaScript */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Stay on top */
            top: 0;
            left: 0;
            background-color: pink;
            /* Black*/
            overflow-x: hidden;
            /* Disable horizontal scroll */
            padding-top: 50px;
            /* Place content 60px from the top */
            transition: 0.5s;
            /* 0.5 second transition effect to slide in the sidebar */
        }

        /* The sidebar links */
        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 17px;
            color: black;
            display: block;
            transition: 0.3s;
        }

        /* When you mouse over the navigation links, change their color */
        .sidebar a:hover {
            color: #f1f1f1;

        }

        /* Position and style the close button (top right corner) */
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* The button used to open the sidebar */
        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: pink;
            color: whitesmoke;
            padding: 10px 15px;
            border: none;
        }

        .openbtn:hover {
            background-color: #ff8fab;
        }

        /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
        #main {
            transition: margin-left .5s;
            /* If you want a transition effect */
            padding: 20px;
            padding-bottom: 80px;
            /* Sesuaikan dengan tinggi footer Anda */
        }


        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }

        th,
        td {
            padding: 15px;
            padding-top: 5px;
        }

        #preview {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
            border: 1px solid pink;
        }

        .preview-item {
            max-width: 200px;
            max-height: 200px;
        }

        .preview-item img {
            max-width: 100%;
            max-height: 100%;
            margin-left: 25%;

        }

        .container-cover {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 20px;
            margin: 20px;
            margin-top: 10px;
            border: 1px solid pink;
            width: 100%;
            height: 100%;
            border-radius: 4px;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            /* Add margin as needed */
        }

        .form-row label {
            margin-right: 10px;
            /* Adjust spacing between label and input */
        }
    </style>
</head>

<body style="background: #ffe5ec;">
    <div class="header" id="header">
        <div>

            <p align="left"><button class="openbtn" onclick="openNav()">&#9776; </button> Creative Unit Production System</p>
        </div>

    </div>


    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <br>
        <br>
        <br>
        <!-- Divider -->
        <hr class="hr hr-blurry" />
        <a href="manager_page.php">Dashboard</a>
        <!-- Divider -->
        <hr class="hr hr-blurry" />

        <a href="allprojectlist.php">Project</a>
        <a href="reportbyCategory.php">Report</a>
        <!-- Divider -->
        <hr class="hr hr-blurry" />

        <a href="#">Log out</a>
    </div>
    <br>
    <div class="container">
        <div id="main" class="card">
            <!-- Page Heading -->
            <div class="card-header">
                <h1 class="h3 mb-0 text-gray-800">
                    Design & Layout Progress
                </h1>
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="css-dropdown">
                <div class="card-body">
                    <table width="70%" align="center">
                        <col style="width:30%">
                        <col style="width:30%">
                        <col style="width:10%">
                        <tr>
                            <td><label for="DLstart">Starting Date</label>
                                <input type="date" class="form-control" id="DLstart" name="DLstart" />
                            </td>
                            <td><label for="DLdue">Due Date</label>
                                <input type="date" class="form-control" id="DLdue" name="DLdue" />
                            </td>
                            <td rowspan="3">
                                <br>
                                <label for="projectCover">Project Cover</label>
                                <div class="container-cover">
                                    <div id="preview"></div>
                                    <input type="file" id="fileInput" name="projectCover" multiple>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><label for="DLstatus">Approval Status</label>
                                <select class="form-control " id="DLstatus" name="DLstatus" required>
                                    <option value="" selected disabled>
                                        Please select the status
                                    </option>
                                    <option value="Not Yet Proposed">Not Yet Proposed</option>
                                    <option value="Pending Approval">Pending Approval</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2"><label for="DLprogress">Progress (%)</label>
                                <input type="number" class="form-control" id="DLprogress" name="DLprogress" min="0" max="100" />
                            </td>

                        </tr>


                    </table>

                    <hr class="hr hr-blurry" />
                    <!--divider-->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            Design & Layout Milestones
                        </h1>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <table width="80%" align="center">
                            <col style="width:50%">
                            <col style="width:10%">
                            <col style="width:10%">
                            <col style="width:10%">

                            <tr align=center>
                                <th>Action Items</th>
                                <th>Start Date</th>
                                <th>Target Date</th>
                                <th>Actual Date</th>

                            </tr>
                            <tr>
                            <tr>
                                <td colspan="5">
                                    <hr class="hr hr-blurry" />
                                    <!--divider-->
                                </td>
                            </tr>
                            <td>Manuscript Readiness</td>
                            <td><input type="date" class="form-control" id="MRStartDate" name="MRStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            <td><input type="date" class="form-control" id="MRTargetDate" name="MRTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            <td><input type="date" class="form-control" id="MRActualDate" name="MRActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>

                            <tr>
                                <td>Concept Development</td>
                                <td><input type="date" class="form-control" id="CDStartDate" name="CDStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="CDTargetDate" name="CDTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="CDActualDate" name="CDActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Illustration (Text)</td>
                                <td><input type="date" class="form-control" id="ITStartDate" name="ITStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="ITTargetDate" name="ITTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="ITActualDate" name="ITActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Illustration (Cover)</td>
                                <td><input type="date" class="form-control" id="ICStartDate" name="ICStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="ICTargetDate" name="ICTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="ICActualDate" name="ICActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Graphic Layout (Text)</td>
                                <td><input type="date" class="form-control" id="GLTStartDate" name="GLTStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="GLTTargetDate" name="GLTTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="GLTActualDate" name="GLTActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Graphic Layout (Cover)</td>
                                <td><input type="date" class="form-control" id="GLCStartDate" name="GLCStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="GLCTargetDate" name="GLCTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="GLCActualDate" name="GLCActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>
                            <tr>
                                <td>Proofing & Correction</td>
                                <td><input type="date" class="form-control" id="PCStartDate" name="PCStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="PCTargetDate" name="PCTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="PCActualDate" name="PCActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>
                            <tr>
                                <td>PDP & ISBN Application</td>
                                <td><input type="date" class="form-control" id="PDPStartDate" name="PDPStartDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="PDPTargetDate" name="PDPTargetDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                                <td><input type="date" class="form-control" id="PDPActualDate" name="PDPActualDate" min="<?php echo date('Y-m-d'); ?>" /></td>
                            </tr>
                        </table>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <br>
                    <hr class="hr hr-blurry" />
                </div>
            </form>

            <div id="footer" class="footer">
                <br>
                <p>Copyright &copy; 2023 Ana Muslim Sdn Bhd. All rightsreserved.</p>

            </div>
        </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function() {
            preview.innerHTML = ''; // Clear previous previews

            const files = this.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        const img = document.createElement('img');
                        img.classList.add('preview-item');
                        img.src = event.target.result;
                        preview.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                } else {
                    // Handle non-image files here
                    const p = document.createElement('p');
                    p.textContent = file.name + ' is not an image file.';
                    preview.appendChild(p);
                }
            }
        });
    </script>
    <script>
        /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
        function openNav() {
            document.getElementById("mySidebar").style.width = "200px";
            document.getElementById("main").style.marginLeft = "150px";
            document.getElementById("main").style.marginRight = "0px";
            document.getElementById("footer").style.marginLeft = "200px";
            document.getElementById("header").style.marginLeft = "200px";
        }

        /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "5%";
            document.getElementById("footer").style.marginLeft = "0";
            document.getElementById("header").style.marginLeft = "0";
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</body>

</html>