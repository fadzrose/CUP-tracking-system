<?php
set_time_limit(300); // Set maximum execution time to 300 seconds (5 minutes)

include 'dbconnect.php';

$xprojId = $_GET['id'];

$listprog = "SELECT * FROM `design_layout` WHERE `projectId`='$xprojId'";
$result_prog = mysqli_query($dbc, $listprog);
$row = mysqli_fetch_assoc($result_prog);

$listms = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId'";
$result_ms = mysqli_query($dbc, $listms);
$row2 = mysqli_fetch_assoc($result_ms);

if ($row2) {
    $list_MR = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='Manuscript Readiness'";
    $result_MR = mysqli_query($dbc, $list_MR);
    $row3 = mysqli_fetch_assoc($result_MR);
    $list_CD = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='Concept Development'";
    $result_CD = mysqli_query($dbc, $list_CD);
    $row4 = mysqli_fetch_assoc($result_CD);
    $list_IT = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='Illustrator (Text)'";
    $result_IT = mysqli_query($dbc, $list_IT);
    $row5 = mysqli_fetch_assoc($result_IT);
    $list_IC = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='Illustrator (Cover)'";
    $result_IC = mysqli_query($dbc, $list_IC);
    $row6 = mysqli_fetch_assoc($result_IC);
    $list_GLT = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='Graphic Layout (Text)'";
    $result_GLT = mysqli_query($dbc, $list_GLT);
    $row7 = mysqli_fetch_assoc($result_GLT);
    $list_GLC = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='Graphic Layout (Cover)'";
    $result_GLC = mysqli_query($dbc, $list_GLC);
    $row8 = mysqli_fetch_assoc($result_GLC);
    $list_PC = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='Proofing & Correction'";
    $result_PC = mysqli_query($dbc, $list_PC);
    $row9 = mysqli_fetch_assoc($result_PC);
    $list_PDP = "SELECT * FROM `dl_milestones` WHERE `projectId`='$xprojId' AND `actionItem`='PDP & ISBN Application'";
    $result_PDP = mysqli_query($dbc, $list_PDP);
    $row10 = mysqli_fetch_assoc($result_PDP);
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

        .table-container {
            /* Set a max-height to the table container to enable scrolling */
            max-height: 100%;
            /* Adjust this value as needed */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        /* Optional: Adjust table width */
        .table-container table {
            width: 90%;
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

            <form action="updateprogress.php?id=<?php echo $xprojId; ?>" method="post" enctype="multipart/form-data" class="css-dropdown">
                <div class="card-body">
                    <div class="table-container">
                        <table width="70%" align="center">
                            <col style="width:30%">
                            <col style="width:30%">
                            <col style="width:10%">
                            <tr>
                                <td><label for="DLstart">Starting Date</label>
                                    <input type="date" class="form-control" id="DLstart" name="DLstart" value="<?= $row3['startDate'] ?>" disabled />
                                </td>
                                <td><label for="DLdue">Due Date</label>
                                    <input type="date" class="form-control" id="DLdue" name="DLdue" value="<?= $row9['targetDate'] ?>" />
                                </td>
                                <td rowspan="3">
                                    <br>
                                    <label for="projectCover">Project Cover</label>
                                    <div class="container-cover">
                                        <div id="preview"></div>
                                        <input type="file" id="fileInput" name="projectCover" value="<?= $row['projectCover'] ?>" multiple>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label for="DLstatus">Approval Status</label>
                                    <select class="form-control " id="DLstatus" name="DLstatus" required>
                                        <option value="<?= $row['statusApproval'] ?>" selected>
                                            <?= $row['statusApproval'] ?>
                                        </option>
                                        <option value="Not Yet Proposed">Not Yet Proposed</option>
                                        <option value="Pending Approval">Pending Approval</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2"><label for="DLprogress">Progress (%)</label>
                                    <input type="number" class="form-control" id="DLprogress" name="DLprogress" min="0" max="100" value="<?= $row['progressPercentage'] ?>" />
                                </td>

                            </tr>


                        </table>
                    </div>

                    <hr class="hr hr-blurry" />
                    <!--divider-->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            Design & Layout Milestones
                        </h1>
                    </div>

                    <div class="table-container">
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
                            <td><input type="date" class="form-control" id="MRStartDate" name="MRStartDate" value="<?= $row3['startDate'] ?>" disabled /></td>
                            <td><input type="date" class="form-control" id="MRTargetDate" name="MRTargetDate" value="<?= $row3['startDate'] ?>" /></td>
                            <td><input type="date" class="form-control" id="MRActualDate" name="MRActualDate" value="<?= $row3['startDate'] ?>" /></td>
                            </tr>

                            <tr>
                                <td>Concept Development</td>
                                <td><input type="date" class="form-control" id="CDStartDate" name="CDStartDate" value="<?= $row4['startDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="CDTargetDate" name="CDTargetDate" value="<?= $row4['targetDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="CDActualDate" name="CDActualDate" value="<?= $row4['actualDate'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Illustration (Text)</td>
                                <td><input type="date" class="form-control" id="ITStartDate" name="ITStartDate" value="<?= $row5['startDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="ITTargetDate" name="ITTargetDate" value="<?= $row5['targetDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="ITActualDate" name="ITActualDate" value="<?= $row5['actualDate'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Illustration (Cover)</td>
                                <td><input type="date" class="form-control" id="ICStartDate" name="ICStartDate" value="<?= $row6['startDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="ICTargetDate" name="ICTargetDate" value="<?= $row6['targetDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="ICActualDate" name="ICActualDate" value="<?= $row6['actualDate'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Graphic Layout (Text)</td>
                                <td><input type="date" class="form-control" id="GLTStartDate" name="GLTStartDate" value="<?= $row7['startDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="GLTTargetDate" name="GLTTargetDate" value="<?= $row7['targetDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="GLTActualDate" name="GLTActualDate" value="<?= $row7['actualDate'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Graphic Layout (Cover)</td>
                                <td><input type="date" class="form-control" id="GLCStartDate" name="GLCStartDate" value="<?= $row8['startDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="GLCTargetDate" name="GLCTargetDate" value="<?= $row8['targetDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="GLCActualDate" name="GLCActualDate" value="<?= $row8['actualDate'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>Proofing & Correction</td>
                                <td><input type="date" class="form-control" id="PCStartDate" name="PCStartDate" value="<?= $row9['startDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="PCTargetDate" name="PCTargetDate" value="<?= $row9['targetDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="PCActualDate" name="PCActualDate" value="<?= $row9['actualDate'] ?>" /></td>
                            </tr>
                            <tr>
                                <td>PDP & ISBN Application</td>
                                <td><input type="date" class="form-control" id="PDPStartDate" name="PDPStartDate" value="<?= $row10['startDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="PDPTargetDate" name="PDPTargetDate" value="<?= $row10['targetDate'] ?>" /></td>
                                <td><input type="date" class="form-control" id="PDPActualDate" name="PDPActualDate" value="<?= $row10['actualDate'] ?>" /></td>
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