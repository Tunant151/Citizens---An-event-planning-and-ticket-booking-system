<?php
session_start();
include("admin/common/conn.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>K-Stadium | Home</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <script src="assets/jquery-3.7.1.min.js"></script> <!-- Include jQuery library -->
  <style>
    /* Event bubbles style */
    .event-container {
      display: flex;
      flex-wrap: wrap;
      gap: 50px;
      justify-content: start;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
    }

    .event {
      margin: 20px 0;
    }

    .event-img {
      height: 150px;
      width: auto;
      margin-left: 45px;
    }
  </style>
</head>

<body>
  <!-- Banner -->
  <div class="banner">
    <h1>Welcome To<br><span>Citizens</span></h1>
    <a href="login/login.php"><img src="assets/img/logo.png" alt="logo for the Citizen" class="logo"></a>
  </div>

  <!-- Search bar -->
  <div class="search-bar">
    <input id="search-bar" type="text" placeholder="Search events...">
  </div>

  <!-- Event bubbles -->
  <div class="event-container">
    <!-- Event 1 -->
    <?php
    $query = "SELECT * FROM events";
    $events = mysqli_query($conn, $query);

    foreach ($events as $event) {
      $time = new DateTime($event['time']);
      $formattedTime = $time->format('H:i');
    ?>
      <a href="event_details.php?id=<?php echo $event['id']; ?>" class="event">
        <div class="event-details">
          <h2><?php echo $event['event']; ?></h2>
          <p><i class="fa-solid fa-location-dot"></i>: <?php echo $event['venue']; ?></p>
          <p><i class="fa-regular fa-clock"></i>: <?php echo $formattedTime; ?> hrs</p>
          <p><i class="fa-regular fa-calendar"></i>: <?php echo $event['date']; ?></p>
          <p><i class="fa-solid fa-people-line"></i>: <?php echo $event['seats']; ?> Seats</p>
        </div>
        <img src="<?php
                  if ($event['poster'] == null) {
                    echo 'assets/img/default_image.png';
                  } else {
                    echo 'assets/uploads/' . $event['poster'];
                  }
                  ?>"
          alt="" class="event-img">

      </a>
    <?php } ?>

  </div>


  <!-- FOOTER SECTION -->
  <footer>
    <div class="footer-content">

    </div>
    <div class="footer-content"></div>
    <div class="footer-content"></div>
    <div class="footer-content"></div>
  </footer>

  <script>
    $(document).ready(function() {
      $("#search-bar").keyup(function() {
        var value = $(this).val();

        $.ajax({
          url: "fetch.php",
          type: "POST",
          data: {
            request: value
          }, // Use object format to pass data
          beforeSend: function() {
            $(".event-container").html("<span>Loading ...</span>");
          },
          success: function(data) {
            $(".event-container").html(data);
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error if necessary
          }
        });
      });
    });
  </script>

  <?php include('footer.php'); ?>
</body>

</html>