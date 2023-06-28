<?php
// Database Connection
$conn = new mysqli('sql304.infinityfree.com', 'if0_34373884', 'UNEAXF1l1ABgq', 'if0_34373884_iteca');
if ($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}

// Get the product name from the form
$name = $_POST['name'];

// Remove the product from the database
$query = "DELETE FROM products WHERE name = '$name'";
if ($conn->query($query) === true) {
    header('Location: index.php'); // Redirect to the home page
    exit();
} else {
    echo 'Error removing product: '.$conn->error;
}

// Close the database connection
$conn->close();
?>
