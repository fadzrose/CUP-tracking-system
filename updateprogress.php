<?php
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    // Process the form data here when the form is submitted
    $xprojId = $_GET['id']; // Retrieve the ID from the URL parameter

    $xprojstart = $_POST['DLstart'];
    $xprojdue = $_POST['DLdue'];
    $xapprovalstat = $_POST['DLstatus'];
    $xpercentage = $_POST['DLprogress'];
    $xcover = $_FILES['projectCover']['name'];
    $tempname = $_FILES['projectCover']['tmp_name'];
    $folder = "cover/" . $xcover;
    if (move_uploaded_file($tempname, $folder)) {
        echo '<script>alert("Cover have been updated.");</script>';
    } else {
        echo "Error uploading file.";
    }


    //$xprojstart = $_POST['MRStartDate'];
    $xMRdue = $_POST['MRTargetDate'];
    $xMRdone = $_POST['MRActualDate'];

    $xCDstart = $_POST['CDStartDate'];
    $xCDdue = $_POST['CDTargetDate'];
    $xCDdone = $_POST['CDActualDate'];

    $xITstart = $_POST['ITStartDate'];
    $xITdue = $_POST['ITTargetDate'];
    $xITdone = $_POST['ITActualDate'];

    $xICstart = $_POST['ICStartDate'];
    $xICdue = $_POST['ICTargetDate'];
    $xICdone = $_POST['ICActualDate'];

    $xGLTstart = $_POST['GLTStartDate'];
    $xGLTdue = $_POST['GLTTargetDate'];
    $xGLTdone = $_POST['GLTActualDate'];

    $xGLCstart = $_POST['GLCStartDate'];
    $xGLCdue = $_POST['GLCTargetDate'];
    $xGLCdone = $_POST['GLCActualDate'];

    $xPCstart = $_POST['PCStartDate'];
    //$xprojdue = $_POST['PCTargetDate'];
    $xPCdone = $_POST['PCActualDate'];

    $xPDPstart = $_POST['PDPStartDate'];
    $xPDPdue = $_POST['PDPTargetDate'];
    $xPDPdone = $_POST['PDPActualDate'];

    $sqlinDL = "UPDATE `design_layout` SET  `statusApproval` = '$xapprovalstat',`progressPercentage` = '$xpercentage',`projectCover` = '$xcover' WHERE `projectId` = '$xprojId';";

    $sqlinMR = "UPDATE `dl_milestones` SET  `startDate` = '$xprojstart',`targetDate` = '$xMRdue',`actualDate` = '$xMRdone' WHERE `projectId` = '$xprojId' AND `actionItem`='Manuscript Readiness';";
    $sqlinCD = "UPDATE `dl_milestones` SET  `startDate` = '$xCDstart',`targetDate` = '$xCDdue',`actualDate` = '$xCDdone' WHERE `projectId` = '$xprojId' AND `actionItem`='Concept Development';";
    $sqlinIT = "UPDATE `dl_milestones` SET  `startDate` = '$xITstart',`targetDate` = '$xITdue',`actualDate` = '$xITdone' WHERE `projectId` = '$xprojId' AND `actionItem`='Illustration (Text)';";
    $sqlinIC = "UPDATE `dl_milestones` SET  `startDate` = '$xICstart',`targetDate` = '$xICdue',`actualDate` = '$xICdone' WHERE `projectId` = '$xprojId' AND `actionItem`='Illustration (Cover)';";
    $sqlinGLT = "UPDATE `dl_milestones` SET  `startDate` = '$xGLTstart',`targetDate` = '$xGLTdue',`actualDate` = '$xGLTdone' WHERE `projectId` = '$xprojId' AND `actionItem`='Graphic Layout (Text)';";
    $sqlinGLC = "UPDATE `dl_milestones` SET  `startDate` = '$xGLCstart',`targetDate` = '$xGLCdue',`actualDate` = '$xGLCdone' WHERE `projectId` = '$xprojId' AND `actionItem`='Graphic Layout (Cover)';";
    $sqlinPC = "UPDATE `dl_milestones` SET  `startDate` = '$xPCstart',`targetDate` = '$xprojdue',`actualDate` = '$xPCdone' WHERE `projectId` = '$xprojId' AND `actionItem`='Proofing & Correction';";
    $sqlinPDP = "UPDATE `dl_milestones` SET  `startDate` = '$xPDPstart',`targetDate` = '$xPDPdue',`actualDate` = '$xPDPdone' WHERE `projectId` = '$xprojId' AND `actionItem`='PDP & ISBN Application';";
    


    $sqlQueries = [
        $sqlinDL, $sqlinMR, $sqlinCD, $sqlinIT, $sqlinIC,
        $sqlinGLT, $sqlinGLC, $sqlinPC, $sqlinPDP
    ];

    // Combine all queries into a single string separated by semicolons
    $combinedQueries = implode(';', $sqlQueries);

    // Execute multiple queries
    if (mysqli_multi_query($dbc, $combinedQueries)) {
        do {
            // Check each query result
            if ($result = mysqli_store_result($dbc)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($dbc));

        // All queries executed successfully
        echo '<script>alert("Progress have been updated.");</script>';
        print '<script>window.location.assign("allprojectlist.php");</script>';
    } else {
        // At least one query failed
        echo "Warning: Failed to save. MySQL Error: " . mysqli_error($dbc);
    }
}
