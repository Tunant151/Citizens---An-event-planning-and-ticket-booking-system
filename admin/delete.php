<?php
include("common/conn.php");
$id = $_GET['id'];
$query = "SELECT * FROM events WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if($result && mysqli_num_rows($result) > 0) {
    $event = mysqli_fetch_assoc($result);
    $name = mysqli_real_escape_string($conn, $event['event']); // Prevent SQL injection
    $date = mysqli_real_escape_string($conn, $event['date']);
    $time = mysqli_real_escape_string($conn, $event['time']);
    $venue = mysqli_real_escape_string($conn, $event['venue']);
    $seats = mysqli_real_escape_string($conn, $event['seats']);
    $description = mysqli_real_escape_string($conn, $event['description']);
    $price = mysqli_real_escape_string($conn, $event['price']);
    $poster = null; // Initialize poster variable
    
    if(!empty($_FILES['eventImage']['name'])){
        $poster = $_FILES['eventImage']['name'];
        $target_dir = "../assets/uploads/";
        $target_file = $target_dir . basename($_FILES["eventImage"]["name"]);
        // Upload photo
        move_uploaded_file($_FILES["eventImage"]["tmp_name"], $target_file);
    }
    
    // Insert event details into cancelled_events table
    $insert_query = "INSERT INTO cancelled_events (event, date, time, venue, seats, description, price, poster) 
                     VALUES ('$name', '$date', '$time', '$venue', '$seats', '$description', '$price', '$poster')";
    $result_insert = mysqli_query($conn, $insert_query);

    // Check if insertion was successful
    if($result_insert) {
        // Delete event from events table
        $delete_query = "DELETE FROM events WHERE id = '$id'";
        $result_delete = mysqli_query($conn, $delete_query);
        
        // Check if deletion was successful
        if($result_delete) {
            // Insert related stakeholder details into stakeholder_cancelled_stake table and delete from stakeholder_stake table
            $query_stakeholders = "SELECT * FROM stakeholder_stake WHERE event = '$name'";
            $stakeholders_result = mysqli_query($conn, $query_stakeholders);
            
            if($stakeholders_result) {
                while($stakeholder = mysqli_fetch_assoc($stakeholders_result)) {
                    $stakeholder_name = mysqli_real_escape_string($conn, $stakeholder['name']);
                    $insert_stakeholder_query = "INSERT INTO stakeholder_cancelled_stake (name, event, date, time, venue, seats, description, price) 
                                                 VALUES ('$stakeholder_name', '$name', '$date', '$time', '$venue', '$seats', '$description', '$price')";
                    $result_insert_stakeholder = mysqli_query($conn, $insert_stakeholder_query);
                    
                    if($result_insert_stakeholder) {
                        $delete_stakeholder_query = "DELETE FROM stakeholder_stake WHERE name = '$stakeholder_name' AND event = '$name'";
                        $result_delete_stakeholder = mysqli_query($conn, $delete_stakeholder_query);
                        
                        if(!$result_delete_stakeholder) {
                            die(mysqli_error($conn));
                        }
                    } else {
                        die(mysqli_error($conn));
                    }
                }
            } else {
                die(mysqli_error($conn));
            }
            
            echo "<script>alert('Event has been cancelled');</script>";
            header("Location: cancel_event.php");
            exit;
        } else {
            echo "<script>alert('Failed to cancel event');</script>";
        }
    } else {
        echo "<script>alert('Failed to insert event details into cancelled_events table');</script>";
    }
} else {
    echo "<script>alert('Event not found');</script>";
}
?>
