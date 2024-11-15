<?php
include("common/conn.php");
$id = $_GET['id'];

$query = "DELETE FROM stakeholder_stake WHERE id = '$id' ";
$run_query = mysqli_query($conn, $query);
header("Location: view_stakes.php");


//echo "<script>alert('".$id."');</script>";
?>