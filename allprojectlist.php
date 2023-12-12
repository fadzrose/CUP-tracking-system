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
    <div id="main" class="card">
        <div class="form-row">
            <table width="100%">
                <tr>
                    <th>
                        <h2>Project List</h2>
                    </th>
                    <th style="text-align: right;"><a href="newproject.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Add New Project</a></th>
                </tr>
            </table>


        </div>
        <div>
            <div class="card-header py-3">
                <div class="form-row justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-dark">Details of Projects</h5>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr><th>Cover</th>
                                <th>Title</th>
                                <th>Series</th>
                                <th>Category</th>
                                <th>Size</th>
                                <th>Total Pages</th>
                                <th>Type of Design</th>
                                <th>Finishing</th>
                                <th>Action</th>

                            </tr>

                        </thead>
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM project";
                        
                        $result = mysqli_query($dbc, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo
                            '<tr>
                            <td><img src="cover/' . $row['projectCover'] . '" width="100" height="100" </td>
                                            <td>' . $row['title'] . '</td>
                                            <td>' . $row['siri'] . '</td>
                                            <td>' . $row['category'] . '</td>
                                            <td>' . $row['projectSize'] . '</td>
                                            <td>' . $row['totalPages'] . '</td>
                                            <td>' . $row['typeOfDesign'] . '</td>
                                            <td>' . $row['typeOfFinishing'] . '</td>

                                            <td> 
                                            
                                            <a href="editProject.php?id=' . $row['projectId'] . '" class="btn btn-warning">
                                                    
                                                <span class="text">Edit</span>
                                                </a>
                                                <a href="updateprogress.php?id=' . $row['projectId'] . '" class="btn btn-info btn-icon-split">
                                                    
                                                <span class="text">Update</span>
                                                </a>

                                                <a href="deleteProject.php?id=' . $row['projectId'] . '" class="btn btn-danger btn-icon-split">
                                                    
                                                <span class="text">Delete</span>
                                                </a>

                                            </td>
                                        </tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="footer" class="footer">
        <br>
        <p>Copyright &copy; 2023 Ana Muslim Sdn Bhd. All rightsreserved.</p>

    </div>

    <script>
        /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
        function openNav() {
            document.getElementById("mySidebar").style.width = "200px";
            document.getElementById("main").style.marginLeft = "240px";
            document.getElementById("main").style.marginRight = "40px";
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