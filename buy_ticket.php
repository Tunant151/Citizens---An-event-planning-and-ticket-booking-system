<?php
include("admin/common/conn.php");

$query1 = "SELECT tickets_bought FROM events WHERE id = '$event_id'";
$query1_run = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($query1_run);
$tickets_bought = $row['tickets_bought'] + 1;

$code1 = rand(1000, 9999);
$code2 = rand(1000, 9999);
$code3 = rand(1000, 9999);
$code4 = rand(1000, 9999);

$ticket_code = $code1 . '-' . $code2 . '-' . $code3 . '-' . $code4;

if (isset($_POST['buyTicket'])) {
    $ticket_number = $_POST['ticketNumber'];
    $ticket_code = $_POST['ticketCode'];
    $date = $_POST['date'];
    if(isset($_POST['paymentMethod'])){
      $paymentMethod = $_POST['paymentMethod'];
    }

    $referenceCode = $_POST['referalCode'];
    
    // Check if the reference code already exists
    $checkQuery = "SELECT id FROM tickets WHERE reference_code = '$referenceCode'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
      echo "<script>alert('The reference code has already been used!');</script>";
    } else {
      $query = "INSERT INTO tickets (ticket_number, ticket_code, event, date, payment_method, reference_code) VALUES ('$ticket_number', '$ticket_code', '$event_name', '$date', '$paymentMethod', '$referenceCode')";
      $result = mysqli_query($conn, $query);
      
        if ($result > 0) {
            $query = "UPDATE events SET tickets_bought = '$tickets_bought' WHERE id = '$event_id'";
            $query_run = mysqli_query($conn, $query);
            // Redirect to bought-ticket.php with ticket code
            
            echo "<script>alert('Ticket Purchased!');</script>";
            echo '<script>window.location.href = "bought-ticket.php?id='.$ticket_code.'";</script>';
            exit();
        } else {
            echo "<script>alert('An error occurred while processing your request. Please try again later.');</script>";
        }
    }

}
?>

<div class="container" id="container">
    <form method="POST">
        <!-- hidden fields -->
        <input type="hidden" name="event_id" value="<?php echo $event_id ?>">
        <input type="hidden" name="eventName" value="<?php echo $event_name ?>">
        <input type="hidden" name="date" value="<?php echo $event_date ?>">

        <div class="form-group">
            <label for="ticketNumber">Ticket Number</label>
            <input type="hidden" name="ticketNumber" value="<?php echo 'Ticket_' . $tickets_bought; ?>">
            <input type="text" name="ticketNumberHolder" value="<?php echo 'Ticket_' . $tickets_bought; ?>" disabled>
        </div>

        <div class="form-group">
            <label for="ticketCode">Ticket Code</label>
            <input type="hidden" name="ticketCode" value="<?php echo  $ticket_code ?> ">
            <input type="text" name="ticketCodeHolder" value="<?php echo  $ticket_code ?> " disabled>
        </div>

        <div class="form-group">
            <label style="display: flex; place-content: middle; margin-bottom: 10px;">
                <input type="radio" name="paymentMethod" value="Airtel Money" id="radioAirtel"> 
                <label style="padding-top: 7px;">Airtel Money</label>
                <img src="assets/img/airtel_money_image.png" alt="Airtel Money Logo" class="payment-logo">
            </label>
            <label style="display: flex; place-content: middle; margin-bottom: 10px;">
                <input type="radio" name="paymentMethod" value="Tnm Mpamba" id="radioTnm">
                <label style="padding-top: 7px;">Tnm Mpamba</label> 
                <img src="assets/img/tnm_mpamba_image.jpg" alt="Airtel Money Logo" class="payment-logo">
            </label>

            <div id="inputContainer" style="display:none;">
                <label for="referalCode">Referal Code:</label>
                <input type="text" name="referalCode" id="referalCode" placeholder="Enter The referal code.." required>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" name="buyTicket" style="background: #1a2b7f; padding: 10px 10px; color:#fff; text-align:center; font-family: sans-serif; cursor: pointer;" class="btn" value="Buy">
            <div style="display:flex; margin-top:5px;">
                <a id="cancel" onclick="hideTicketForm()" style="background: red; margin-left:auto; margin-right:auto; padding: 10px 10px; color:#fff; text-align:center; font-family: sans-serif; cursor: pointer;" class="btn">cancel</a>
            </div>

        </div>
    </form>
</div>

<script>
    document.getElementById('radioAirtel').addEventListener('change', function () {
        var inputContainer = document.getElementById('inputContainer');
        inputContainer.style.display = this.checked ? 'block' : 'none';
    });
    document.getElementById('radioTnm').addEventListener('change', function () {
        var inputContainer = document.getElementById('inputContainer');
        inputContainer.style.display = this.checked ? 'block' : 'none';
    });
</script>
