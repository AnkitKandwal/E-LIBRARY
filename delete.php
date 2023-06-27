<?php
include 'connection.php';

$id = $_GET['id'];

// Add mysqli_real_escape_string to sanitize the input
$id = mysqli_real_escape_string($con, $id);

$query = "DELETE FROM add_book WHERE id='$id'";
$result = mysqli_query($con, $query);

if ($result) {
    header("Location: booklisting.php");
    exit();
}
?>
