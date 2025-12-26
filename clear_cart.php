<?php
@include 'config.php';

// Check if the request is a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Clear the cart
    mysqli_query($conn, "DELETE FROM `cart`");
    // Respond with a success message
    echo "Cart cleared successfully";
} else {
    // Respond with an error message
    echo "Invalid request method";
}
?>
    