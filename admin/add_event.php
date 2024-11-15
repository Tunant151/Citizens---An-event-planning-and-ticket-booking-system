<?php
session_start();

include("common/conn.php");
if (!isset($_SESSION['valid'])) {
  header("Location: ../login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Event</title>
  <link rel="stylesheet" href="css/add_event.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">
  <script src="../assets/jquery-3.7.1.min.js"></script> <!-- Include jQuery library -->

  <style>
    .side-menu {
      height: 100vh;
    }

    .menu-items {
      margin-top: 10px;
    }

    .error {
      display: none;
      background-color: rgb(255, 0, 0);
      color: #fff;
      padding: 3px;
      margin-bottom: 5px;
    }

    .disableBtn {
      opacity: .5;
      cursor: not-allowed;
    }

    .errorShow {
      display: block;
      background-color: rgb(255, 0, 0);
      color: #fff;
      padding: 3px;
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <!-- Side Menu -->
  <?php
  include("common/sidemenu.php");
  ?>
  <?php

  include("common/conn.php");

  if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['eventName']); // Prevent SQL injection
    $date = mysqli_real_escape_string($conn, $_POST['eventDate']); // Prevent SQL injection
    $time = mysqli_real_escape_string($conn, $_POST['eventTime']); // Prevent SQL injection
    $venue = mysqli_real_escape_string($conn, $_POST['eventLocation']); // Prevent SQL injection
    $seats = mysqli_real_escape_string($conn, $_POST['eventCapacity']); // Prevent SQL injection
    $description = mysqli_real_escape_string($conn, $_POST['eventDescription']); // Prevent SQL injection
    $price = mysqli_real_escape_string($conn, $_POST['ticketPrice']); // Prevent SQL injection
    if (!empty($_FILES['eventImage']['name'])) {
      $poster = $_FILES['eventImage']['name'];
      $target_dir = "../assets/uploads/";
      $target_file = $target_dir . basename($_FILES["eventImage"]["name"]);
      // Upload photo
      move_uploaded_file($_FILES["eventImage"]["tmp_name"], $target_file);
    }



    //check if exists already
    $check = "SELECT * FROM events WHERE event = '$name' AND date = '$date' AND time = '$time'";
    $result = mysqli_query($conn, $check);
    if (mysqli_num_rows($result) > 0) {
      echo "<script>alert('The Event Already exists');</script>";
    } else {
      if (!empty($_FILES['eventImage']['name'])) {
        $query = "INSERT INTO events (event, date, time, venue, seats, description, price, poster) VALUES ('$name', '$date', '$time', '$venue', '$seats', '$description', '$price', '$poster')";
      } else {
        $query = "INSERT INTO events (event, date, time, venue, seats, description, price) VALUES ('$name', '$date', '$time', '$venue', '$seats', '$description', '$price')";
      }
      mysqli_query($conn, $query);
      echo "<script>alert('The Event Has Been Added');</script>";
    }
  }
  ?>

  <!-- ADD EVENT CONTENT-->
  <div class="main-containt">
    <div class="add-event-page">
      <header><i id="fa-bars" class="fa-solid fa-bars" style="color: #183153;" onclick="showMenu()"></i></header>
      <h1>Add New Event</h1>
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="eventName">Event Name:</label>
          <input type="text" id="eventName" name="eventName" required>
        </div>
        <div class="form-group">
          <label for="eventDate">Event Date:</label>
          <span class="error" id="error">The date Has already passed</span>
          <input type="date" id="eventDate" class="dateInput" name="eventDate" required>
        </div>
        <div class="form-group">
          <label for="eventTime">Event Time:</label>
          <input type="time" id="eventTime" name="eventTime" required>
        </div>
        <div class="form-group">
          <label for="eventLocation">Event Location:</label>
          <input type="text" id="eventLocation" name="eventLocation" required>
        </div>
        <div class="form-group">
          <label for="eventCapacity">Event Capacity:</label>
          <input type="number" id="eventCapacity" name="eventCapacity" required>
        </div>
        <div class="form-group">
          <label for="eventImage">Event Image:</label>
          <input type="file" id="eventImage" name="eventImage"><!-- accept="image/* " -->
        </div>
        <div class="form-group">
          <label for="ticketPrice">Ticket Price:</label>
          <input type="number" id="ticketPrice" name="ticketPrice" required>
        </div>
        <div class="form-group">
          <label for="eventDescription">Event Description:</label>
          <textarea id="eventDescription" name="eventDescription" required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" name='submit' id="submitBtn">Add Event</button>
        </div>
      </form>
    </div>
  </div>

  <script src="common/sidemenu.js"></script>
  <script>
    $(document).ready(function() {
      $(".dateInput").change(function() {
        var current_date = new Date();
        var selected_date = new Date(this.value);
        var formatted_selected_date = selected_date.toISOString().split('T')[0];

        if (selected_date < current_date) {
          $("#submitBtn").prop("disabled", true);
          $("#submitBtn").addClass("disableBtn");
          document.getElementById("error").style.display = "block";
        } else {
          $("#submitBtn").prop("disabled", false);
          $("#submitBtn").removeClass("disableBtn");
          document.getElementById("error").style.display = "none";
        }
      });
    });
  </script>
</body>

</html>