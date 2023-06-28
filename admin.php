<?php
session_start();

// Check if the user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="forms.css">
    <link rel="icon" href="media/icon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>KoffeeMart</title>
</head>
<body>
    
    <nav>
        <div class="nav-heading">
            <img src="media/coffee_logo.png" alt="logo" id="nav-logo">
            <h1>KoffeeMart</h1>
        </div>

        <div class="login-links">
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>
    </nav>

    <div class="form-container">
        <form class="product-form" action="add_product.php" method="POST" enctype="multipart/form-data">
            <h1>Add a Product</h1>
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" class="input-field" required>

            <label for="desc">Product Description</label>
            <textarea id="description" name="description" class="input-field" required></textarea>

            <label for="price">Product Price</label>
            <input type="text" id="price" name="price" class="input-field" required>

            <label for="image">Product Image</label>
            <input type="file" id="image" name="image" class="input-field" required>

            <button type="submit" class="button">Add Product</button>
        </form>
        
        <form class="remove-form" action="remove_product.php" method="POST">
            <h1>Remove a Product</h1>

            <select name="name" class="dropdown">
                <?php
                    $conn = new mysqli('sql304.infinityfree.com', 'if0_34373884', 'UNEAXF1l1ABgq', 'if0_34373884_iteca');
                    if ($conn->connect_error) {
                        die('Connection Failed: '.$conn->connect_error);
                    }

                    $query = "SELECT name FROM products";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $productName = $row['name'];
                            echo "<option value='$productName'>$productName</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No products found</option>";
                    }
                    
                    $conn->close();
                ?>
            </select>

            <button type="submit" class="button">Remove Product</button>
        </form>
    </div>

    <footer>
        <img src="media/coffee_logo.png" alt="logo" id="footer-logo">
        <p>&copy; KoffeeMart 2023</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
