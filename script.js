function renderProducts(productData) {
    console.log('Product data:', productData); // Log the received data

    // Loop through each product and generate HTML dynamically
    for (var i = 0; i < productData.length; i++) {
        var product = productData[i];
        var name = product.name;
        var desc = product.description;
        var price = product.price;
        var imageName = product.image;

            // Generate HTML for each product
            var html = '<div class="product-container">' +
            '    <div class="container">' +
            '        <img src="images/' + imageName + '" alt="Product Image">' +
            '        <h1>' + name + '</h1>' +
            '        <p>' + price + '</p>' +
            '        <a class="buy-now-link" href="login.html?productId=' + encodeURIComponent(i) + '&productName=' + encodeURIComponent(name) + '&productPrice=' + encodeURIComponent(price) + '"><button>Buy Now</button></a>' +
            '    </div>' +
            '    <div class="product-desc">' +
            '        <h2>' + name + '</h2>' +
            '        <p>' + desc + '</p>' +
            '    </div>' +
            '</div>';
            // Append the product HTML to the products section
        $('.products').append(html);
    }
}

$.ajax({
    url: 'get_product_data.php',
    type: 'GET',
    dataType: 'json',
    success: function(productData) {
        renderProducts(productData)
        
        
        // Make an AJAX request to retrieve the username from the session
        $.ajax({
            url: 'get_username.php', // PHP script to get the username from the session
            type: 'GET',
            success: function(response) {
                // Response will contain the username
                let username = response;

                if (username === "admin") {
                    // Create the "|" list item
                    let separatorListItem = document.createElement('li');
                    separatorListItem.innerHTML = '<a>|</a>';

                    // Add the separator list item before the admin list item
                    let listItem = document.getElementById('login-item');
                    listItem.parentNode.insertBefore(separatorListItem, listItem.nextSibling);

                    // Create the admin list item
                    let adminListItem = document.createElement('li');
                    let adminAnchor = document.createElement('a');
                    adminAnchor.href = "admin.php";
                    adminAnchor.textContent = "Admin";
                    adminListItem.appendChild(adminAnchor);

                    // Insert the admin list item after the separator list item
                    separatorListItem.parentNode.insertBefore(adminListItem, separatorListItem.nextSibling);
                }

                if (username) {
                    // User is logged in
                    // Update the login link to welcome message
                    let loginItem = document.getElementById('login-item');
                    let loginAnchor = loginItem.querySelector('a');
                    loginAnchor.textContent = 'Welcome ' + username;
                    loginAnchor.href = "#";

                    // Create the sign out list item
                    let signOutListItem = document.createElement('li');
                    let signOutAnchor = document.createElement('a');
                    signOutAnchor.href = "#";
                    signOutAnchor.textContent = 'Sign out';
                    signOutAnchor.id = "sign-out-item"
                    signOutListItem.appendChild(signOutAnchor);

                    // Replace the register list item with the sign out list item
                    let registerItem = document.getElementById('register-item');
                    registerItem.parentNode.replaceChild(signOutListItem, registerItem);

                    // Select the last appended product container
                    var productContainer = $('.products').children().last();

                    // Loop through each "buy-now-link" element and update its href
                    $('.buy-now-link').each(function() {
                        var currentHref = $(this).attr('href');
                        var newHref = 'cart.php' + currentHref.slice(10);
                        $(this).attr('href', newHref);
                    });

                    // Add event listener for sign out
                    signOutAnchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        // Make an AJAX request to perform sign out
                        $.ajax({
                            url: 'logout.php', // PHP script to perform sign out
                            type: 'GET',
                            success: function(response) {
                                // Redirect to the home page after successful sign out
                                window.location.href = 'index.php';
                            },
                            error: function() {
                                console.log('Error occurred while signing out.');
                            }
                        });
                    });
                }
            },
            error: function() {
                console.log('Error occurred while retrieving the username.');
            }
        });
    },
    error: function() {
        console.log('Error fetching product data.');
    }
});

