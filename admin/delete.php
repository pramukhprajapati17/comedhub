<?php
include '../connection.php'; // Include your database connection file
session_start(); // Start the session
if(!$_SESSION["admin"]){
    header("Location: http://localhost/comedhub/admin");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sem'], $_POST['subject'], $_POST['foldname'], $_POST['fname'], $_POST['ftype'])) {
    // Sanitize and validate input data
    $sem = intval($_POST['sem']); // Assuming 'sem' is an integer
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $foldname = mysqli_real_escape_string($conn, $_POST['foldname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $ftype = mysqli_real_escape_string($conn, $_POST['ftype']);

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM files WHERE sem = '$sem' AND subject = '$subject' AND foldname = '$foldname' AND fname = '$fname' AND ftype = '$ftype'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Row deleted successfully";
    } else {
        echo "Error deleting row: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>