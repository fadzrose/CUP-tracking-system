
<?php
function generateRandomSalt($length = 32)
{
    return bin2hex(random_bytes($length / 2)); // Generates a random string of bytes and converts it to hexadecimal format
}


$xemail = $_POST['emailInput'];
$xpass = $_POST['inputPassword6'];
$salt = generateRandomSalt(); // Replace this with your function to generate a random salt
$hashedPassword = password_hash($xpass . $salt, PASSWORD_DEFAULT);
// Store $hashedPassword and $salt in your database

include "dbconnect.php";

$dbc = mysqli_connect("localhost", "root", "", "cup tracking");


$sqlin = "INSERT INTO `personnel` (`personnelId`, `name`, `position`, `email`, `hashed_password`,`salt`, `phone`) VALUES ('','null','null','$xemail','$hashedPassword','$salt','null');";


$chkerr = mysqli_query($dbc, $sqlin);
if (false === $chkerr) {
    // to display the error
    echo mysqli_error($dbc);
}
if ($chkerr) {
    $last_inserted_id = mysqli_insert_id($dbc); // Get the last inserted ID
    echo "<script>alert('Warning: Successfully signed up')</script>";
    // Redirect to formpersonnelinfo.php with the last inserted ID
    header("Location: formpersonnelinfo.php?id=" . $last_inserted_id);
    exit(); // Ensure no further code execution after redirection
} else {
    echo "<script>alert('Warning: Failed to sign up')</script>";
}

?>