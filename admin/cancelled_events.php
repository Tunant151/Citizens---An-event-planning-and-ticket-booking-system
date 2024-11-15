<?php
  session_start();

  include("common/conn.php");
  if(!isset($_SESSION['valid'])){
    header("Location: ../login/login.php");
  }
  if(!$_SESSION['role']=="admin"){
    header("Location: ../login/login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cancelled Events</title>
  <link rel="stylesheet" href="css/style.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="css/cancelled_style.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">
  <style>      
    /* Event bubbles style */
    .event-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: start;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
      }
      .event{
        margin: 20px 10px;
      }
      .event-img {
          height: 150px;
          width: auto;
          margin-left: 45px;
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
      <h2 style="text-align:center; margin: 10px 0;">Cancelled Events</h2>

      <!-- Event bubbles -->
        <div class="event-container">
            <!-- Event 1 -->
            <?php
            $query = "SELECT * FROM cancelled_events";
            $events = mysqli_query($conn, $query);

            foreach($events as $event){
                $time = new DateTime($event['time']);
                $formattedTime = $time->format('H:i');
            ?>
            <a class="event event-cancelled">
            <div class="event-details">
                <h2><?php echo $event['event']; ?></h2>
                <p><i class="fa-solid fa-location-dot"></i>: <?php echo $event['venue']; ?></p>
                <p><i class="fa-regular fa-clock"></i>: <?php echo $formattedTime; ?> hrs</p>
                <p><i class="fa-regular fa-calendar"></i>: <?php echo $event['date']; ?></p>
                <p><i class="fa-solid fa-people-line"></i>: <?php echo $event['seats']; ?> Seats</p>
            </div>
            <img src="<?php 
                        if($event['poster'] == null){
                            echo '../assets/img/default_image.png';
                        }else{
                            echo '../assets/uploads/'.$event['poster'];
                        }
                            ?>"
            alt="" class="event-img">
            
            </a>
            <?php } ?>
            
        </div>
      
    </div>
</div>

<script src="common/sidemenu.js"></script>
</body>
</html>
