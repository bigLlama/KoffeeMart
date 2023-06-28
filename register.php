<?php
    $username = $_POST['uname'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "<script>alert('Error: Passwords do not match!');</script>";
        echo "<script>window.location.href = 'register.html';</script>";
        exit;
    }

    // Database Connection
    $conn = new mysqli('sql304.infinityfree.com', 'if0_34373884', 'UNEAXF1l1ABgq', 'if0_34373884_iteca');
    if ($conn->connect_error) {
        die('Connection Failed: '.$conn->connect_error);
    }

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM members WHERE username = '$username' OR email = '$email'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        // Username or email already exists
        $conn->close();
        echo "<script>alert('Error: Username or email already exists.');</script>";
        echo "<script>window.location.href = 'register.html';</script>";
        exit;
        
    } else {
        // Insert into database
        $query = "INSERT INTO members (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($query) === TRUE) {
            // Registration successful
            $conn->close();
            echo "<script>alert('Registration successful.');</script>";
            echo "<script>window.location.href = 'login.html';</script>";
        } else {
            // Error occurred
            echo "<script>alert('Error: ".$conn->error."');</script>";
            echo "<script>window.location.href = 'register.html';</script>";
            $conn->close();
        }
    }
?>
