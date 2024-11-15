<?php
  session_start();

  include("../admin/common/conn.php");
  if(!isset($_SESSION['valid'])){
    header("Location: ../login/login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" href="css/profile.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">

  <style>
    
      .menu-items {
        list-style: none;
        padding: 0;
        margin-top: 100px;
      }
    /* Mobile view*/
    @media only screen and (max-width:820px){
      .main-content{
        width: 100%;
        padding: 0;
        z-index: -1;
      }
      .cancel-event-page{
        width: 100%;
        margin-top: 0;
      }
      


    } 
  </style>
<body>

  <!-- Side Menu -->
  <?php 
    include("common/sidemenu.php");
    $query = "SELECT * FROM users WHERE id = '$_SESSION[id]' ";
    $query_run = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($query_run);
  ?>

  <div class="main-content">
    <!-- Profile Section -->
    <div class="profile-page">
    <header><i id="fa-bars" class="fa-solid fa-bars" style="color: #183153;" onclick="showMenu()"></i></header>
      <h1>Profile</h1>


<?php
if(isset($_POST['submit'])){
  if($_POST['password'] == $_POST['confirmPassword']){
      $id = $_SESSION['id'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $query = "UPDATE users SET username=?, email=?, password=? WHERE id = ?";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $password, $id);
      $result = mysqli_stmt_execute($stmt);

      if ($result) {
          echo "<script>alert('The Details were updated successfully');</script>";
          header("Location: profile.php");
      } else {
          echo "<script>alert('Failed to update details');</script>";
      }

      mysqli_stmt_close($stmt);
  } else {
      echo "<script>alert('The passwords do not match');</script>";
  }
  
}
?>


      <form method="POST">
        <div class="form-group">
          <label for="fullName">UserName:</label>
          <input type="text" id="username" name="username" value="<?php echo $result['username']; ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo $result['email']; ?>" required>
        </div>
        <div class="form-group">
          <label for="password">New Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm New Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="form-group">
          <button type="submit" name="submit">Update Profile</button>
        </div>
      </form>
    </div>
  </div>

<script src="common/sidemenu.js"></script>
</body>
</html>
