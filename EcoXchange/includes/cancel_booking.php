<?php
include('../includes/dbconn.php');

if (isset($_GET['book_ID'])) {
    $book_ID = mysqli_real_escape_string($dbconn, $_GET['book_ID']);
    
    // Perform the necessary database operations to cancel the booking
    $sql = "UPDATE booking SET book_status = 'cancel' WHERE book_ID = '$book_ID'";
    
    if (mysqli_query($dbconn, $sql)) {
        // Redirect back to the bookings page with a success message
        header("Location: bookings.php?message=Booking canceled successfully");
    } else {
        // Redirect back to the bookings page with an error message
        header("Location: bookings.php?message=Error canceling booking");
    }
} else {
    // Redirect back to the bookings page with an error message
    header("Location: bookings.php?message=Invalid booking ID");
}
?>
