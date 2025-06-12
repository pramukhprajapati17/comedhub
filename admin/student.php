<?php
include '../connection.php'; // Include your database connection file
if (!$conn) {
    echo "<Script>window.location.href='http://localhost/comedhub/404.html';</script>";
}

// Check if the user is logged in as admin
session_start();
if(!isset($_SESSION['admin'])) {
    // Redirect to the login page if not logged in
    header("Location: http://localhost/comedhub/admin/login.php");
    exit();
}
$home = "http://localhost/comedhub/admin";

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
            <div class="burger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <img src="http://localhost/comedhub/images/logo.png" alt="Logo" class='w5 mr2 ml1'>
            <h1 class="title text-white" >COMPEDHUB</h1>
        </div>
        <div class="rightHeader flex items-center justify-end w-50">
            <a href="http://localhost/comedhub/logout.php" class="mr2"><button style="cursor:pointer" class="h3 text-white bg-red">Logout</button></a>
        </div>
    </Header>
    <div class="main flex">
        <div class="aside">
            <div class="asideNav h90 m-0">
                    <a href="<?php echo"$home"; ?>"><li>Home</li></a>
                    <details>
                        <summary>Semesters</summary>
                            <?php
                                // select sem unique from database
                                $sem = "SELECT DISTINCT sem FROM files";
                                $resultsem = $conn->query($sem);
                                // select subject unique from database
                                
                                if ($resultsem->num_rows > 0) {
                                    while ($semrow = $resultsem->fetch_assoc()) {
                                        $subject = "SELECT DISTINCT subject FROM files WHERE sem = '{$semrow['sem']}'";
                                        $resultsubject = $conn->query($subject);
                                        echo "<details>";
                                        echo "<summary>Semester-".$semrow['sem']."</summary>";
                                        while ($subjectrow = $resultsubject->fetch_assoc()) {
                                            echo "<a href='http://localhost/comedhub/subjects/{$subjectrow['subject']}.php'><li>".$subjectrow['subject']."</li></a>";
                                        }
                                        echo "</details>";
                                    }                          
                                }
                                 else {
                                    echo "<div class='w50 bg mt5 p4'>No Semesters Found Please Add the Materials!</div>";
                                }
                            ?>
                    </details>
                    <a href="http://localhost/comedhub/admin/student.php" class='bg-fourth text-white'><li>Students</li></a>
                </ol>
            </div>
        </div>
        <!-- content starts -->
        <div class="content flex flex-col items-center">
            <div class="border-third w-50 mt2 bg-fourth">
                <!-- admin data enter form -->
                <div class="flex items-center justify-center">
                    <h1 class='p-0 m-0'>Students Data</h1>
                </div>
            </div>
            <div>
                <?php
                    // select sem unique from database
                    $sem = "SELECT DISTINCT sem FROM students";
                    $resultsem = $conn->query($sem);
                    if ($resultsem->num_rows > 0) {
                        while ($semrow = $resultsem->fetch_assoc()) {
                            echo "<table border='2' style='width:70vw; margin-top:40px;' class='border-third text-center'>";
                                echo "<tr><th colspan='9' class='bg-fourth text-white f2'>Semester-".$semrow['sem']."</th></tr>";
                                echo "<tr class='bg-secondary text-fourth'>
                                            <th>Email</th>
                                            <th>First name</th>
                                            <th>Last Name</th>
                                            <th>Enrollment</th>
                                            <th>Course</th>
                                            <th>College</th>
                                            <th>University</th>
                                            <th>City</th>
                                            <th>Mobile</th>
                                        </tr>";
                                // select whole files table from database
                                $stu = "SELECT * FROM students WHERE sem='{$semrow['sem']}'";
                                $resultstu = $conn->query($stu);
                                if ($resultstu->num_rows > 0) {
                                    while ($sturow = $resultstu->fetch_assoc()) {
                                        echo "
                                            <tr class='bg-white'>
                                                <td>{$sturow['email']}</td>
                                                <td>{$sturow['fname']}</td>
                                                <td>{$sturow['lname']}</td>
                                                <td>{$sturow['enrollment']}</td>
                                                <td>{$sturow['course']}</td>
                                                <td>{$sturow['college']}</td>
                                                <td>{$sturow['university']}</td>
                                                <td>{$sturow['city']}</td>
                                                <td>{$sturow['mobile']}</td>
                                            </tr>
                                        ";
                                    }
                                }
                                echo "</table>";
                        }
                    } else {
                        echo "<div class='w50 bg-white mt5 p4'>No Students Registered</div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="./delete.js"></script>
    <script src="./edit.js"></script>
</body>
</html> 