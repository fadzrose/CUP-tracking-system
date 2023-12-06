<?php

$dbc = mysqli_connect("localhost", "root", "", "cup tracking");
if (mysqli_connect_errno()) {
    echo "Failed to Open Database" . mysqli_connect_error($dbc);
}

?>
