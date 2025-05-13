<?php
include '../connection.php'; // Include your database connection file
if (!$conn) {
    echo "<Script>window.location.href='http://localhost/comedhub/404.html';</script>";
}
$sem = 1; // set the semester
// Check if the user is logged in
session_start();
  if (!isset($_SESSION['email'])) {
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

if (isset($_POST['updateProfile'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $enrollment = $_POST['enrollment'];
    $sem = $_POST['sem'];
    $course = $_POST['course'];
    $college = $_POST['college'];
    $university = $_POST['university'];
    $city = $_POST['city'];
    $mobile = $_POST['mobile'];

    $updateSQL = "UPDATE students SET 
        fname='$fname',
        lname='$lname',
        enrollment='$enrollment',
        sem='$sem',
        course='$course',
        college='$college',
        university='$university',
        city='$city',
        mobile='$mobile'
        WHERE email='$email'";

    if ($conn->query($updateSQL) === TRUE) {
        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating profile: " . $conn->error . "');</script>";
    }
}

$sql = "SELECT * FROM students WHERE email = '$email'";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
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
    <link rel="stylesheet" href="../css/adminlogin.css">
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
                echo "<a href='http://localhost/comedhub/student/profile.php'><img src='../images/profile.png' alt='profile' class='' style='width: 65px; top: 4px; border: radius 50%; position:relative'></a>";
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
                    <a href="http://localhost/comedhub/"><li>Home</li></a>
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
        <div class="bg-white w-40 rounded border-third shadow m5 p3">
              <a href="http://localhost/comedhub/"><img src="../images/logo.png" class="logo block m-auto mb2 w-30" alt="Logo" /></a>
              <h2 class="text-center text-fourth f3 mb3">Your Profile</h2>
              <form method="POST" class="w-100">
                <div class="mb3">
                  <label class="text-fourth text-bold">Email (Read Only)</label>
                  <input type="email" value="<?= $student['email'] ?>" readonly class="input w-100" />
                </div>  
                <div class="mb2">
                  <label class="text-fourth text-bold">First Name</label>
                  <input type="text" name="fname" value="<?= $student['fname'] ?>" required class="input w-100" />
                </div>

                <div class="mb2">
                  <label class="text-fourth text-bold">Last Name</label>
                  <input type="text" name="lname" value="<?= $student['lname'] ?>" required class="input w-100" />
                </div>

                <div class="mb2">
                  <label class="text-fourth text-bold">Enrollment No.</label>
                  <input type="text" name="enrollment" value="<?= $student['enrollment'] ?>" required class="input w-100" />
                </div>

                <div class="mb2">
                  <label class="text-fourth text-bold">Semester</label>
                  <input type="number" name="sem" value="<?= $student['sem'] ?>" min="1" max="12" required class="input w-100" />
                </div>

                <div class="mb2">
                  <label class="text-fourth text-bold">Course</label>
                  <input type="text" name="course" value="<?= $student['course'] ?>" required class="input w-100" />
                </div>

                <div class="mb2">
                  <label class="text-fourth text-bold">College</label>
                  <input type="text" name="college" value="<?= $student['college'] ?>" required class="input w-100" />
                </div>

                <div class="mb2">
                  <label class="text-fourth text-bold">University</label>
                  <input type="text" name="university" value="<?= $student['university'] ?>" required class="input w-100" />
                </div>

                <div class="mb2">
                  <label class="text-fourth text-bold">City</label>
                  <input type="text" name="city" value="<?= $student['city'] ?>" required class="input w-100" />
                </div>

                <div class="mb3">
                  <label class="text-fourth text-bold">Mobile Number</label>
                  <input type="tel" name="mobile" value="<?= $student['mobile'] ?>" pattern="[0-9]{10}" required class="input w-100" />
                </div>
                <div class="mb2 flex justify-end items-center">
                  <a href="updatepassword.php" class="text-fourth text-none">Change Password</a>
                </div>
                <div class="flex justify-between items-center">
                  <input type="submit" name="updateProfile" value="Update" class="btn-login bg-fourth text-white w-50" />
                  <a href="http://localhost/comedhub" class="text-fourth text-none">Back to home</a>
                </div>
              </form>
            </div>
            <?php
                echo"<h4 class='bg w-100 mb-0 mt5 text-center '>© 2025 COMPEDHUB. All rights reserved.</h4>";
            ?>
        </div>
    </div>
    <script src="../admin/burger.js"></script>
</body>
</html> 