<?php
include("admin/common/conn.php");

if(isset($_POST['request'])) {
    $request = $_POST['request'];

    $query = "SELECT * FROM events WHERE CONCAT (event) LIKE '%$request%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // $events = mysqli_fetch_assoc($result);
        $events = mysqli_query($conn, $query);
?>

    <!-- Event 1 -->
    <?php

      foreach($events as $event){
        $time = new DateTime($event['time']);
        $formattedTime = $time->format('H:i');
    ?>
    <a href="event.html" class="event">
      <div class="event-details">
        <h2><?php echo $event['event']; ?></h2>
        <p><i class="fa-solid fa-location-dot"></i>: <?php echo $event['venue']; ?></p>
        <p><i class="fa-regular fa-clock"></i>: <?php echo $formattedTime; ?> hrs</p>
        <p><i class="fa-regular fa-calendar"></i>: <?php echo $event['date']; ?></p>
        <p><i class="fa-solid fa-people-line"></i>: <?php echo $event['seats']; ?> Seats</p>
      </div>
      <img src="<?php 
                  if($event['poster'] == null){
                    echo 'assets/img/default_image.png';
                  }else{
                    echo 'assets/uploads/'.$event['poster'];
                  }
                    ?>"
      alt="" class="event-img">
      
    </a>
    <?php } ?>
    
  </div>
<?php
    } else {
        echo "Event not found";
    }
}
?>
