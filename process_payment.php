<?php
session_start();

// Initialize variables
$totalAmount = 0;
$totalQuantity = 0;
$cartItems = [];

// Calculate total amount and quantity
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    foreach ($cart as $itemName => $item) {
        $totalAmount += $item['price'] * $item['quantity'];
        $totalQuantity += $item['quantity'];
        $cartItems[] = $itemName; // Collect item names
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Your existing cart HTML -->

    <form action="payment_success.php" method="post">
        <div class="form-group">
            <label for="cardholder_name">Cardholder Name</label>
            <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" placeholder="John Doe" required>
        </div>
        
        <div class="form-group">
            <label for="card_number">Card Number</label>
            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="expiry_date">Expiry Date</label>
                <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required pattern="\d{2}/\d{2}">
            </div>

            <div class="form-group col-md-6">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required pattern="\d{3}">
            </div>
        </div>

        <!-- New fields for email and delivery address -->
        <div class="form-group">
            <label for="email">Email Address</label>
            
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
        </div>

        <div class="form-group">
            <label for="email">Contact number</label>
            
            <input type="number" class="form-control" id="contact_number" name="contact_number" placeholder="0771234567" required>
        </div>
        <div class="form-group">
            <label for="delivery_address">Delivery Address</label>
            <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" placeholder="123 Main St, City, Country" required></textarea>
        </div>

        <!-- Hidden fields for order details -->
        <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($totalAmount); ?>">
        <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($totalQuantity); ?>">

        <!-- Hidden fields for item names -->
        <?php foreach ($cartItems as $index => $itemName): ?>
            <input type="hidden" name="item_name_<?php echo $index; ?>" value="<?php echo htmlspecialchars($itemName); ?>">
        <?php endforeach; ?>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
