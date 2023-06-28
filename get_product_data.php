<?php
// Database Connection
$conn = new mysqli('sql304.infinityfree.com', 'if0_34373884', 'UNEAXF1l1ABgq', 'if0_34373884_iteca');
if ($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}

// Fetch product data from the database
$query = "SELECT * FROM products";
$result = $conn->query($query);
$productData = [];

if ($result === false) {
    // Error occurred
    echo 'Error executing query: '.$conn->error;
    $conn->close();
    exit;
}

if ($result->num_rows > 0) {
    // Loop through each row and fetch product details
    while ($row = $result->fetch_assoc()) {
        $product = [
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'image' => $row['image']
        ];

        // Add product to the data array
        $productData[] = $product;
    }
}

// Close the database connection
$conn->close();

// Return product data as JSON
header('Content-Type: application/json');
echo json_encode($productData);
?>
