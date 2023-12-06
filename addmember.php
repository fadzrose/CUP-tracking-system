
<?php
$xemail = $_POST['emailInput'];
$xpass = $_POST['inputPassword6'];
$hash = password_hash($plaintext_password,PASSWORD_DEFAULT); 

include "dbconnect.php";

$dbc = mysqli_connect("localhost", "root", "", "cup tracking");


$sqlin = "INSERT INTO `personnel` (`personnelId`, `name`, `position`, `email`, `password`, `phone`) VALUES ('','null','null','$xemail','$hash','null');";


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