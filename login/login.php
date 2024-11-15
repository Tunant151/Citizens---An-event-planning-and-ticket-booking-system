<?php
  session_start();
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Citizens | Log-in</title>
  <link rel="stylesheet" href="../css/login&signup.css">
</head>
<body>
<div class="container">
<?php

include("../admin/common/conn.php");

if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($conn, $_POST['username']); // Prevent SQL injection
  $password = mysqli_real_escape_string($conn, $_POST['password']); // Prevent SQL injection

  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if($result && mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);

    $_SESSION['valid'] = $row['email'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['id'] = $row['id'];

    if($_SESSION['role'] == "admin"){
      header("Location: ../admin/index.php");
      exit();
    } elseif ($_SESSION['role'] == "stakeholder") {
      header("Location: ../stakeholders/index.php");
      exit();
    } elseif ($_SESSION['role'] == "steward") {
      header("Location: ../steward/index.php");
      exit();
    }
  } else {
    echo "<script>
            alert('The username and Password is incorrect');
            window.location.href = 'login.php'; // Redirect to login page
          </script>";
  }
}
?>
  
    <form class="login-form" method="post">
      <a class="logo-container" href="../">
        <img src="../assets/img/logo.png" alt="logo for the Citizen" class="logo">
      </a>
      <h2>Login</h2>
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" name="submit">Login</button>
    </form>   
</div>
</body>
</html>