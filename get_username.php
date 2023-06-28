<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    // Send the username as a response
    echo $_SESSION['username'];
} else {
    // Username not set in the session
    echo "";
}
?>
