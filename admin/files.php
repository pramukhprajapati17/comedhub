<?php
include '../connection.php'; // Include your database connection file
session_start(); // Start the session
if(!$_SESSION["admin"]){
    header("Location: http://localhost/comedhub/admin");
    exit();
}
    $sem = $_REQUEST["sem"];
    $code = $_REQUEST["code"];
    $subject = strtoupper($_REQUEST["subject"]);
    if(!file_exists("../subjects/$subject.php")){
        echo "<script>alert('Subject Does not Exists Please Add Subject first!'); window.location.href='http://localhost/comedhub/admin/newsubject.php'</script>";
        exit();
    }
    $foldname = strtoupper($_REQUEST["foldname"]);
    $fname = $_REQUEST["fname"];
    $ftype = strtoupper($_REQUEST["ftype"]);
    $flink = $_REQUEST["flink"];
    $sql = "INSERT INTO files VALUES ('$sem', '$code', '$subject', '$foldname', '$fname', '$ftype', '$flink',NOW())";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successfull');window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
        echo "<script>alert('Failed to add file');window.location.href='index.php';</script>";
    }
// Close the connection
mysqli_close($conn);
?>