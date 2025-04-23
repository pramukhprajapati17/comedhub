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
    <link rel="stylesheet" href="../css/form.css">
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
            <a href="http://localhost/comedhub/logout.php" class="mr2"><button style="cursor:pointer" class="h3 bg-red text-white">Logout</button></a>
        </div>
    </Header>
    <div class="main flex">
        <div class="aside">
            <div class="asideNav h90 m-0">
                    <a href="http://localhost/comedhub/admin/" class='bg-fourth text-white'><li>Home</li></a>
                    <details>
                        <summary>Semesters</summary>
                            <?php
                                // select sem unique from database
                                $sem = "SELECT DISTINCT sem FROM files";
                                $resultsem = $conn->query($sem);
                                if ($resultsem->num_rows > 0) {
                                    while ($semrow = $resultsem->fetch_assoc()) {
                                        echo "<details>";
                                        echo "<summary>Semester-".$semrow['sem']."</summary>";
                                        // select subject unique from database
                                        $subject = "SELECT DISTINCT subject FROM files WHERE sem = '{$semrow['sem']}'";
                                        $resultsubject = $conn->query($subject);
                                        while ($subjectrow = $resultsubject->fetch_assoc()) {
                                            echo "<a href='http://localhost/comedhub/subjects/{$subjectrow['subject']}.php'><li>".$subjectrow['subject']."</li></a>";
                                        }
                                        echo "</details>";
                                    }                          
                                }
                                 else {
                                    echo "<div class='w50 bg-white mt5 mb-0 p4'>No Semesters Found Please Add the Materials!</div>";
                                }
                            ?>
                    </details>
                    <a href="http://localhost/comedhub/admin/student.php"><li>Students</li></a>
                </ol>
            </div>
        </div>
        <!-- content starts -->
        <div class="content flex flex-col items-center">
            <div class="border-third w-50 mt2 p1 bg-white">
                <!-- admin data enter form -->
                <div class="flex items-center justify-center rounded p1">
                    <form action="./files.php" class="flex flex-col justify-center insertform">
                        <h1 class="text-center w30 border-fourth mt1 text-white bg-fourth rounded">Add New Materials</h1>
                        <div class="justify-center form1">
                            <input type="number" name="sem" min="1" max="8" pattern="[0-8]" placeholder="Sem" class="p1 ml2 mr1 " required>
                            <input type="number" name="code" id="code" min="1" maxlength="10" placeholder="Subject Code" class="mr1 p1" required>
                            <input type="text" name="subject" id="subject" placeholder="Subject Name" class="p1" required>
                        </div><br>
                        <div class="flex justify-start form2">
                            <input type="text" name="foldname" id="foldname" placeholder="Folder Name" class="p1 ml2 mr5 w9" required>
                            <input type="text" name="fname" id="fname" placeholder="File Name" class="p1 ml5">
                        </div>
                        <div class="flex flex-col justify-start form2">
                            <input type="text" name="ftype" id="ftype" placeholder="File type" class="p1 ml2 mt1" style="width: 440px;">
                            <input type="text" name="flink" id="flink" placeholder="Material's Link" class="p1 ml2 mt1" style="width: 440px;">
                        </div>
                        <div class="flex justify-between form2">
                            <input type="submit" style="width: 100px; height: 30px;" class="login-btn bg-fourth text-white mt1 ml2">
                            <a href="http://localhost/comedhub/admin/newsubject.php" class="mt2">Add New Subject</a>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <?php
                    // select sem unique from database
                    $sem = "SELECT DISTINCT sem FROM files";
                    $resultsem = $conn->query($sem);
                    if ($resultsem->num_rows > 0) {
                        while ($semrow = $resultsem->fetch_assoc()) {
                            echo "<table border='2' style='width:70vw; margin-top:40px;' class='border-third text-center'>";
                                echo "<tr><th colspan='7' class='bg-fourth text-white f2'>Semester-".$semrow['sem']."</th></tr>";
                                echo "<tr class='bg-secondary text-fourth'>
                                            <th>Subject Code</th>
                                            <th>Subject</th>
                                            <th>Folder Name</th>
                                            <th>File Name</th>
                                            <th>File Type</th>
                                            <th>Link</th>
                                            <th>Delete</th>
                                        </tr>";
                                // select whole files table from database
                                $files = "SELECT * FROM files WHERE sem='{$semrow['sem']}'";
                                $resultfiles = $conn->query($files);
                                if ($resultfiles->num_rows > 0) {
                                    while ($filesrow = $resultfiles->fetch_assoc()) {
                                        echo "
                                            <tr class='bg-white'>
                                                <td>{$filesrow['code']}</td>
                                                <td>{$filesrow['subject']}</td>
                                                <td>{$filesrow['foldname']}</td>
                                                <td>{$filesrow['fname']}</td>
                                                <td>{$filesrow['ftype']}</td>
                                                <td><a href='{$filesrow['flink']}' target='_blank'>Click Here</a></td>
                                                <td style='padding: 8px;'><button onclick=\"deleteRow('" . addslashes($filesrow['sem']) . "', '" . addslashes($filesrow['subject']) . "', '" . addslashes($filesrow['foldname']) . "', '" . addslashes($filesrow['fname']) . "', '" . addslashes($filesrow['ftype']) . "')\" style='background-color:red; color:white; cursor:pointer;'>Delete</button></td>
                                            </tr>
                                        ";
                                    }
                                }
                                echo "</table>";
                        }
                    } else {
                        echo "<div class='w50 bg mt5 p4'>No Materials Found Please Add the Materials!</div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="./delete.js"></script>
    <script src="./burger.js"></script>
</body>
</html> 