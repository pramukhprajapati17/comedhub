<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: http://localhost/comedhub/student/login.php");
    exit();
}

$email = $_SESSION['email'];
$message = '';

if (isset($_POST['updatePassword'])) {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    // Fetch existing password
    $sql = "SELECT password FROM students WHERE email = '$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['password'] !== $current) {
        $message = "Current password is incorrect.";
    } elseif ($new !== $confirm) {
        $message = "New passwords do not match.";
    } elseif (strlen($new) < 6) {
        $message = "Password must be at least 6 characters.";
    } else {
        $updateSQL = "UPDATE students SET password = '$new' WHERE email = '$email'";
        if ($conn->query($updateSQL) === TRUE) {
            echo "<script>alert('Password updated successfully!');</script>";
            echo "<script>window.location.href='http://localhost/comedhub/student/profile.php';</script>";
        } else {
            $message = "Error updating password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Update Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/adminlogin.css" />
  <link rel="stylesheet" href="../css/theme.css" />
  <link rel="stylesheet" href="../css/alignments.css" />
  <link rel="stylesheet" href="../css/form.css" />
</head>
<body class="bg-freeze flex justify-center items-center h-screen" style="overflow-y: auto;">
  <div class="bg-white w-30 rounded border-third shadow p3">
    <img src="../images/logo.png" alt="Logo" class="logo block m-auto mb2" />
    <h2 class="text-center text-fourth f3 mb3">Update Password</h2>

    <?php if (!empty($message)): ?>
      <p class="text-center mb2 bg-red p1 rounded text-white"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" class="w-100">
      <div class="mb2">
        <label class="text-fourth text-bold">Current Password</label>
        <input type="password" name="current_password" required class="input w-100" />
      </div>

      <div class="mb2">
        <label class="text-fourth text-bold">New Password</label>
        <input type="password" name="new_password" required minlength="6" class="input w-100" />
      </div>

      <div class="mb3">
        <label class="text-fourth text-bold">Confirm New Password</label>
        <input type="password" name="confirm_password" required class="input w-100" />
      </div>

      <div class="flex justify-between items-center">
        <input type="submit" name="updatePassword" value="Update Password" class="btn-login bg-fourth text-white w-50" />
        <a href="profile.php" class="text-fourth text-none">Back to Profile</a>
      </div>
    </form>
  </div>
</body>
</html>
