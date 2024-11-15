<?php
include("common/conn.php");

if(isset($_POST['request'])) {
    $request = $_POST['request'];

    $query = "SELECT * FROM events WHERE id = '$request'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
?>

<form action="update_action.php" method="POST">
    
    <input type="hidden" id="eventId" name="eventId" value="<?php echo $event['id'] ?>" required>
    <div class="form-group">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" value="<?php echo $event['event']; ?>" required>
    </div>
    <div class="form-group">
        <label for="eventDate">Event Date:</label>
        <input type="date" id="eventDate" name="eventDate" value="<?php echo $event['date']; ?>" required>
    </div>
    <div class="form-group">
        <label for="eventTime">Event Time:</label>
        <input type="time" id="eventTime" name="eventTime" value="<?php echo $event['time']; ?>" required>
    </div>
    <div class="form-group">
        <label for="eventLocation">Event Location:</label>
        <input type="text" id="eventLocation" name="eventLocation" value="<?php echo $event['venue']; ?>" required>
    </div>
    <div class="form-group">
        <label for="eventCapacity">Event Capacity:</label>
        <input type="number" id="eventCapacity" name="eventCapacity" value="<?php echo $event['seats']; ?>" required>
    </div>
    <div class="form-group">
        <label for="eventDescription">Event Description:</label>
        <textarea type="text" id="eventDescription" name="eventDescription" required><?php echo $event['description']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="eventImage">Event Image:</label>
        <input type="file" id="eventImage" name="eventImage" accept="image/*">
    </div>
    <div class="form-group">
        <button type="submit" name="update_form" >Update Event</button>
    </div>
</form>

<?php
    } else {
        echo "Event not found";
    }
}
?>
