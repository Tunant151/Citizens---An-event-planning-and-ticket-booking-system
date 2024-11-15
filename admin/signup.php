<?php
  session_start();

  include("common/conn.php");
  if(!isset($_SESSION['valid'])){
    header("Location: ../login/login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add/Remove Users</title>
  <link rel="stylesheet" href="../css/login&signup.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">

  <style>
    .side-menu{
      position: absolute;
      left: 0;
    }

    #view_stakes a{
      color: crimson;
      text-decoration: none;
    }

    #view_stakes a:hover{
      text-decoration: underline;
    }

    #view_stakes{
      display: flex;
      width: 100%;
      justify-content: center;
      margin-top: 10px;
    }

    @media only screen and (max-width:820px){
      .side-menu{
        display: none;
      }
    }
  </style>
</head>
<body>
<?php

include("common/conn.php");

if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($conn, $_POST['username']); // Prevent SQL injection
  $password = mysqli_real_escape_string($conn, $_POST['password']); // Prevent SQL injection
  $email = mysqli_real_escape_string($conn, $_POST['email']); // Prevent SQL injection
  $role = mysqli_real_escape_string($conn, $_POST['role']); // Prevent SQL injection

  //check if exists already
  $check = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
  $result = mysqli_query($conn, $check);
  if(mysqli_num_rows($result) > 0){
    echo "<script>alert('The Email or Username already exist in the system');</script>";
  }else{
    $query = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
    mysqli_query($conn, $query);
    echo "<script>alert('The Username Has been added');</script>";
  }

  }
?>


  <!-- Side Menu -->
  <?php 
    include("common/sidemenu.php");
  ?>

  <div class="container">
    
  <header><i id="fa-bars" class="fa-solid fa-bars" style="color: #183153;" onclick="showMenu()"></i></header>
    <form class="signup-form" method="post">
      <div class="logo-container">
        <img src="../assets/img/logo.png" alt="logo for the Citizen" class="logo">
      </div>
      <h2>ADD USER</h2>
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="input-group">
        <label for="role">Role</label>
        <select id="role" name="role" required>
          <option value="admin">Admin</option>
          <option value="stakeholder">Stakeholder</option>
          <option value="steward">Steward</option>
        </select>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" name="submit">Add User</button>
      <div id="view_stakes">
          <a href="remove_users.php">Click here to remove User</a>
        </div>
    </form>
  </div>


  <script src="common/sidemenu.js"></script>
</body>
</html>
