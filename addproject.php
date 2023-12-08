<?php

$xtitle = $_POST['projectTitle'];
$xsiri = $_POST['projectSiri'];
$xcategory = $_POST['typeOfCategory'];
$xsize = $_POST['projectSize'];
$xpages = $_POST['totalPages'];
$xdesign = $_POST['typeDesign'];
$xfinishing = $_POST['Finishing'];
$xIpage = $_POST['IlusPages'];

$xwriter = $_POST['Writer'];
$xeditC = $_POST['coordinator'];
$xeditP = $_POST['proofing'];
$xdesignT = $_POST['designerText'];
$xdesignC = $_POST['designerCover'];
$xItext = $_POST['IlusText'];
$xIcover = $_POST['IlusCover'];


$dbc = mysqli_connect("localhost", "root", "", "cup tracking");

if (mysqli_connect_errno()) {
    echo "Failed to open the database" . mysqli_error($dbc);
}



$sqlinproject = "INSERT INTO `project` (`projectId`, `title`, `siri`, `category`, `typeOfDesign`, `typeOfFinishing`, `projectSize`, `totalPages`, `IlusPages`) VALUES ('', '$xtitle', '$xsiri', '$xcategory', '$xdesign', '$xfinishing', '$xsize', '$xpages', '$xIpage')";
if ($dbc->query($sqlinproject) === TRUE) {
    $last_projectid = $dbc->insert_id;

    $sqlinmember = "INSERT INTO `member` (`memberId`, `writerName`, `projectId`) VALUES ('', ?, ?)";
    $stmt = $dbc->prepare($sqlinmember);
    $stmt->bind_param("ss", $xwriter, $last_projectid);
    if ($stmt->execute()) {
        // Query executed successfully
        // Your further logic here
        $last_memberid = $dbc->insert_id;

        $sqlEC = "INSERT INTO editor_coordinator (`memberId`, `personnelId`) VALUES ('$last_memberid', '$xeditC')";
        $sqlEP = "INSERT INTO editor_proofing (`memberId`, `personnelId`) VALUES ('$last_memberid', '$xeditP')";
        $sqlDT = "INSERT INTO designer_text (`memberId`, `personnelId`) VALUES ('$last_memberid', '$xdesignT')";
        $sqlDC = "INSERT INTO designer_cover (`memberId`, `personnelId`) VALUES ('$last_memberid', '$xdesignC')";
        $sqlIT = "INSERT INTO illustrator_text (`memberId`, `personnelId`) VALUES ('$last_memberid', '$xItext')";
        $sqlIC = "INSERT INTO illustrator_cover (`memberId`, `personnelId`) VALUES ('$last_memberid', '$xIcover')";

        // Execute queries for member-related junction tables
        $chkerrEC = $dbc->query($sqlEC);
        $chkerrEP = $dbc->query($sqlEP);
        $chkerrDT = $dbc->query($sqlDT);
        $chkerrDC = $dbc->query($sqlDC);
        $chkerrIT = $dbc->query($sqlIT);
        $chkerrIC = $dbc->query($sqlIC);

        if ($chkerrEC && $chkerrEP && $chkerrDT && $chkerrDC && $chkerrIT && $chkerrIC) {
            // All queries executed successfully
            print "<script>alert('Records added to all tables')</script>";
            print '<script>window.location.assign("designlayoutprogress.php");</script>';
        } else {
            // At least one query failed
            echo "Error: " . $dbc->error;
            // Handle the failure as needed
        }
    } else {
        // Query failed
        echo "Error: " . $stmt->error;
        // Handle the failure as needed
    }
    $stmt->close();

}



