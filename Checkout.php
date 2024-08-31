<?php include 'Navbar.php'; ?>
<?php

require 'vendor/autoload.php'; // Include the Composer autoload file

\Stripe\Stripe::setApiKey('sk_test_51PtuWSDyHesoPxCflxI5MAGOLOe2lrv3TBjMmAEbgCQpWZX3Wd3ij8EbhJJnAkpPbkZgnbGv8e79GvYnYbgECrFP002r3OCNkG'); // Replace with your Stripe secret key

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the payment token from the form
    $token = $_POST['stripeToken'];

    // Charge the user's card
    try {
        $charge = \Stripe\Charge::create([
            'amount' => 5000, // Amount in cents (e.g., $50.00)
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);

        echo "<div class='success-message'>Payment successful!</div>";
    } catch (\Stripe\Exception\CardException $e) {
        echo "<div class='error-message'>Error: " . $e->getError()->message . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .checkout-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        #submit {
            background-color: #6772e5;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        #submit:hover {
            background-color: #5469d4;
        }

        .error-message {
            color: #e74c3c;
            margin-top: 20px;
        }

        .success-message {
            color: #2ecc71;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h2>Checkout</h2>
        <form action="checkout.php" method="POST" id="payment-form">
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <button id="submit">Pay $50.00</button>
            <div id="error-message"></div>
        </form>
    </div>

    <script>
        // Create a Stripe client
        var stripe = Stripe('your_stripe_publishable_key'); // Replace with your Stripe publishable key

        // Create an instance of Elements
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div
        card.mount('#card-element');

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Show error in payment form
                    var errorElement = document.getElementById('error-message');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
