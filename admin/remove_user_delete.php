<?php
include("common/conn.php");
$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = '$id' ";
$run_query = mysqli_query($conn, $query);
header("Location: remove_users.php");


//echo "<script>alert('".$id."');</script>";
?>