<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ticket Table</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
  }
  
  .ticket-table {
    border-collapse: collapse;
    width: 300px;
    margin: auto;
  }
  
  .ticket-table th, .ticket-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
  }
  
  .ticket-table th {
    background-color:#cb1212;
    color: white;
  }
  
  .ticket-table td {
    background-color: #fff;
    color: #333;
  }

  .ticket-table-caption {
    text-align: center;
    font-size: 18px;
    margin-bottom: 20px;
  }

  .download-button {
    display: block;
    width: 200px;
    margin: 20px auto;
    padding: 10px;
    background-color: #cb1212;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
    cursor: pointer;
  }
</style>
</head>
<body>

<?php 
session_start();
include("admin/common/conn.php");

// Check if an event ID is passed through the URL
if(isset($_GET['id'])) {
  $ticket_code = $_GET['id'];
  // Fetch event details based on the ID from the URL
  $query = "SELECT * FROM tickets WHERE ticket_code = '$ticket_code'";
  $result = mysqli_query($conn, $query);

  if($result && mysqli_num_rows($result) > 0) {
    $tickets = mysqli_fetch_assoc($result);
    
?>

<h2 class="ticket-table-caption">Your Ticket</h2>

<table class="ticket-table">
  <thead>
    <tr>
      <th colspan="2">Ticket Details</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Event Name</td>
      <td><?php echo $tickets['event']; ?></td>
    </tr>
    <tr>
      <td>Date</td>
      <td><?php echo $tickets['date']; ?></td>
    </tr>
    <tr>
      <td>Ticket Number</td>
      <td><?php echo $tickets['ticket_number']; ?></td>
    </tr>
    <tr>
      <td>Ticket Code</td>
      <td><?php echo $tickets['ticket_code']; ?></td>
    </tr>
    <tr>
      <td>Payment Method</td>
      <td><?php echo $tickets['payment_method']; ?></td>
    </tr>
    <tr>
      <td>Reference Code</td>
      <td><?php echo $tickets['reference_code']; ?></td>
    </tr>
  </tbody>
</table>

<form action="generate_pdf.php?id=<?php echo $_GET['id'];?>" method="POST" target="_blank">
<input class="download-button" name="pdf_creater" value="Download Ticket" type="submit"/>
<div style="width:100%; display:flex; justify-content:center;" ><a href="index.php" text-align="center">Return to Home Page</a> </div>  
</form>

<?php
  } else {
    echo "No ticket found with the provided code.";
  }
}
?>

</body>
</html>
