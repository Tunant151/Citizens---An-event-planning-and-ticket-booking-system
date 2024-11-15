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
  <title>Scan Ticket</title>
  <link rel="stylesheet" href="css/scan_event.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">
  <script src="../assets/jquery-3.7.1.min.js"></script> <!-- Include jQuery library -->

  <style>
    #selectEvent {
      width: 200px; /* Set width */
      padding: 6px; /* Add padding */
      font-size: 16px; /* Set font size */
      border: 1px solid #ccc; /* Add border */
      border-radius: 4px; /* Add border-radius for a rounded look */
      outline: none; /* Remove outline */
      background-color: #fff; /* Set background color */
      color: #333; /* Set text color */
      cursor: pointer; /* Add pointer cursor */
      margin-left: auto;
      margin-right: auto;
    }

    /* Style when the dropdown is open */
    #selectEvent:focus {
      border-color: #007bff; /* Change border color on focus */
    }

    #search{
      height: 33px;
      border: 1px solid #ccc;
      padding: 6px;
    }

    @media only screen and (max-width:820px) {
      .main-content{
        background-color: #fff;
        width: 100%;
        padding: 0;
        z-index: -1;
      }
      .scan-ticket-page{
        width: 100%;
        margin-top: 0;
      }

      .main-content .scan-ticket-page table{
        margin: 0;
        padding: 0;
        font-size: 14px;
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
  <header><i id="fa-bars" class="fa-solid fa-bars" style="color: #183153;" onclick="showMenu()"></i></header>
    <!-- Scan Ticket Section -->
    <div class="scan-ticket-page">
      <h1>Scan Ticket</h1>


      <!-- Search bar -->
      <div class="search-bar">
        <select id="selectEvent" name="selectEvent">
          <option value="All">All</option>
          <?php
            $query = "SELECT * FROM events";
            $options = mysqli_query($conn, $query);
            
            // Display the event names in the select option dropdown
            while ($option = mysqli_fetch_assoc($options)) {
              echo '<option value="' . $option['id'] . '">' . $option['event'] . '</option>';
            }
          ?>
        </select>

        <input type="text" placeholder="Enter Ticket Number" id="search">
      </div>

      <!-- Ticket Table -->
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Event Name</th>
            <th>Ticket Number</th>
            <th>Ticket Code</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-container">
          <?php 
            $query = "SELECT * FROM tickets";
            $tickets = mysqli_query($conn, $query);
            
            foreach($tickets as $ticket) {
          ?>
            <tr>
              <td><?php echo $ticket['date'] ?></td>
              <td><?php echo $ticket['event'] ?></td>
              <td><?php echo $ticket['ticket_number'] ?></td>
              <td><?php echo $ticket['ticket_code'] ?></td>
              <td><?php echo $ticket['ticket_status'] ?></td>
              <td>
                <form action="scan_action.php" method="POST">
                  <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                  <?php if ($ticket['ticket_status'] == 'checked') { ?>
                      <button type="submit" name="scan" style="background: crimson;" disabled>Scanned</button>
                  <?php } else { ?>
                      <button type="submit" name="scan_ticket">Scan</button>
                  <?php } ?>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="common/sidemenu.js"></script>

  <script>
  $(document).ready(function(){
    $("#selectEvent").on('change', function(){
      var value = $(this).val();

      $.ajax({
        url: "fetch_scan.php",
        type: "POST",
        data: { request: value }, // Use object format to pass data
        beforeSend: function(){
          $(".table-container").html("<span>Loading ...</span>");
        },
        success: function(data){
          $(".table-container").html(data);
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          // Handle error if necessary
        }
      });
    });

    $("#search").keyup(function(){
        var value1 = $(this).val();
        var value2 = $("#selectEvent").val();
        // alert(value2);

        $.ajax({
          url: "fetch_scan_text.php",
          type: "POST",
          data: { 
            request1: value1,
            request2: value2,
          }, // Use object format to pass data
          beforeSend: function(){
            $(".table-container").html("<span>Loading ...</span>");
          },
          success: function(data){
            $(".table-container").html(data);
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
