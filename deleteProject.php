<?php
include "dbconnect.php";

// Get the project ID from the GET request
$xprojId = $_GET['id'];

// Begin transaction
mysqli_begin_transaction($dbc);

try {
    // Delete records related to member ID if it exists
    $queryFetchMemberId = "SELECT memberId FROM `member` WHERE `projectId`='$xprojId'";
    $resultFetchMemberId = mysqli_query($dbc, $queryFetchMemberId);

    if ($resultFetchMemberId) {
        $row = mysqli_fetch_assoc($resultFetchMemberId);

        if ($row && isset($row['memberId']) && !empty($row['memberId'])) {
            $memberId = $row['memberId'];

            // Delete records from tables related to memberId
            $deleteQueries = [
                "DELETE FROM `designer_cover` WHERE `memberId`='$memberId';",
                "DELETE FROM `designer_text` WHERE `memberId`='$memberId';",
                "DELETE FROM `illustrator_cover` WHERE `memberId`='$memberId';",
                "DELETE FROM `illustrator_text` WHERE `memberId`='$memberId';",
                "DELETE FROM `editor_coordinator` WHERE `memberId`='$memberId';",
                "DELETE FROM `editor_proofing` WHERE `memberId`='$memberId';"
            ];

            foreach ($deleteQueries as $query) {
                $deleteResult = mysqli_query($dbc, $query);
                if (!$deleteResult) {
                    throw new Exception("Error deleting records related to memberId: " . mysqli_error($dbc));
                }
            }
        }
    }

    // Delete records from other related tables (regardless of memberId existence)
    $deleteQueries = [
        "DELETE FROM `member` WHERE `projectId`='$xprojId';",
        "DELETE FROM `design_layout` WHERE `projectId`='$xprojId';",
        "DELETE FROM `dl_milestones` WHERE `projectId`='$xprojId';",
        "DELETE FROM `isbn` WHERE `projectId`='$xprojId';"
    ];

    foreach ($deleteQueries as $query) {
        $deleteResult = mysqli_query($dbc, $query);
        if (!$deleteResult) {
            throw new Exception("Error deleting records: " . mysqli_error($dbc));
        }
    }

    // Delete the project record
    $sqldelProject = "DELETE FROM `project` WHERE `projectId`='$xprojId';";
    $deleteProject = mysqli_query($dbc, $sqldelProject);

    if (!$deleteProject) {
        throw new Exception("Error deleting project: " . mysqli_error($dbc));
    }
    else{
    // Commit transaction
    mysqli_commit($dbc);

    // Project record deleted successfully
    echo "<script>alert('Project and associated records have been deleted');</script>";
    echo '<script>window.location.assign("allprojectlist.php");</script>';
    }
} catch (Exception $e) {
    // Rollback on error
    mysqli_rollback($dbc);
    echo "Transaction failed: " . $e->getMessage();
}
