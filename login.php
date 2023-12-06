<?php
session_start();
$xemail = $_POST['emailInput'];
$xpass = $_POST['inputPassword6'];

include "dbconnect.php";

//to check either a vlid customer and staff or not
$chkps = "Select * from `personnel` where `email`=?";
//$chkstaff = "Select * from `staff` where `staffid`='$xid';";

$stmt = mysqli_prepare($dbc, $chkps);
mysqli_stmt_bind_param($stmt, 's', $xemail);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$ps = mysqli_fetch_array($result);

if ($ps) {
    
    $_SESSION['email'] = $xemail;
    $hash = $ps['password']; // Retrieve hashed password from the database

    $verify = password_verify($xpass, $hash); 
  
  // Print the result depending if they match 
  if ($verify) {
        // Fetching the position of the logged-in user from the database result
        $xposition = $ps['position'];

        if ($xposition === 'Administrator') {
            // Redirect to an admin page after showing alert
            echo '<script>alert("Welcome Administrator");</script>';
            echo '<script>window.location.assign("admin_page.php");</script>';
            exit();
        } else if ($xposition === 'Manager') {
            // Redirect to manager page after showing alert
            echo '<script>alert("Welcome Manager");</script>';
            echo '<script>window.location.assign("manager_page.php");</script>';
            exit();
        } else {
            // Display alert and redirect to signuppage.php
            echo '<script>alert("Incomplete details. Please sign up again and fill personnel details.");</script>';
            echo '<script>window.location.assign("signuppage.php");</script>';
            exit();
             } 
  } else {
        /*echo '<script>alert("Incorrect password");</script>';
        echo '<script>window.location.assign("loginpage.php");</script>';
        exit();*/
        
        $hashFromDB = $ps['password']; // Retrieve hashed password from the database

        // Output the hashes for debugging
        echo "Hash from DB: " . $hashFromDB . "<br>";
        echo "Hash of Entered Password: " . password_hash($xpass, PASSWORD_DEFAULT) . "<br>";

            // Then perform password verification and redirection based on the result
       
    } 
  


    
} else {
    echo '<script>alert("Invalid user");</script>';
    echo '<script>window.location.assign("loginpage.php");</script>';
    exit();
}
?>
