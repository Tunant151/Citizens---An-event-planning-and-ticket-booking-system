<?php
  session_start();

  include("common/conn.php");
  if (!isset($_SESSION['valid'])) {
    header("Location:../login/login.php");
  }
  if (!$_SESSION['role'] == "admin") {
    header("Location:../login/login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stakes & Holdings</title>
  <link rel="stylesheet" href="css/style.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="css/cancelled_style.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">
  <style>
    /* Event bubbles style */
   .main-content {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
   .event-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
    }
    form {
      width: 500px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input {
      color: #000;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 5px;
      font-size: 16px;
      border: 1px solid #ccc;
      color: #000;
    }

    button[type="submit"] {
      width: 100%;
      background: #041b89;
      color: #fff;
      border: 0;
      padding: 10px;
      font-size: 16px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background: #041b10;
    }

    form h2 span {
      color: #fa1;
    }

    form a{
      text-decoration: none;
    }

    form a:hover{
      text-decoration: underline;
    }

    #view_stakes{
      display: flex;
      width: 100%;
      justify-content: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="admin-dashboard">

  <!-- Side Menu -->
  <?php
    include("common/sidemenu.php");
 ?>

  <!-- Main Content Area -->
  <div class="main-content">

    <!-- Form Stakes-->
    <div class="form-container">
      <!-- Form -->
      <form action="" method="post">
        <h2>Add <span>STA</span>KES</h2>
        <br>
        <br>
        <div class="form-group">
          <label for="stakeholder-name">Stake Holder Name:</label>
          <select class="form-control" id="stakeholder-name" name="stakeholder-name">
            <option value="">Select the Stakeholder</option>
            <?php
             $query = "SELECT * FROM users WHERE role='stakeholder'";
             $stakeholders = mysqli_query($conn, $query);

            // Loop through the results and display them in the select box
            foreach ($stakeholders as $stakeholder) {
              echo '<option value="'. $stakeholder['username']. '">'. $stakeholder['username']. '</option>';
            }
           ?>
          </select>
        </div>
        <br>
        <div class="form-group">
          <label for="event-name">Event To Stake:</label>
          <select class="form-control" id="event-name" name="event-name">
            <option value="">Choose an event</option>
            <?php
             $query = "SELECT * FROM events";
             $events  = mysqli_query($conn, $query);
             while ($row = mysqli_fetch_array($events)) {
              echo '<option value="'. $row['event']. '">'. $row['event']. '</option>';
            }
           ?>
          </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="addStake">Add Stake</button>
        <div id="view_stakes">
          <a href="view_stakes.php">Click here for Holders and stakes</a>
        </div>
        
      </form>

<!-- ##################################################
################################################## -->
<!-- THE POST METHOD NDAYIKA APAPA -->
<!-- ##################################################
################################################## -->

<?php
  if (isset($_POST["addStake"])) {
    //get values
    $stakeholder_name = $_POST["stakeholder-name"];
    $event_name = $_POST["event-name"];
    

    //check if the stakeholder has already been added to the event
    $query = "SELECT * FROM stakeholder_stake WHERE name = '$stakeholder_name' AND event = '$event_name'";
    $query_run = mysqli_query($conn, $query);

    $query_error_check = "SELECT * FROM users WHERE username = '$stakeholder_name'";
    $query_error_check_run = mysqli_query($conn, $query_error_check);

    $query_error_check2 = "SELECT * FROM events WHERE event = '$event_name'";
    $query_error_check_run2 = mysqli_query($conn, $query_error_check2);

    if(mysqli_num_rows($query_error_check_run) <= 0 ){
      echo "<script>alert('Error: Selected cliteria is not valids.');</script>";
    }
    elseif (mysqli_num_rows($query_error_check_run2) <= 0 ) {
      echo "<script>alert('Error: Selected cliteria is not valids.');</script>";
    }elseif (mysqli_num_rows($query_run) > 0) {
      echo "<script>alert('The Stake Already exists.');</script>";
    } else {
      //insert into database
      $query = "INSERT INTO stakeholder_stake (name, event) VALUES ('$stakeholder_name', '$event_name')";
      $result = mysqli_query($conn, $query);
      if($result){
        echo "<script>alert('Stake added successfully.');</script>";
      }
    }
  }
?>
    </div>

  </div>
</div>

<script src="common/sidemenu.js"></script>
</body>
</html>