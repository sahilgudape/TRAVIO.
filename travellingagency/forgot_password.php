<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password - Travel Webpage</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f5f5f5;
    }

    .container {
      max-width: 400px;
      margin-top: 50px;
    }

    .logo {
      text-align: center;
      margin-bottom: 30px;
    }

    .logo-img {
      width: 150px;
      height: auto;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="./Images/logotr.png" alt="Logo" class="logo-img">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="logo">
      <img src="./Images/logotr.png" alt="Logo" class="logo-img">
    </div>
    <h2 class="text-center">Forgot Password</h2>
    <?php
      require_once './db/db_connection.php'; // Include the database connection file

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form data
        $username = $_POST['username'];

        // Check if the username exists in the database
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          // Username exists, proceed with password change
          // You can implement the password change logic here
          echo '<div class="alert alert-success">Password change request received. Please check your email for further instructions.</div>';
        } else {
          echo '<div class="alert alert-danger">Invalid username. Please try again.</div>';
        }
      }
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
