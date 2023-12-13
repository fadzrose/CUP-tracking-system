<?php
session_start();
$xemail = $_POST['emailInput'];
$xpass = $_POST['inputPassword6'];

include "dbconnect.php";

// Prepare and execute a SELECT query
$stmt = $dbc->prepare("SELECT hashed_password, salt, position FROM personnel WHERE email = ?");
$stmt->bind_param("s", $xemail);
$stmt->execute();

$result = mysqli_stmt_get_result($stmt);

if ($result && $ps = mysqli_fetch_assoc($result)) {
    $hashedPasswordFromDB = $ps['hashed_password'];
    $saltFromDB = $ps['salt'];

    $_SESSION['email'] = $xemail;

    // Verify the password
    $hashedPasswordInput = password_hash($xpass . $saltFromDB, PASSWORD_DEFAULT);

    if (password_verify($xpass . $saltFromDB, $hashedPasswordFromDB)) {
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
        $hashFromDB = $ps['hashed_password']; // Retrieve hashed password from the database

        // Output the hashes for debugging
        echo "Hash from DB: " . $hashedPasswordFromDB . "<br>";
        echo "Hash of Entered Password: " . password_hash($xpass . $saltFromDB, PASSWORD_DEFAULT) . "<br>";

        // Password is incorrect
        /*echo '<script>alert("Invalid password");</script>';
        echo '<script>window.location.assign("loginpage.php");</script>';
        exit();*/
    }
} else {
    // User not found
    echo '<script>alert("Invalid user");</script>';
    echo '<script>window.location.assign("loginpage.php");</script>';
    exit();
}
?>
