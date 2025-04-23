<?php
include '../connection.php'; 
if (!$conn) {
    echo "<script>window.location.href='http://localhost/comedhub/404.html';</script>";
}
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: http://localhost/comedhub/admin/login.php");
    exit();
}

// Check if the form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $subjecta = $_POST['subject'];
  $sema = $_POST['sem'];
  $subimg=$_FILES['subimg'];
//write1
  $write1 = "<?php
include '../connection.php'; // Include your database connection file
\$sem = $sema; // set the semester
\$subject = '$subjecta'; // Set the subject name";
// write2
  $write2 = file_get_contents("../subjects/subject.txt");
//check if the subject already exists
  if(file_exists("../images/$subjecta.jpg")){
    echo "<script>alert('Subject Already Exists');window.location.href='newsubject.php'</script>";
    exit();
  }
  elseif(file_exists("../subjects/$subjecta.php")){
    echo "<script>alert('Subject Already Exists');window.location.href='newsubject.php'</script>";
    exit();
  }
  //img and files writing
  else{
    // Move Image to the images directory
    move_uploaded_file($subimg['tmp_name'], "../images/".$subjecta.".jpg");
    
    // Create the subject file and write the content
    $fptr = fopen("../subjects/$subjecta.php", "w");
    fwrite($fptr, $write1);
    fwrite($fptr, $write2);
    echo "<script>alert('Subject Added successfully!');window.location.href='http://localhost/comedhub/admin/'</script>";
    fclose($fptr);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add New Subject - COMPEDHUB</title>
  <link rel="stylesheet" href="../css/adminlogin.css" />
  <link rel="stylesheet" href="../css/theme.css" />
  <link rel="stylesheet" href="../css/alignments.css" />
</head>
<body class="bg flex justify-center items-center h-screen">
  <div class="login-container bg-white rounded shadow p3">
    <img src="../images/logo.png" alt="COMPEDHUB Logo" class="logo block m-auto mb2" />
    <h2 class="text-center text-fourth f3 mb3">Add New Subject</h2>
    <form action="newsubject.php" method="POST" enctype="multipart/form-data" class="flex flex-col m1">
      <input type="text" name="subject" placeholder="Subject Name" required class="input mb2" />
      <input type="number" name="sem" min='1' placeholder="Semester (e.g., 1, 2, 3...)" required class="input mb2" />
      <input type="file" name="subimg" class="input mb2" required/>
      <button type="submit" class="btn-login bg-fourth text-white f2">Add Subject</button>
    </form>
    <div class="text-center mt2">
      <a href="http://localhost/comedhub/admin" class="text-fourth">Back to Home</a>
    </div>
  </div>
</body>
</html>