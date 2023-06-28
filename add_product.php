<?php
// Database Connection
$conn = new mysqli('sql304.infinityfree.com', 'if0_34373884', 'UNEAXF1l1ABgq', 'if0_34373884_iteca');
if ($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}

// Get the product details from the form
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

// Process the uploaded image
$imageName = $_FILES['image']['name'];
$imageTmpName = $_FILES['image']['tmp_name'];
$imageError = $_FILES['image']['error'];

// Check if the image was uploaded successfully
if ($imageError === UPLOAD_ERR_OK) {
    $targetDir = 'images/'; // Directory to store the images
    $targetPath = $targetDir . $imageName;

    // Move the uploaded image to the target directory
    if (move_uploaded_file($imageTmpName, $targetPath)) {
        // Image upload successful, insert product details into the database
        $query = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$imageName')";
        if ($conn->query($query) === true) {
            header('Location: index.php'); // Redirect to the home page
            exit();
        } else {
            echo 'Error adding product: '.$conn->error;
        }
    } else {
        echo 'Error uploading image.';
    }
} else {
    echo 'Error uploading image: '.$imageError;
}

// Close the database connection
$conn->close();
?>
