<?php
include("../admin/common/conn.php");

if (isset($_POST['request1'])) {
    $request1 = $_POST['request1'];
    $request2 = $_POST['request2'];

    //get event name
    $query = "SELECT event FROM events where id='$request2' ";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $event = $row['event'];
    }
    
    if($request2 == "All"){
        $query = "SELECT * FROM tickets WHERE CONCAT (ticket_number) LIKE '%$request1%'";
    }else{
        $query = "SELECT * FROM tickets WHERE event = '$event' AND CONCAT (ticket_number) LIKE '%$request1%' ";
    }
    
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // $events = mysqli_fetch_assoc($result);
    $result = mysqli_query($conn, $query);
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
