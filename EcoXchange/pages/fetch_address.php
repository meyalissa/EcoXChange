<?php
// Include necessary files and start the session if not already started
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

// Start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the address ID is provided via POST
if (isset($_POST['address_id'])) {
    // Sanitize the input to prevent SQL injection
    $address_id = mysqli_real_escape_string($dbconn, $_POST['address_id']);

    // Fetch the address details from the database based on the provided address ID
    $sql = "SELECT * FROM address WHERE address_ID = '$address_id'";
    $result = mysqli_query($dbconn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the address details as an associative array
        $row = mysqli_fetch_assoc($result);

        // Construct the full address string
        $full_address = $row['Name'] . ", " . $row['Contact'] . "<br>" .
                        $row['house_no'] . ", " . $row['street_name'] . ", " .
                        $row['city'] . ", " . $row['state'] . " " . $row['postcode'];

        // Return the full address string
        echo $full_address;
    } else {
        // If the query fails, return an error message
        echo "Error fetching address details.";
    }
} else {
    // If the address ID is not provided, return an error message
    echo "No address ID provided.";
}

// Close the database connection
mysqli_close($dbconn);
?>
