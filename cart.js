window.addEventListener('DOMContentLoaded', function() {
    var totalAmountElement = document.querySelector('.cart-table tr:last-child td p');
    var quantityElement = document.getElementById('product-quantity');

    // Retrieve the initial amount value
    var initialAmount = parseFloat(totalAmountElement.innerText.replace('R', '').replace(',', '.'));

    // Add event listener for quantity changes
    quantityElement.addEventListener('change', function() {
        var quantity = parseInt(quantityElement.value);
        var updatedAmount = initialAmount * quantity;

        // Update the total amount display
        totalAmountElement.innerText = 'R' + updatedAmount.toFixed(2).toString().replace('.', ',');
    });
});

let signOutAnchor = document.getElementById('logout')
signOutAnchor.addEventListener('click', function(e) {
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