<?php

$dbc = mysqli_connect("localhost", "root", "", "cup tracking");
if (mysqli_connect_errno()) {
    echo "Failed to Open Database" . mysqli_connect_error($dbc);
}

function query($query)
{
    global $dbc;

    $result  = mysqli_query($dbc, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
?>
