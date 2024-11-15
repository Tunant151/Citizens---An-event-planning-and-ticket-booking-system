<?php
  session_start();

  include("common/conn.php");
  if(!isset($_SESSION['valid'])){
    header("Location: ../login/login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Event</title>
  <link rel="stylesheet" href="css/update_event.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">
  <script src="../assets/jquery-3.7.1.min.js"></script> <!-- Include jQuery library -->
  <style>
    @media only screen and (max-width:820px){
      .main-content{
        position: absolute;
        z-index: -1;
        margin-left: auto;
        margin-right: auto;
      }

      body, .main-content, .update-event-page{
        width: 93%;
        margin: 0;
        padding: 0;
        margin-left: auto;
        margin-right: auto;
      }
      .update-event-page{
        width: 90%;
      }
      
    }
  </style>
</head>
<body>


  <!-- Side Menu -->
  <?php 
    include("common/sidemenu.php");
  ?>

  <div class="main-content">
    <!-- Update Event Form -->
    <header><i id="fa-bars" class="fa-solid fa-bars" style="color: #183153;" onclick="showMenu()"></i></header>      
    <h1>Update Event</h1>
    <div class="form-group">
          <label for="selectEvent" style="margin-left: 20px;">Select Event:</label>
          <select id="selectEvent" name="selectEvent">
          <?php
              $query = "SELECT * FROM events limit 1";
              $events = mysqli_query($conn, $query);

              $query = "SELECT * FROM events";
              $options = mysqli_query($conn, $query);
              // Display the event names in the select option dropdown
              while ($event = mysqli_fetch_assoc($events)) {
                foreach($options as $option){
                  echo '<option value="' . $option['id'] . '">' . $option['event'] . '</option>';
                }                
                
              // }
            ?>
          </select>
        </div>
    <div class="update-event-page">

      <form action="update_action.php" method="POST" enctype="multipart/form-data">
        

        <?php
         // while($row = mysqli_fetch_assoc($events)){
        ?>
        <input type="hidden" id="eventId" name="eventId" value="<?php echo $event['id'] ?>" required>
        <div class="form-group">
          <label for="eventName">Event Name:</label>
          <input type="text" id="eventName" name="eventName" value="<?php echo $event['event'] ?>" required>
        </div>
        <div class="form-group">
          <label for="eventDate">Event Date:</label>
          <input type="date" id="eventDate" name="eventDate" value="<?php echo $event['date'] ?>" required>
        </div>
        <div class="form-group">
          <label for="eventTime">Event Time:</label>
          <input type="time" id="eventTime" name="eventTime" value="<?php echo $event['time'] ?>" required>
        </div>
        <div class="form-group">
          <label for="eventLocation">Event Location:</label>
          <input type="text" id="eventLocation" name="eventLocation" value="<?php echo $event['venue'] ?>" required>
        </div>
        <div class="form-group">
          <label for="eventCapacity">Event Capacity:</label>
          <input type="number" id="eventCapacity" name="eventCapacity" value="<?php echo $event['seats']; ?>" required>
        </div>
        <div class="form-group">
          <label for="eventPrice">Price:</label>
          <input type="number" id="eventPrice" name="eventPrice" value="<?php echo $event['price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="eventDescription">Event Description:</label>
            <textarea type="text" id="eventDescription" name="eventDescription" required><?php echo $event['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="eventImage">Event Image:</label>
              <input type="file" id="eventImage" name="eventImage">
        </div>
    
        <?php } ?>
        <div class="form-group">
          <button type="submit" name="update_form" >Update Event</button>
        </div>
      </form>
    </div>
  </div>
<script src="common/sidemenu.js"></script>

<script>
  $(document).ready(function(){
    $("#selectEvent").on('change', function(){
      var value = $(this).val();

      $.ajax({
        url: "fetch_update.php",
        type: "POST",
        data: { request: value }, // Use object format to pass data
        beforeSend: function(){
          $(".update-event-page").html("<span>Loading ...</span>");
        },
        success: function(data){
          $(".update-event-page").html(data);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          // Handle error if necessary
        }
      });
    });
  });
</script>

</body>
</html>
