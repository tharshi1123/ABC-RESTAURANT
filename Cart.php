<?php
session_start();

// Handle item deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item'])) {
    $itemToDelete = $_POST['delete_item'];
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['item'] === $itemToDelete) {
            unset($_SESSION['cart'][$key]);
            // Re-index the array to avoid gaps
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
            background-color: #f8f9fa;
        }
        h1 {
            margin-bottom: 20px;
            color: #343a40;
        }
        .cart-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .cart-item {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        .cart-item h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .cart-item p {
            margin: 5px 0;
            font-size: 16px;
        }
        .cart-total {
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
            color: #0074D9;
        }
        .cart-actions {
            margin-top: 20px;
        }
        .cart-actions button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #0074D9;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .empty-cart-message {
            color: #6c757d;
            font-size: 18px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <!-- ***** Header Area Start ***** -->
    <?php include 'Navbar.php'; ?>
    <!-- ***** Header Area End ***** -->

    <h1>Your Cart</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p class="empty-cart-message">Your cart is empty.</p>
    <?php else: ?>
        <div class="cart-container">
            <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                <div class="cart-item">
                    <h2><?php echo htmlspecialchars($cartItem['item']); ?></h2>
                    <p><strong>Quantity:</strong> <?php echo htmlspecialchars($cartItem['quantity']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($cartItem['name']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($cartItem['address']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($cartItem['email']); ?></p>
                    <form method="post" action="">
                        <input type="hidden" name="delete_item" value="<?php echo htmlspecialchars($cartItem['item']); ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="cart-total">
            Total Items: <?php echo count($_SESSION['cart']); ?>
        </div>
    <?php endif; ?>

    <div class="cart-actions">
        <button onclick="window.location.href='Order.php'" class="btn btn-primary">Continue Shopping</button>
        <?php if (!empty($_SESSION['cart'])): ?>
            <button onclick="window.location.href='checkout.php'" class="btn btn-success">Checkout</button>
        <?php endif; ?>
    </div>

    <!-- ***** Footer Area Start ***** -->
    <?php include 'Footer.php'; ?>
    <!-- ***** Footer Area End ***** -->

</body>
</html>
