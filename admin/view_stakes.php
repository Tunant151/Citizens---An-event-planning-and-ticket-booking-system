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
  <title>Holdings</title>
  <link rel="stylesheet" href="css/cancel_event.css"> <!-- Link your CSS file -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="common/sidemenu.css">
  <style>
    table th,
    table td {
      border: 1px solid #ccc;
      padding: 12px 8px;
      text-align: center;
    }

    .btn {
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      background-color: Crimson;
      color: #fff;
      cursor: pointer;
      font-size: 14px;
      text-decoration: none;
    }
    table .btn:hover {
    background-color: #cc0000;
    }

    @media only screen and (max-width:820px){
      body,
      .main-content,
      .cancel-event-page{
        width: 90%;
        margin: 0;
        padding: 0 10px;
      }
      .cancel-event-page{
        margin-top: 10px;
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
    <!-- Cancel Event Table -->
    <div class="cancel-event-page">
    <header><i id="fa-bars" class="fa-solid fa-bars" style="color: #183153;" onclick="showMenu()"></i></header>
      <h1>Stakeholders and Events</h1>
      <table>
        <thead>
          <tr>
            <th>id</th>
            <th>Name</th>
            <th>Event</th>
            <th>Remove Stake</th>
          </tr>
        </thead>
        <tbody>

  <?php
  $query = "SELECT * FROM stakeholder_stake ORDER BY name ASC";
  $results = mysqli_query($conn, $query);
  $id = 0;

  if(mysqli_num_rows($results) <= 0){
    echo '<div style="display:flex; width: 100%; justify-content:center;"><p>No Stakes Placed</p></div>';
  }
  foreach($results as $result){
?>

          <tr>
            <td><?php echo ++$id; ?></td>
            <td><?php echo $result['name']; ?></td>
            <td><?php echo $result['event']; ?></td>
            <td><a class="btn" href="remove_stake.php?id=<?php echo $result['id']; ?>">Remove</a></td>
          </tr>

<?php 

} ?>
          <!-- AEnd of table -->
        </tbody>
<?php

?>
      </table>
    </div>
  </div>

  <script src="common/sidemenu.js"></script>
</body>
</html>
