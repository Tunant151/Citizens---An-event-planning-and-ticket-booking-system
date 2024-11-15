<?php
include("../admin/common/conn.php");

if(isset($_POST["scan_ticket"])){
    $id = $_POST['ticket_id'];

    $query = "UPDATE tickets SET ticket_status = 'checked' WHERE id = '$id'";
    $run_query = mysqli_query($conn, $query);
    
    if($run_query) {
        echo "<script>alert('Successfully Scanned ticket!');</script>";
        header("Location: scan_event.php");
        exit; 
    } else {
        echo "<script>alert('Failed to Scan ticket!');</script>";
    }
}
?>
