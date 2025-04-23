<?php
  include '../connection.php'; // Include your database connection file
  if (!$conn) {
      echo "<script>window.location.href='http://localhost/comedhub/404.html';</script>";
  }
  if(isset($_POST['Register'])) {
      $email = $_POST['email'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $enrollment = $_POST['enrollment'];
      $sem = $_POST['sem'];
      $course = $_POST['course'];
      $college = $_POST['college'];
      $university = $_POST['university'];
      $city = $_POST['city'];
      $mobile = $_POST['mobile'];
      $password = $_POST['password'];
      
      // Insert into database
      $sql = "INSERT INTO students (email, fname, lname, enrollment, sem, course, college, university, city, mobile, password) VALUES ('$email', '$fname', '$lname', '$enrollment', '$sem', '$course', '$college', '$university', '$city', '$mobile', '$password')";
      
      if ($conn->query($sql) === TRUE) {
          echo "<script>alert('Registration successful!');</script>";
          echo "<script>window.location.href='http://localhost/comedhub/student/login.php'</script>";
      } else {
          echo "<script>alert('Error: " . $conn->error . "');</script>";
      }
  }

?>
<!-- html starts -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Registration - COMPEDHUB</title>
  <link rel="stylesheet" href="../css/adminlogin.css" />
  <link rel="stylesheet" href="../css/theme.css" />
  <link rel="stylesheet" href="../css/alignments.css" />
  <link rel="stylesheet" href="../css/form.css" />
</head>
<body class="bg flex justify-center items-center h-screen" style="overflow-y: scroll;">
  <div class="registration-container bg-white w-50 rounded shadow p3 border-third">
    <img src="../images/logo.png" alt="COMPEDHUB Logo" class="logo block m-auto mb2" />
    <h2 class="text-center text-fourth f3 mb3">Student Registration</h2>
    <form action="registration.php" method="POST" class="text-center" onsubmit="return validateForm()">
      <div class="flex w-100 m1 items-center justify-center">
        <input type="email" name="email" placeholder="Email ID" required class="input w-60 ml1 text-center" />
      </div>
      <div class="flex w-100 m1 items-center justify-center" style="flex-wrap: wrap;">
        <input type="text" name="fname" placeholder="First Name" required pattern="[A-Za-z]{2,}" title="Enter a valid first name" class="input mr2 mb2" />
        <input type="text" name="lname" placeholder="Last Name" required pattern="[A-Za-z]{2,}" title="Enter a valid last name" class="input mr2 mb2" />
        <input type="text" name="enrollment" placeholder="Enrollment Number" required pattern="[A-Za-z0-9]{6,}" title="Minimum 6 characters" class="input mr2 mb2" />
        <input type="number" name="sem" placeholder="Current Semester" required pattern="[1-9]|1[0-2]" min="1" title="Enter a valid semester (1-12)" class="input mr2 mb2" />
        <input type="text" name="course" placeholder="Course Name" required class="input mr2 mb2" />
        <input type="text" name="college" placeholder="College Name" required class="input mr2 mb2" />
        <input type="text" name="university" placeholder="University Name" required class="input mr2 mb2" />
        <input type="text" name="city" placeholder="City/Village" required class="input mr2 mb2" />
        <input type="tel" name="mobile" placeholder="Mobile Number" required pattern="[0-9]{10}" title="Enter a 10-digit mobile number" class="input mr2 mb2" />
        <input type="password" id="password" name="password" placeholder="Password" required minlength="6" title="Minimum 6 characters" class="input mr2 mb2" />
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required class="input mr2 mb2" />
      </div>
      <div class="flex w-90 pl4 justify-between items-center">
        <input type="submit" value="Register" name="Register" class="btn-register bg-fourth text-white rounded p1 ml1">
        <a href="http://localhost/comedhub/student/login.php" class="text-fourth mr2">Already have an account? Login</a>
      </div>
    </form>
    <script src="validateReg.js"></script>
  </div>
</body>
</html>