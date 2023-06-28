<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="icon" href="media/icon.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
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
                <li><a>|</a></li>
                <li><a href="cart.html">My Cart</a></li>
                <li><a>|</a></li>
                <li><a href="#" id="logout">Sign Out</a></li>
            </ul>
        </div>
    </nav>

    <div class="cart-table-container">
        <h1>My Cart</h1>
        <table class="cart-table">
          <tr>
            <th>Item Name</th>
            <td><p><?php echo isset($_GET['productName']) ? $_GET['productName'] : ''; ?></p></td>
          </tr>
          <tr>
          <tr>
            <th>Quantity</th>
            <td><input type="number" id="product-quantity" value="1" min="1"></td>
        </tr>
          </tr>
          <tr>
            <th>Total Amount</th>
            <td><p><?php echo isset($_GET['productPrice']) ? $_GET['productPrice'] : ''; ?></p></td>
          </tr>
        </table>
        <button type="submit" class="button" onclick="checkout()">Proceed to Checkout</button>
    </div>

    <footer>
        <img src="media/coffee_logo.png" alt="logo" id="footer-logo">
        <p>&copy; KoffeeMart 2023</p>
    </footer>

    <script src="cart.js"></script>
    <script>
        function checkout() {
        alert("An invite link to the bot has been sent to your email!");
    }
</script>

</body>
</html>