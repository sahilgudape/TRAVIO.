<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page or handle the case when the user is not logged in
  header('Location: login.php');
  exit;
}

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the submitted password
  $newPassword = $_POST['new_password'];

  // Validate and update the password in the database
  if (!empty($newPassword)) {
    // Replace 'your_database_name' with the actual name of your database
    // Replace 'your_username' and 'your_password' with your database credentials
    $conn = new PDO('mysql:host=localhost;dbname=travel', 'root', '');
    $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :user_id");
    $stmt->bindParam(':password', $newPassword);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    echo "<script>alert('Password Changed Successfully');</script>";
    // Redirect to a success page or perform any other desired action
    header('Location: update-profile.php');
    exit;
  } else {
    $error = "Please enter a new password.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Profile - Travel Webpage</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Travel Webpage</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav ml-auto">
      
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Book A Tour</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="my-bookings.php">My Bookings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact-support.php">Contact Support</a>
        </li>
      </ul>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      
        <li class="nav-item">
          <a class="nav-link active" href="update-profile.php">Update Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container mt-5">
    <h2>Update Profile</h2>
    <?php if (isset($error)) : ?>
      <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="form-group">
        <label for="new_password">New Password:</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
      </div>
      <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
  </div>
  <footer class="footer">
  <nav class="navbar fixed-bottom navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand text-center" href="#">© 2023 Travel Webpage. All rights reserved.</a>
  </div>

    </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
