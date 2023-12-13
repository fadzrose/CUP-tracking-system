<?php
require 'dbconnect.php';
$qpersonnels = query("SELECT * FROM personnel");
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

            max-width: 90%;
            margin: auto;

            text-align: left;
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    Add New Project To Production
                </h1>
            </div>
            <form action="addproject.php" method="post" enctype="multipart/form-data" class="css-dropdown">
                <div class="form-group col-md-13">
                    <label for="projectTitle">Project Title</label>
                    <input type="text" class="form-control" id="projectTitle" name="projectTitle" required />
                </div>

                <table width="100%">
                    <tr>
                        <td><label for="typeOfCategory">Type of Category</label>
                            <select class="form-control" id="typeOfCategory" name="typeOfCategory" required>
                                <option value="" selected disabled>Please select the category</option>
                                <option value="Novel Graphic (1/2 Color)">Novel Graphic (1/2 Color)</option>
                                <option value="Novel Graphic (4 Cover)">Novel Graphic (4 Cover)</option>
                                <option value="Poster">Poster</option>
                                <option value="Komik">Komik</option>
                                <option value="Edukomik">Edukomik</option>
                                <option value="Aktiviti">Aktiviti</option>
                                <option value="Non-Fiction">Non-Fiction</option>
                                <option value="Mega (Hardcover)">Mega (Hardcover)</option>
                                <option value="Workbook / Academic">Workbook / Academic</option>
                                <option value="ABM (Others)">ABM (Others)</option>
                            </select>
                        </td>
                        <td>
                            <label for="projectSiri">Series</label>
                            <input type="text" class="form-control" id="projectSiri" name="projectSiri" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="projectSize">Project Size</label>
                            <select class="form-control" id="projectSize" name="projectSize">
                                <option value="" selected disabled>
                                    Please select the size
                                </option>
                                <option value="A4">A4</option>
                                <option value="A5">A5</option>
                                <option value="A6">A6</option>
                                <option value="B5">B5</option>
                                <option value="B6">B6</option>
                                <option value="6x9">6" x 9"</option>
                                <option value="7.5x10">7.5" x 10"</option>
                                <option value="8x8">8" x 8"</option>
                                <option value="10x10">10" x 10"</option>
                                <option value="Others">Others</option>
                            </select>
                        </td>
                        <td><label for="totalPages">Total Pages</label>
                            <input type="number" class="form-control" id="totalPages" name="totalPages" min="1" />
                        </td>
                    </tr>
                    <tr>
                        <td><label for="typeDesign">Type of Design</label>
                            <select class="form-control" id="typeDesign" name="typeDesign" required>
                                <option value="" selected disabled>
                                    Please select the type
                                </option>
                                <option value="Cover">Cover</option>
                                <option value="Text">Text</option>
                                <option value="Illustration">Illustration</option>
                            </select>
                        </td>
                        <td><label for="Finishing">Finishing</label>
                            <select class="form-control" id="Finishing" name="Finishing">
                                <option value="" selected disabled>
                                    Please select the finishing
                                </option>
                                <option value="UV">UV</option>
                                <option value="SPOT UV">SPOT UV</option>
                                <option value="GLITTER">GLITTER</option>
                                <option value="EMBOSS">EMBOSS</option>
                                <option value="PERFECT BINDING">PERFECT BINDING</option>
                                <option value="PIN BINDING">PIN BINDING</option>
                                <option value="WIRE O">WIRE O</option>
                                <option value="SOFT COVER">SOFT COVER</option>
                                <option value="HARD COVER">HARD COVER</option>
                                <option value="BOX / PLASTIC PACKAGING">BOX / PLASTIC PACKAGING</option>
                            </select>
                        </td>
                    </tr>
                </table>







                <hr class="hr hr-blurry" />
                <!--divider-->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">
                        Project Members
                    </h1>
                </div>

                <div class="form-group col-md-12">
                    <label for="Writer">Writer</label>
                    <input type="text" class="form-control" id="Writer" name="Writer" />
                </div>
                <table width="100%">
                    <tr>
                        <td><label for="coordinator">Editor (Coordinator)</label>
                            <select class="form-control" id="coordinator" name="coordinator" required>
                                <option value="" selected disabled>Please select the editor</option>
                                <?php
                                foreach ($qpersonnels as $personnel) :
                                    if ($personnel["position"] == "Editor") {
                                        echo "<option value='" . $personnel["personnelId"] . "'>" . $personnel["name"] . "</option>";
                                    }

                                endforeach; ?>
                                ?>
                            </select>
                        </td>
                        <td><label for="proofing">Editor (Proofing)</label>
                            <select class="form-control" id="proofing" name="proofing" >
                                <option value="0" selected disabled>Please select the editor</option>
                                <?php
                                foreach ($qpersonnels as $personnel) :
                                    if ($personnel["position"] == "Editor") {
                                        echo "<option value='" . $personnel["personnelId"] . "'>" . $personnel["name"] . "</option>";
                                    }

                                endforeach; ?>
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="designerText">Graphic Designer (Text)</label>
                            <select class="form-control" id="designerText" name="designerText" required>
                                <option value="" selected disabled>Please select the designer</option>
                                <?php
                                foreach ($qpersonnels as $personnel) :
                                    if ($personnel["position"] == "Graphic Designer") {
                                        echo "<option value='" . $personnel["personnelId"] . "'>" . $personnel["name"] . "</option>";
                                    }

                                endforeach; ?>
                                ?>
                            </select>
                        </td>
                        <td><label for="designerCover">Graphic Designer (Cover)</label>
                            <select class="form-control" id="designerCover" name="designerCover">
                                <option value="0" selected disabled>Please select the designer</option>
                                <?php
                                foreach ($qpersonnels as $personnel) :
                                    if ($personnel["position"] == "Graphic Designer") {
                                        echo "<option value='" . $personnel["personnelId"] . "'>" . $personnel["name"] . "</option>";
                                    }

                                endforeach; ?>
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="IlusText">Illustrator (Text)</label>
                            <select class="form-control" id="IlusText" name="IlusText" required>
                                <option value="" selected disabled>Please select the illustrator</option>
                                <?php
                                foreach ($qpersonnels as $personnel) :
                                    if ($personnel["position"] == "Illustrator") {
                                        echo "<option value='" . $personnel["personnelId"] . "'>" . $personnel["name"] . "</option>";
                                    }

                                endforeach; ?>
                                ?>
                            </select>
                        </td>
                        <td><label for="IlusCover">Illustrator (Cover)</label>
                            <select class="form-control" id="IlusCover" name="IlusCover">
                                <option value="0" selected disabled>Please select the illustrator</option>
                                <?php
                                foreach ($qpersonnels as $personnel) :
                                    if ($personnel["position"] == "Illustrator") {
                                        echo "<option value='" . $personnel["personnelId"] . "'>" . $personnel["name"] . "</option>";
                                    }

                                endforeach; ?>
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>

                <br>
                <div class="form-group col-md-13">
                    <label for="IlusPages">Number of Illustration (Pages)</label>
                    <input type="number" class="form-control" id="IlusPages" name="IlusPages" min="1" />
                </div>
                <br>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>


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