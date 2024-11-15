<?php
session_start();
include("admin/common/conn.php");

// Check if an event ID is passed through the URL
if (isset($_GET['id'])) {
  $event_id = $_GET['id'];
  $_SESSION['buyer'] = $event_id;

  // Fetch event details based on the ID from the URL
  $query = "SELECT * FROM events WHERE id = $event_id";
  $result = mysqli_query($conn, $query);


  if ($result && mysqli_num_rows($result) > 0) {
    $event = mysqli_fetch_assoc($result);

    //keep event details
    $event_name = $event['event'];
    $event_date = $event['date'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Book Ticket</title>
      <link rel="stylesheet" href="css/event.css">
      <link rel="stylesheet" href="assets/fontawesome/css/all.css">
      <link rel="stylesheet" href="css/buy_ticket.css">
      <style>
        body {
          font-family: 'Roboto', sans-serif;
        }

        .container {
          background-color: #fff;
          top: 30%;
          left: 20%;
          box-shadow: 1000px 1000px 1000px 1000px rgba(0, 0, 0, 0.7);
        }

        .payment-logo {
          width: 30px;
        }

        .ticket-page {
          display: flex;
          flex-direction: row;
          justify-content: space-between;
        }

        .event-description {
          width: 40%;
        }

        .description {
          font-family: 'Poppins';
        }

        img.payment-logo {
          width: 35px;
        }

        /* Mobile view */
        @media only screen and (max-width:820px) {

          body,
          .ticket-page {
            width: 100%;
          }

          .banner {
            width: 90%;
            padding: 3px 10px;
          }

          .event-details {
            display: flex;
            flex-direction: column;
          }

          .event-details img {
            margin: 0;
            width: 70%;
            height: auto;
            margin-left: 15%;
          }

          .event-description h2 {
            font-family: sans-serif;
            font-size: 40px;
            margin: 10px auto;
          }

          .event-description p {
            font-size: 20px;
            font-family: 'Lucida Sans Regular';
          }

          .book-ticket button {
            font-size: 25px;
          }


          body {
            font-family: 'Roboto', sans-serif;
            width: 95%;
          }

          .ticket-page {
            width: 100%;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: start;
            margin: 0;
            padding: 0;
            margin-top: 40px;
          }

          .event-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin: 0;
            padding: 0;
            margin-bottom: 20px;
          }

          .event-image {
            width: 350px;
            height: auto;
            object-fit: cover;
            margin-bottom: 10px;
          }

          .event-description {
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: flex-start;
            width: 90%;
            margin-left: 0;
          }

          .event-description h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 600;
            line-height: 32px;
            color: #333;
            margin-bottom: 5px;
          }

          .event-description p {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            color: #666;
            margin-bottom: 5px;
          }

          .event-description i {
            font-size: 16px;
            margin-right: 5px;
          }

          .book-ticket {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
          }

          .book-ticket button {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 500;
            line-height: 24px;
            border: none;
            border-radius: 5px;
            padding: 10px 30px;
            cursor: pointer;
            transition: all 0.3s ease;
          }

          .book-ticket button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 104, 201, 0.993);
          }

          #ticketForm {
            display: none;
          }
        }
      </style>
    </head>

    <body>
      <!-- Banner -->
      <div class="banner">
        <h1>Welcome To<br><span> Citizens</span></h1>
        <a href="./"><img src="assets/img/logo.png" alt="logo for the Citizen" class="logo"></a>
      </div>

      <div class="ticket-page">
        <div class="event-details">
          <div class="event-image-holder">
            <img src="<?php
                      if ($event['poster'] == null) {
                        echo 'assets/img/default_image.png';
                      } else {
                        echo 'assets/uploads/' . $event['poster'];
                      }
                      ?>"
              alt="Event Image" class="event-image">
          </div>
          <div class="event-description">
            <h2><?php echo $event['event']; ?></h2>
            <p><i class="fa-solid fa-location-dot"></i> Location: <?php echo $event['venue']; ?></p>
            <p><i class="fa-regular fa-clock"></i> Time: <?php echo date('H:i', strtotime($event['time'])); ?> hrs</p>
            <p><i class="fa-regular fa-calendar"></i> Date: <?php echo $event['date']; ?></p>
            <p><i class="fa-solid fa-people-line"></i> Available Seats: <?php echo $event['seats']; ?></p>
            <p><i class="fa-solid fa-sack-dollar"></i> Price: Mkw <?php echo $event['price']; ?></p>
            <p class="description"><?php echo $event['description']; ?></p>
            <div class="book-ticket">
              <button onclick="showTicketForm()">Book Ticket</button>
            </div>
          </div>
        </div>

        <div id="ticketForm" style="display: none;">
          <?php include("buy_ticket.php"); ?>
        </div>
      </div>

      <script>
        function showTicketForm() {
          var ticketForm = document.getElementById("ticketForm");
          ticketForm.style.display = "block";
        }

        function hideTicketForm() {
          var ticketForm = document.getElementById("ticketForm");
          ticketForm.style.display = "none";
        }
      </script>
    </body>

    </html>

<?php
  } else {
    echo "Event not found!";
  }
} else {
  echo "No event ID provided!";
}
?>