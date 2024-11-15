<?php
include("common/conn.php");

if(isset($_POST["update_form"])){
    $id = mysqli_real_escape_string($conn, $_POST['eventId']);
    $name = mysqli_real_escape_string($conn, $_POST['eventName']);
    $date = mysqli_real_escape_string($conn, $_POST['eventDate']);
    $time = mysqli_real_escape_string($conn, $_POST['eventTime']);
    $venue = mysqli_real_escape_string($conn, $_POST['eventLocation']);
    $seats = mysqli_real_escape_string($conn, $_POST['eventCapacity']);
    $price = mysqli_real_escape_string($conn, $_POST['eventPrice']);
    $description = mysqli_real_escape_string($conn, $_POST['eventDescription']);
    $poster = null; // Initialize poster variable
    if(!empty($_FILES['eventImage']['name'])){
        $poster = $_FILES['eventImage']['name'];
        $target_dir = "../assets/uploads/";
        $target_file = $target_dir . basename($_FILES["eventImage"]["name"]);
        // Upload photo
        move_uploaded_file($_FILES["eventImage"]["tmp_name"], $target_file);
    }

    // Fetch event name to change in tickets table
    $query = "SELECT * FROM events WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $event = mysqli_fetch_assoc($result);
    $event_name = $event['event'];
    
    $update_tickets_query = "UPDATE tickets SET event = '$name', date = '$date' WHERE event = '$event_name'";
    $run_tickets_query = mysqli_query($conn, $update_tickets_query);

    // Update the event details
    $update_query = "UPDATE events SET event = '$name', date = '$date', time = '$time', venue = '$venue', seats = '$seats', description = '$description', price = '$price'";
    if($poster !== null) {
        $update_query .= ", poster = '$poster'";
    }
    $update_query .= " WHERE id = '$id'";
    
    $result = mysqli_query($conn, $update_query);

    if($result) {
        echo "<script>alert('Successfully updated event!');</script>";
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Failed to update event!');</script>";
    }

}
?>
