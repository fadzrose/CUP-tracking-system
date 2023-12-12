<?php
include "dbconnect.php";

// Get the project ID from the GET request
$xprojId = $_GET['id'];

// Fetch memberId using the appropriate SQL query
$queryFetchMemberId = "SELECT memberId FROM `member` WHERE `projectId`='$xprojId'";
$resultFetchMemberId = mysqli_query($dbc, $queryFetchMemberId);

if ($resultFetchMemberId) {
    $row = mysqli_fetch_assoc($resultFetchMemberId);
    $memberId = $row['memberId'];

    // Delete records from tables related to memberId first
    $sqldel4 = "DELETE FROM `designer_cover` WHERE `memberId`='$memberId';";
    $sqldel5 = "DELETE FROM `designer_text` WHERE `memberId`='$memberId';";
    $sqldel6 = "DELETE FROM `illustrator_cover` WHERE `memberId`='$memberId';";
    $sqldel7 = "DELETE FROM `illustrator_text` WHERE `memberId`='$memberId';";
    $sqldel8 = "DELETE FROM `editor_coordinator` WHERE `memberId`='$memberId';";
    $sqldel9 = "DELETE FROM `editor_proofing` WHERE `memberId`='$memberId';";

    // Execute queries to delete records from tables related to memberId
    $deleteDesignerCover = mysqli_query($dbc, $sqldel4);
    $deleteDesignerText = mysqli_query($dbc, $sqldel5);
    $deleteIllustratorCover = mysqli_query($dbc, $sqldel6);
    $deleteIllustratorText = mysqli_query($dbc, $sqldel7);
    $deleteEditorCoordinator = mysqli_query($dbc, $sqldel8);
    $deleteEditorProofing = mysqli_query($dbc, $sqldel9);

    if (
        $deleteDesignerCover && $deleteDesignerText && $deleteIllustratorCover && $deleteIllustratorText &&
        $deleteEditorCoordinator && $deleteEditorProofing
    ) {

        // Delete records from `member` and `design_layout` tables
        $sqldelMembers = "DELETE FROM `member` WHERE `projectId`='$xprojId';";
        $sqldelDesignLayout = "DELETE FROM `design_layout` WHERE `projectId`='$xprojId';";
        $sqldelMilestones = "DELETE FROM `dl_milestones` WHERE `projectId`='$xprojId';";
        $sqldelISBN = "DELETE FROM `isbn` WHERE `projectId`='$xprojId';";

        // Execute queries to delete records from related tables
        $deleteISBN = mysqli_query($dbc, $sqldelISBN);
        $deleteMiles = mysqli_query($dbc, $sqldelMilestones);
        $deleteMembers = mysqli_query($dbc, $sqldelMembers);
        $deleteDesignLayout = mysqli_query($dbc, $sqldelDesignLayout);

        if ($deleteMembers && $deleteDesignLayout) {
            // All related records deleted successfully, proceed to delete the project record
            $sqldelProject = "DELETE FROM `project` WHERE `projectId`='$xprojId';";
            $deleteProject = mysqli_query($dbc, $sqldelProject);

            if ($deleteProject) {
                // Project record deleted successfully
                echo "<script>alert('Project and associated records have been deleted');</script>";
                echo '<script>window.location.assign("allprojectlist.php");</script>';
            } else {
                // Handle if project deletion fails
                echo "Error deleting project: " . mysqli_error($dbc);
            }
        } else {
            // Handle if deletion of related records fails
            echo "Error deleting related records: " . mysqli_error($dbc);
        }
    } else {
        // Handle if deletion of records related to memberId fails
        echo "Error deleting records related to memberId: " . mysqli_error($dbc);
    }
} else {
    // Handle errors if the memberId fetch query fails
    // Display an error message or redirect as needed
    echo "Error fetching memberId: " . mysqli_error($dbc);
}
