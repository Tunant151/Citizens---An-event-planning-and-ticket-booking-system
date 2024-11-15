<?php
  session_start();

  include("../admin/common/conn.php");
  if(!isset($_SESSION['valid'])){
    header("Location: ../login/login.php");
  }
  if(!$_SESSION['role']=="stakeholder"){
    header("Location: ../login/login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stakeholders: Home</title>
  <link rel="stylesheet" href="css/main.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">

  <style>
    .fixed-button button, .fixed-button a {
        background-color: #c52b2b;
        text-decoration: none;
    }
    .cancelled{
        width: 100%;
        margin: 0;
        margin-bottom: 10px;
        padding: 10px 0;
        display: flex;
        justify-content: end;
        background: #00025e;
    }
    .btn{
        text-decoration: none;
        color: #fff;
        background-color: #c52b2b;
        border: none;
        padding: 10px 28px;
        font-size: 16px;
    }
    .btn:hover{
        color: #fff;
        background-color: #333;
    }
  </style>
</head>
<body>
    <div class="main-content">
        <!-- Events and Revenue Section -->
        <div class="events-revenue-page">
            <h1>Events and Revenue</h1>
            <div class="event-list">
                <!-- Display Hero Event ZIZUNGU AMWENE -->
                <div class="cancelled">
                    <a href="cancelled_events.php" class="btn">View Cancelled Stakes</a>
                </div>
                <div class="event" id="legend">
                    
                    <?php
                    $session_name = $_SESSION['username'];
                    $countEvents = 0;
                    $totalRevenue = 0;
                    $countTickets = 0;
                    //checkin if  there is any event in the database for the stake holder
                    $query = "SELECT * FROM stakeholder_stake WHERE name='$session_name'";
                    $query_run = mysqli_query($conn, $query); 
                        if(mysqli_num_rows($query_run)<=0){
                        ?>
                            <h2>General Records</h2>
                            <p>-------------------------------------------------------------</p>
                            <h3>StakeHolder Name: <?php echo $session_name; ?></h3>
                            <p>-------------------------------------------------------------</p>
                            <h3 style="text-align: center;">You have no event(s) Staked</h3>
                            <?php
                        }else{
                            $countEvents = 0;
                            $totalRevenue = 0;
                            $countTickets = 0;
                            $countTickets = 0;
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $stakeholder_event = $row['event'];
                                $query = "SELECT * FROM events WHERE event='$stakeholder_event'";
                                $events = mysqli_query($conn, $query);
                            
                                foreach($events as $event){
                                    $countEvents ++;
                                    $totalRevenue += $event['tickets_bought'] * $event['price'];
                                    
                                    //total number of tickets sold
                                    $query = "SELECT * FROM tickets WHERE event='$stakeholder_event'";
                                    $numbers = mysqli_query($conn, $query);
                                    
                                    foreach($numbers as $number){
                                        $countTickets ++;
                                    }
                                }
                                // echo "<script>alert('". $event['tickets_bought'] ."');</script>";

                                

                            } ?>

                                <!-- Displaying for All events -->
                                <h2>General Records</h2>
                                <p>-------------------------------------------------------------</p>
                                <h3>StakeHolder Name: <?php echo $session_name; ?></h3>
                                <p>-------------------------------------------------------------</p>
                                <h3>Total Events: <?php echo $countEvents ; ?></h3>
                                <p>Total Tickets Sold: <?php echo $countTickets ; ?></p>
                                <p>Total Revenue: Mkw <?php echo number_format($totalRevenue, 2) ; ?></p>
                                
                        
                            <?php
                        } ?>
                </div>
                
                <!-- Per Events -->
                <?php
                $session_name = $_SESSION['username'];
                //checkin if  there is any event in the database for the stake holder
                $query = "SELECT * FROM stakeholder_stake WHERE name='$session_name'";
                $query_run = mysqli_query($conn, $query); 
                    if(mysqli_num_rows($query_run)<=0){

                    }else{
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $stakeholder_event = $row['event'];
                                $query = "SELECT * FROM events WHERE event='$stakeholder_event'";
                                $events = mysqli_query($conn, $query);
                                foreach($events as $event){
                            ?>
                            <div class="event">
                                
                                <h3>Event: <?php echo $event['event'];?></h3>
                                <p>Total Tickets Sold: <?php echo $event['tickets_bought'];?></p>
                                <p>Total Revenue: Mkw <?php echo number_format($event['tickets_bought'] * $event['price'], 2);?></p>
                                <p>Date: <?php echo $event['date'];?></p>
                            </div>
                            <?php }
                        } 
                    } ?>

            </div>
        </div>
    
        <!-- Fixed button -->
        <div class="fixed-button" id="fixedButton">
        <button id="btnShow" onclick="toggleShow()"><i class="fa-solid fa-angle-up" style="color: #ffffff;"></i></button>
        <button id="btnHide" onclick="toggleHide()" style="display: none;"><i class="fa-solid fa-angle-down" style="color: #ffffff;"></i></button>
        <div class="menu-content" id="menuContent">

            <?php
            //checkin if  there is any event in the database for the stake holder
            $query = "SELECT * FROM stakeholder_stake WHERE name='$session_name'";
            $query_run = mysqli_query($conn, $query); 
                if(mysqli_num_rows($query_run)<=0){
                ?>
            <p>Total Revenue: Mkw <?php echo number_format(0, 2) ; ?></p>
            <?php
                } else {
            ?>
            <p>Total Revenue: Mkw <?php echo number_format($totalRevenue, 2) ; ?></p>
            <?php
                }
            ?>
            <a class="logout-button" href="../login/logout.php">Log Out</a>
        </div>
        </div>
    </div>

    <script>
        // Function to toggle menu visibility
        function toggleShow() {
            document.getElementById("menuContent").style.display = "block";
            document.getElementById("btnShow").style.display = "none";
            document.getElementById("btnHide").style.display = "block";
        }

        function toggleHide() {
            document.getElementById("menuContent").style.display = "none";
            document.getElementById("btnShow").style.display = "block";
            document.getElementById("btnHide").style.display = "none";
        }
    </script>
</body>
</html>
