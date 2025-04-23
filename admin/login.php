<?php
  include '../connection.php'; // Include your database connection file
  if (!$conn) {
      echo "<script>window.location.href='http://localhost/comedhub/404.html';</script>";
  }
  session_start(); // Start the session
  if(isset($_SESSION['admin'])) {
      // Redirect to the home page if already logged in
      header("Location: http://localhost/comedhub/admin");
      exit();
  }
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $uname = $_POST['uname'];
      $password = $_POST['password'];

      // Validate user credentials
      $sql = "SELECT * FROM admin WHERE uname='$uname' AND password='$password'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          // User found, redirect to student dashboard
          echo "<script>alert('Login successful!');</script>";
          // Start session and set session variables if needed
          session_start();
          $_SESSION['admin'] = $uname; // Store email in session
          echo "<script>window.location.href='http://localhost/comedhub/admin';</script>";
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
  <title>Admin Login - COMPEDHUB</title>
  <link rel="stylesheet" href="../css/adminlogin.css" />
  <link rel="stylesheet" href="../css/theme.css" />
  <link rel="stylesheet" href="../css/alignments.css" />
</head>
<body class="bg flex justify-center items-center h-screen">
  <div class="login-container bg-white rounded shadow p3 ">
    <img src="../images/logo.png" alt="COMPEDHUB Logo" class="logo block m-auto mb2" />
    <h2 class="text-center text-fourth f3 mb3">Admin Login</h2>
    <form action="login.php" method="POST" class="flex flex-col m1">
      <input type="text" name="uname" placeholder="Admin Username" required class="input mb2" />
      <input type="password" name="password" placeholder="Password" required class="input mb2" />
      <button type="submit" class="btn-login bg-fourth text-white f2">Login</button>
    </form>
    <div class="text-center mt2">
      <a href="http://localhost/comedhub/student/login.php" class="text-fourth">Login as Student?</a>
      <!-- <a href="" class="text-fourth ml3">Register?</a> -->
    </div>
  </div>
</body>
</html>