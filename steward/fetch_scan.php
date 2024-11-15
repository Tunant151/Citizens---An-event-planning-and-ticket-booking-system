<?php
include("../admin/common/conn.php");

if (isset($_POST['request'])) {
    $request = $_POST['request'];
    
    // Fetch event details based on the ID
    if(!($request=="All")){//handle error on All selection
        $query = "SELECT * FROM events WHERE id = '$request'";
        $result = mysqli_query($conn, $query);
        $event = mysqli_fetch_assoc($result);
        $event_name = $event['event'];
    }
    

    // Fetch tickets related to the event
    if($request=="All"){
        $query = "SELECT * FROM tickets";
    } else {
        $query = "SELECT * FROM tickets WHERE event = '$event_name'";
    }
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Start generating the HTML table rows for each ticket
        while ($ticket = mysqli_fetch_assoc($result)) {
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
<?php
        } // End of while loop for generating table rows
    } else {
        echo "No tickets found for this event";
    }
} else {
    echo "Invalid request";
}
?>
