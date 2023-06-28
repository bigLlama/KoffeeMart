<?php
// Retrieve form data
$username = $_POST['uname'];
$password = $_POST['password'];

// Database Connection
$conn = new mysqli('sql304.infinityfree.com', 'if0_34373884', 'UNEAXF1l1ABgq', 'if0_34373884_iteca');
if ($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}

// Check user credentials
$query = "SELECT * FROM members WHERE username = '$username' AND password = '$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    // Username and password match
    $conn->close();

    // Start session and store the username
    session_start();
    $_SESSION['username'] = $username;

    // Redirect to index.php
    header("Location: index.php");
    exit;
} else {
    // Invalid username or password
    $conn->close();
    echo "<script>alert('Error: Invalid username or password.');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
}
?>
