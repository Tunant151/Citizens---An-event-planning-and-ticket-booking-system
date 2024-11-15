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
  <title>Steward Dashboard</title>
  <link rel="stylesheet" href="css/style.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="common/sidemenu.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <style>
    .main-content{
      margin-left: 250px;
    }
    .event-table table tbody tr td{
        text-align: center;
      }

      #fa-bars{
        display: none;
      }

    @media only screen and (max-width:820px){
      #fa-bars{
        display: block;
      }
      .main-content{
        margin: 0;
      }
      .event-table {
        border-top: 1px solid #ccc;
        padding: 2px;
      }
      
      .event-table table {
        width: 100%;
      }
      
      .event-table th,
      .event-table td {
        border: 1px solid #ccc;
        padding: 5px 5px;
        border: 2px solid #1a2b7f;
      }
      .event-table table tbody tr td{
        text-align: center;
      }

      .event-table th:nth-child(3),
      .event-table td:nth-child(3),
      .event-table th:nth-child(4),
      .event-table td:nth-child(4)  {
          width: 60px;
      }
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
      <header><i id="fa-bars" class="fa-solid fa-bars" style="color: #183153;" onclick="showMenu()"></i>Dashboard</header>
      <div class="statistics">
        <?php
          $query = "SELECT * FROM events";
          $numbers = mysqli_query($conn, $query);
          $count = 0;

          foreach($numbers as $number){
          $count ++;
          }

        ?>
        <div class="stat-bubble">
          <h3>Number of Events</h3>
          <p><?php echo $count ; ?></p>
        </div>


        <?php
          $query = "SELECT * FROM tickets";
          $numbers = mysqli_query($conn, $query);
          $count = 0;

          foreach($numbers as $number){
          $count ++;
          }

        ?>
        <div class="stat-bubble">
          <h3>Booked Tickets</h3>
          <p><?php echo $count ; ?></p>
        </div>
      </div>
      
      <div class="event-table">
        <h2>Event Details</h2>
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Event Name</th>
              <th>Ticket Sold</th>
              <th>Money Made</th>
            </tr>
          </thead>
          <tbody>
            <!-- Rows for event details -->

<?php
  $query = "SELECT * FROM events";
  $results = mysqli_query($conn, $query);

  foreach($results as $result){
?>


            <tr>
              <td><?php echo $result['date']; ?></td>
              <td><?php echo $result['event']; ?></td>
              <td><?php echo $result['tickets_bought']; ?></td>
              <td><?php echo "Mkw " .number_format($result['tickets_bought'] * $result['price'], 2); ?></td>
            </tr>

<?php } ?>
            <!-- End of table data -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

<script src="common/sidemenu.js"></script>
</body>
</html>