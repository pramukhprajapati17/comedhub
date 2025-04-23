<?php
include '../connection.php'; // Include your database connection file
$sem = 1; // set the semester
$subject = "MATHS"; // Set the subject name
if (!$conn) {
    echo "<Script>window.location.href='http://localhost/comedhub/404.html';</script>";
}
// Check if the user is logged in
session_start();
if(isset($_SESSION['admin'])){
    $home = "http://localhost/comedhub/admin";
    $adminquery = "SELECT * FROM admin WHERE uname = '$_SESSION[admin]'";
    $adminresult = mysqli_query($conn, $adminquery);
    if (mysqli_num_rows($adminresult) < 1) {
        header("Location: http://localhost/comedhub/student/login.php");
        exit();
    }
}

elseif(isset($_SESSION['email'])) {
    $home = "http://localhost/comedhub/";
    $scheck = "SELECT * FROM students WHERE email = '".$_SESSION['email']."' AND sem = '$sem'";
    if(mysqli_num_rows(mysqli_query($conn, $scheck)) < 1) {
        echo "<script>alert('You are not allowed to access this page.');</script>";
        echo "<script>window.location.href='http://localhost/comedhub/';</script>";
        exit();
    }
}
else {
    // Redirect to the login page if not logged in
    header("Location: http://localhost/comedhub/student/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/burger.css">
    <link rel="stylesheet" href="../css/alignments.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/theme.css">
    <title>Home-Page</title>
</head>
<body class="bg">
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
            <?php
            if(isset($_SESSION['email'])) {
                echo "<a href='http://localhost/comedhub/admin/profile.php'><img src='../images/profile.png' alt='profile' class='' style='width: 65px; top: 4px; border: radius 50%; position:relative'></a>";
            } else {
                // Display the profile image for students
                echo "";
            }
            ?>
            <a href="http://localhost/comedhub/logout.php" class="mr2"><button class="h3 bg-red text-white" style='cursor:pointer'>Logout</button></a>
        </div>
    </Header>
    <div class="main flex">
        <div class="aside">
            <div class="asideNav sppl h90 m-0">
                    <a href="<?php echo"$home"; ?>"><li>Home</li></a>
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
            <?php
                // Displaying the subject name as a heading
                echo "<h1 class='bg-fourth text-white w-100 mt-0 text-center mb-0'>$subject</h1>";
            ?>
            <div class='flex flex-col justify-center h-50 w-60'>
            <!-- image of subject jpeg formate -->
             <?php
                echo"<img src='http://localhost/comedhub/images/$subject.jpg' class='w-100 p1 rounded m1 bg-white h-80 border-third' style='position:static' alt='img'>";
            ?>
            </div>
            <!-- code for displaying the subject materials goes here -->
            <div class='flex flex-col justify-start w-50'>
                <?php
                    // Fetching distinct folder names for the selected subject and semester
                    $dfold = 'SELECT DISTINCT foldname FROM files WHERE subject="'.$subject.'" AND sem = "'.$sem.'"';
                    $dfoldresult = mysqli_query($conn, $dfold);
                    while ($row = mysqli_fetch_assoc($dfoldresult)) {
                        $folderName = $row['foldname'];
                        echo "<details class='pl-0'>";
                        echo "<summary class='bg-fourth text-start pl3 rounded p1 f2 text-white text-bold mt2'>$folderName</summary>";
                        // Fetching files for the current folder name
                        echo "<div class='fdis flex flex-col bg-white p2 w-100 rounded'>";
                        $dfile = "SELECT * FROM files WHERE foldname='$folderName' AND subject='$subject' AND sem='$sem'";
                        $dfileResult = mysqli_query($conn, $dfile);
                        while ($fileRow = mysqli_fetch_assoc($dfileResult)) {
                            // Displaying each file as a link
                            echo "<a class='bg ml3 mt1 w-80 rounded m-0 text-none' href='{$fileRow['flink']}'>";
                                echo "<div class='flex items-center'>";
                                    echo"<img src='../images/{$fileRow['ftype']}.png' alt='file_type' class='w-10 pl3 h5'>";//filetype image
                                    echo"<p class='f2 text-black pl5'>|</p>";
                                    echo"<p class='text-center text-black w-30 f2'>{$fileRow['fname']}</p>";// filename
                                echo"</div>";
                            echo"</a>";
                        }
                        echo "</div>";
                        echo "</details>";
                        }
                ?>
            </div>
            <?php
                echo"<h4 class='bg w-100 mb-0 mt5 text-center '>© 2025 COMEDHUB. All rights reserved.</h4>";
            ?>
        </div>
    </div>
    <script src="../admin/burger.js"></script>
</body>
</html>