<!DOCTYPE html>
<html>
<head>
  <title>Login - Travel Webpage</title>
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
    <a class="navbar-brand" href="index.html">
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
    <h2 class="text-center">Login</h2>
    <?php
      session_start();
      require_once './db/db_connection.php'; // Include the database connection file

      // Check if the user is already logged in
      if (isset($_SESSION['user_id'])) {
        header('Location: dashboard.php'); // Redirect to the dashboard if the user is already logged in
        exit;
      }

      // Check if the form is submitted
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Perform the login verification
        $stmt = $connection->prepare("SELECT id FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Check if the login was successful
        if ($stmt->rowCount() > 0) {
          // Set the session variables
          $user = $stmt->fetch(PDO::FETCH_ASSOC);
          $_SESSION['user_id'] = $user['id'];

          echo '<div class="alert alert-success">Login successful!</div>';
          // Redirect to the dashboard or homepage
          // Replace 'dashboard.php' with the appropriate destination URL
          header('Location: dashboard.php');
          exit;
        } else {
          echo '<div class="alert alert-danger">Invalid username or password. Please try again.</div>';
        }
      }
    ?>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
      <div class="text-center mt-3">
        <a href="register.php" class="btn btn-link">Register</a>
        <a href="forgot_password.php" class="btn btn-link">Forgot Password</a>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
