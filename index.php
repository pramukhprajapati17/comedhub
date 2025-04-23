<?php
include './connection.php'; // Include your database connection file
if (!$conn) {
    echo "<Script>window.location.href='http://localhost/comedhub/404.html';</script>";
}
// Check if the user is logged in as admin
session_start();

if(!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: http://localhost/comedhub/student/login.php");
    exit();
}
$email = $_SESSION['email'];
$semquery = "SELECT sem FROM students WHERE email = '$email'";
$semresult = mysqli_query($conn, $semquery);
if ($semresult) {
    $semrow = mysqli_fetch_assoc($semresult);
    $sem = $semrow['sem'];
} else {
    // Handle error if the query fails
    header("Location: http://localhost/comedhub/student/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/burger.css">
    <link rel="stylesheet" href="./css/alignments.css">
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="stylesheet" href="./css/theme.css">
    <title>Home-Page</title>
</head>
<body class="">
    <Header class="header flex bg-primary">
        <div class="leftHeader flex items-center w-50">
            <div class="burger" id="burger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <img src="http://localhost/comedhub/images/logo.png" alt="Logo" class='w5 mr2 ml1'>
            <h1 class="title text-white" >COMPEDHUB</h1>
        </div>
        <div class="rightHeader flex items-center justify-end w-50">
            <a href="http://localhost/comedhub/student/profile.php"><img src="./images/profile.png" alt="profile" class='' style='width: 65px; top: 4px; border: radius 50%; position:relative'></a>
            <a href="http://localhost/comedhub/logout.php" class="mr2"><button class="h3 bg-red text-white" style='cursor:pointer'>Logout</button></a>
        </div>
    </Header>
    <div class="main flex">
        <div class="aside">
            <div class="asideNav sppl h90 m-0">
                    <a href="http://localhost/comedhub/" class='bg-fourth text-white'><li>Home</li></a>
                    <details>
                        <summary>Subjects</summary>
                            <?php
                                $dsubject = "SELECT DISTINCT subject FROM files WHERE sem = '$sem'";
                                $dsubjectresult = mysqli_query($conn, $dsubject);
                                while ($row = mysqli_fetch_assoc($dsubjectresult)) {
                                    $subjectName = $row['subject'];
                                    echo "<a href='http://localhost/comedhub/subjects/$subjectName.php'><li>$subjectName</li></a>";
                                }
                            ?>
                    </details>
            </div>
        </div>
        <!-- content starts -->
        <div class="content flex flex-col items-center">
            <div class='flex w-100 justify-center items-center' style='flex-wrap:wrap;'>
            <?php
                $dsubject = "SELECT DISTINCT subject FROM files WHERE sem = '$sem'";
                $dsubjectresult = mysqli_query($conn, $dsubject);
                while ($row = mysqli_fetch_assoc($dsubjectresult)) {
                    $subject = $row['subject'];
                    echo "<a href='http://localhost/comedhub/subjects/$subject.php' class='text-none mt5'>
                            <div class='bg-white mr5 p1 rounded'>
                                <img src='http://localhost/comedhub/images/$subject.jpg' alt='$subject' class='rounded' style='width: 400px; height:30vh'>
                                <h2 class='bg-fourth text-white p1 m-0 f2 rounded w-50 text-center' style='width: 380px;'>$subject</h2>
                            </div>
                        </a>";
                }
                if(mysqli_num_rows($dsubjectresult) == 0) {
                    echo "<div class='w50 bg-white mt5 mb-0 p4'>The materials will be available shortly. Kindly try again later.</div>";
                }
            ?>
            </div>
        </div>
    </div>
    <script src="./admin/burger.js"></script>
</body>
</html>