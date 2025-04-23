<?php
session_start();
include 'connection.php'; // Include your database connection file
if (!$conn) {
    echo "<script>window.location.href='http://localhost/comedhub/404.html';</script>";
}
// Destroy the session to log out the user
session_destroy();
// Redirect to the login page or home page after logout
    echo "<script>alert('Logout successful!');</script>";
    echo "<script>window.location.href='http://localhost/comedhub/';</script>";
?>