<?php
$xprojId = $_GET['id'];

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


$sqlinproject = "UPDATE `project` SET `title` = '$xtitle' , `siri` = '$xsiri', `category` = '$xcategory', `typeOfDesign` = '$xdesign', `typeOfFinishing` = '$xfinishing', `projectSize` = '$xsize', `totalPages` = '$xpages', `IlusPages` = '$xIpage' WHERE  `projectId` = '$xprojId';";
if ($dbc->query($sqlinproject) === TRUE) {
    $last_projectid = $dbc->insert_id;

    $sqlinmember = "UPDATE `member` SET  `writerName` = '?' WHERE `projectId` = '$xprojId';";

    // Your previous code...

    // Fetch memberId associated with the required projectId
    $sqlGetMemberId = "SELECT `memberId` FROM `member` WHERE `projectId` = '$xprojId'";
    $resultMemberId = $dbc->query($sqlGetMemberId);

    if ($resultMemberId->num_rows > 0) {
        $row = $resultMemberId->fetch_assoc();
        $memberIdToUpdate = $row['memberId'];

        // Update queries for the junction tables using the fetched memberId
        $sqlEC = "UPDATE editor_coordinator SET `personnelId` = '$xeditC' WHERE `memberId` = '$memberIdToUpdate'";
        $sqlEP = "UPDATE editor_proofing SET `personnelId` = '$xeditP' WHERE `memberId` = '$memberIdToUpdate'";
        $sqlDT = "UPDATE designer_text SET `personnelId` = '$xdesignT' WHERE `memberId` = '$memberIdToUpdate'";
        $sqlDC = "UPDATE designer_cover SET `personnelId` = '$xdesignC' WHERE `memberId` = '$memberIdToUpdate'";
        $sqlIT = "UPDATE illustrator_text SET `personnelId` = '$xItext' WHERE `memberId` = '$memberIdToUpdate'";
        $sqlIC = "UPDATE illustrator_cover SET `personnelId` = '$xIcover' WHERE `memberId` = '$memberIdToUpdate'";

        // Execute queries for updating member-related junction tables
        $chkerrEC = $dbc->query($sqlEC);
        $chkerrEP = $dbc->query($sqlEP);
        $chkerrDT = $dbc->query($sqlDT);
        $chkerrDC = $dbc->query($sqlDC);
        $chkerrIT = $dbc->query($sqlIT);
        $chkerrIC = $dbc->query($sqlIC);

        if ($chkerrEC && $chkerrEP && $chkerrDT && $chkerrDC && $chkerrIT && $chkerrIC) {
            // All queries executed successfully
            print "<script>alert('The project have been updated.')</script>";

            print '<script>window.location.assign("allprojectlist.php");</script>';
            exit(); // Ensure no further code execution after redirection
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
