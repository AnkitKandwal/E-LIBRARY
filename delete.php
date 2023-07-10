<?php
include 'connection.php';

// Check if the book ID is provided in the URL
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Sanitize the book ID to prevent SQL injection
    $bookId = mysqli_real_escape_string($con, $bookId);

    // Delete the book from the database
    $query = "DELETE FROM add_book WHERE id = '$bookId'";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Redirect back to the book listing page after successful deletion
        header("Location: booklisting.php");
        exit();
    } else {
        // Handle the deletion error appropriately
        echo "Error deleting book: " . mysqli_error($con);
    }
}
?>



