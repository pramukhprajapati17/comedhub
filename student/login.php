<?php
  include '../connection.php'; // Include your database connection file
  if (!$conn) {
      echo "<script>window.location.href='http://localhost/comedhub/404.html';</script>";
  }
  session_start(); // Start the session
  if(isset($_SESSION['email'])) {
      // Redirect to the login page if not logged in
      header("Location: http://localhost/comedhub/student/");
      exit();
  }
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Validate user credentials
      $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          // User found, redirect to student dashboard
          echo "<script>alert('Login successful!');</script>";
          // Start session and set session variables if needed
          session_start();
          $_SESSION['email'] = $email; // Store email in session
          echo "<script>window.location.href='http://localhost/comedhub/';</script>";
      } else {
          // Invalid credentials
          echo "<script>alert('Invalid username or password');</script>";
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Login - COMPEDHUB</title>
  <link rel="stylesheet" href="../css/adminlogin.css" />
  <link rel="stylesheet" href="../css/theme.css" />
  <link rel="stylesheet" href="../css/alignments.css" />
</head>
<body class="bg flex justify-center items-center h-screen">
  <div class="login-container bg-white rounded shadow p3">
    <img src="../images/logo.png" alt="COMPEDHUB Logo" class="logo block m-auto mb2" />
    <h2 class="text-center text-fourth f3 mb3">Student Login</h2>
    <form action="login.php" method="POST" class="flex flex-col m1">
      <input type="email" name="email" placeholder="Student Username" required class="input mb2" />
      <input type="password" name="password" placeholder="Password" required class="input mb2" />
      <button type="submit" class="btn-login bg-fourth text-white f2">Login</button>
    </form>
    <div class="text-center mt2 flex justify-center">
      <a href="http://localhost/comedhub/admin/login.php" class="text-fourth mr3">Login as Admin?</a>
      <a href="http://localhost/comedhub/student/registration.php" class="text-fourth ml3">Register?</a>
    </div>
  </div>
</body>
</html>