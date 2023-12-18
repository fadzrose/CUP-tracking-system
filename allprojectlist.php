<?php
session_start(); // Start the session

// Check if the user clicks on the logout link
if (isset($_GET['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to a specific page after logout (optional)
    print "<script>alert('You have been successfully logout. Thank you for using this website.')</script>";
    print '<script>window.location.assign("loginpage.php");</script>';
    exit();
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
            background: #FFB7C3;
            color: black;
            font-size: 30px;

        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #FFB7C3;
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
            box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
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
            color: black;
            padding: 10px 15px;
            border: none;
            box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
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

        table a {
            color: black;
            /* Gantikan dengan kod warna yang anda inginkan */
            text-decoration: none;
            /* Menghapuskan garisan di bawah hiperpautan */
        }

        /* Gaya hiperpautan apabila dihover */
        table a:hover {
            text-decoration: underline;
            /* Menambahkan garisan di bawah hiperpautan semasa hover */
            /* Jika anda mahu warna berbeza semasa dihover, anda boleh menambahkan kod warna di sini */
        }

        img {
            align-items: center;
            border: 5px solid #555;
            border-radius: 4px;
            background-color: #ffe5ec;
            border-color: #ff8fab;
        }

        /* Style the dropdown button */
        .dropbtn {
            background-color: #ff8fab;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            width: 200px;
            height: 110;
        }


        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-link {
            size: 11;
            color: black;
            padding: 5px 5px;
            text-decoration: none;
            display: block;
            /* Set initial width or use min-width to ensure a minimum width */
            min-width: 100px;
            /* Optionally, you can set a max-width to prevent it from becoming too wide */
            max-width: 100%;
            /* Other styles as needed */
            background-color: whitesmoke;
            border-radius: 4px;
            padding: 2px;
            cursor: pointer;
        }

        .dropdown-link:hover {
            background-color: #ffe5ec;
        }

        .dropdown-content {
            display:none;
            position: absolute;
            background-color: #f9f9f9;
            width: 170px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            z-index: 1000;
            text-decoration: none;
            padding: 8px 12px;

        }

        .dropdown-content a:hover {
            text-decoration: none;
            background-color: #ffe5ec;
            padding: 8px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* CSS Styles for Progress Bar */
        .progress-barX {
            width: 200px;
            /* Adjust width as needed */
            height: 15px;
            /* Adjust height as needed */
            background-color: #4B8E92;
            /* Background color of the progress bar container */
            border-radius: 5px;
            /* Rounded corners */
            margin-top: 5px;
            /* Adjust spacing as needed */
        }

        .progressX {
            height: 100%;
            background-color: #79ECE4;
            /* Color of the progress bar */
            border-radius: 5px;
            /* Rounded corners */
            transition: width 0.5s ease-in-out;
            /* Smooth transition effect */
        }

        .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 200;
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
        <a href="?logout=true">Log out</a> <!-- Add logout parameter -->
    </div>
    <br>
    <div id="main" class="card">
        <div class="title">
            <h2 align="left">All Projects List</h2>
            <div class="dropdown" align="right">


                <button href="newproject.php" class="dropbtn">add new project</button>

            </div>
        </div><br>
        <div>
            <div class="card-header py-3">
                <div class="form-row justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-dark">Progress of the Projects</h5>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <tbody>
                            <?php
                            include "dbconnect.php";
                            $sql = "SELECT project.*, design_layout.* 
                                    FROM project 
                                    INNER JOIN design_layout ON project.projectId = design_layout.projectId
                                    ORDER BY progressPercentage"; // Modify the join condition based on your actual table structure
                            $result = mysqli_query($dbc, $sql);
                            $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);



                            // Loop through projects array two at a time to display cover and title in alternating columns
                            for ($i = 0; $i < count($projects); $i += 3) {
                                echo '<tr>';

                                // Display first project data
                                echo
                                '<td style="text-align: center">
                                        <img src="cover/' . $projects[$i]['projectCover'] . '" width="74" height="105"></td>';
                                echo '<td>Siri ' . $projects[$i]['siri'] . ' : 
                                        
                                        <div class="dropdown">
                                            <div class="dropdown-link" id="dynamicWidthElement" onclick="toggleDropdown()">
                                                ' . $projects[$i]['title'] . '
                                            </div>
                                            <div id="dropdownContent" class="dropdown-content">

                                            <a href="editProject.php?id=' . $projects[$i]['projectId'] . '">Edit Project</a><br>
                                            <a href="updateprogressDL.php?id=' . $projects[$i]['projectId'] . '">Update Progress</a><br>
                                            <a href="deleteProject.php?id=' . $projects[$i]['projectId'] . '">Delete</a>
                                            
                                            </div>
                                        </div>        

                                        
                                <div class="progress-barX">
                                            <div class="progressX" style="width: ' . $projects[$i]['progressPercentage'] . '%;"></div>
                                        </div>
                                        ' . $projects[$i]['progressPercentage'] . '%</td>';
                                // Check if the second project exists
                                if (isset($projects[$i + 1])) {
                                    // Display second project data
                                    echo
                                    '<td style="text-align: center">
                                        <img src="cover/' . $projects[$i + 1]['projectCover'] . '" width="74" height="105"></td>';
                                    echo '<td>Siri ' . $projects[$i + 1]['siri'] . ' : <div class="dropdown">
                                            <div class="dynamic-width" id="dynamicWidthElement" onclick="toggleDropdown()">
                                                ' . $projects[$i + 1]['title'] . '
                                            </div>
                                            <div id="dropdownContent" class="dropdown-content">

                                            <a href="editProject.php?id=' . $projects[$i + 1]['projectId'] . '">Edit Project</a><br>
                                            <a href="updateprogressDL.php?id=' . $projects[$i + 1]['projectId'] . '">Update Progress</a><br>
                                            <a href="deleteProject.php?id=' . $projects[$i + 1]['projectId'] .
                                        '">Delete</a>
                                            
                                            </div>
                                        </div>
                                        <div class="progress-barX">
                                            <div class="progressX" style="width: ' . $projects[$i + 1]['progressPercentage'] . '%;"></div>
                                        </div>
                                        ' . $projects[$i + 1]['progressPercentage'] . '%</td>';

                                    if (isset($projects[$i + 2])) {
                                        // Display second project data
                                        echo
                                        '<td style="text-align: center">
                                        <img src="cover/' . $projects[$i + 2]['projectCover'] . '" width="74" height="105"></td>';
                                        echo '<td>Siri ' . $projects[$i + 2]['siri'] . ' : <div class="dropdown">
                                            <div class="dynamic-width" id="dynamicWidthElement" onclick="toggleDropdown()">
                                                ' . $projects[$i + 2]['title'] . '
                                            </div>
                                            <div id="dropdownContent" class="dropdown-content">

                                            <a href="editProject.php?id=' . $projects[$i + 2]['projectId'] . '">Edit Project</a><br>
                                            <a href="updateprogressDL.php?id=' . $projects[$i + 2]['projectId'] . '">Update Progress</a><br>
                                            <a href="deleteProject.php?id=' . $projects[$i + 2]['projectId'] . '">Delete</a>
                                            
                                            </div>
                                        </div>
                                        <div class="progress-barX">
                                            <div class="progressX" style="width: ' . $projects[$i + 2]['progressPercentage'] . '%;"></div>
                                        </div>
                                        ' . $projects[$i + 2]['progressPercentage'] . '%</td>';
                                    } else {
                                        // If no second project exists, display empty columns
                                        echo '<td></td>';
                                        echo '<td></td>';
                                    }
                                } else {
                                    // If no second project exists, display empty columns
                                    echo '<td></td>';
                                    echo '<td></td>';
                                    echo '<td></td>';
                                }

                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>


                    <hr class="hr hr-blurry" />

                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT project.*, design_layout.* 
                                FROM project 
                                LEFT JOIN design_layout ON project.projectId = design_layout.projectId
                                WHERE design_layout.projectId IS NULL OR design_layout.projectCover IS NULL"; // Fetch projects with incomplete details
                    $result = mysqli_query($dbc, $sql);

                    $displayHeader = true; // Variable to control header display

                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($displayHeader) {
                            // Display the header only if it's the first incomplete project
                            echo '
            <div class="card-header py-3">
                <div class="form-row justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-dark">Incomplete Projects Details</h5>
                </div>
            </div><br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cover</th>
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
        ';
                            $displayHeader = false; // Set to false so that header won't be displayed again
                        }

                        // Display details of incomplete projects
                        echo '
        <tr>
            <td><img src="cover/' . $row['projectCover'] . '" width="74" height="105" </td>
            <td>' . $row['title'] . '</td>
            <td>' . $row['siri'] . '</td>
            <td>' . $row['category'] . '</td>
            <td>' . $row['projectSize'] . '</td>
            <td>' . $row['totalPages'] . '</td>
            <td>' . $row['typeOfDesign'] . '</td>
            <td>' . $row['typeOfFinishing'] . '</td>
            <td>
                <a href="deleteProject.php?id=' . $row['projectId'] . '" class="btn btn-danger btn-icon-split">
                    <span class="text">Delete</span>
                </a>
            </td>
        </tr>
    ';
                    }
                    echo '</table>'; // Close the table outside the loop
                    ?>
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
        // Get all dropdown links
        const dropdownLinks = document.querySelectorAll('.dropdown-link');

        // Iterate through each dropdown link and attach a click event listener
        dropdownLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior

                // Toggle the visibility of the associated dropdown content
                const content = this.nextElementSibling;
                if (content.style.display === 'block') {
                    content.style.display = 'none';
                } else {
                    // Hide any other open dropdowns before displaying this one
                    const allDropdownContents = document.querySelectorAll('.dropdown-content');
                    allDropdownContents.forEach(item => {
                        if (item !== content) {
                            item.style.display = 'none';
                        }
                    });

                    content.style.display = 'block';
                }
            });
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.querySelector('.dropdown-content').style.display = 'none';
                }
            });
        });
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</body>

</html>