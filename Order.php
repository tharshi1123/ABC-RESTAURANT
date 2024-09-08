

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        .menu-item {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .menu-item h3 {
            margin: 0;
            padding: 0;
        }
        .menu-item p {
            margin: 5px 0;
        }
        .menu-item button {
            background-color: #6772e5;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .menu-item button:hover {
            background-color: #5469d4;
        }
        .success-message {
            color: #2ecc71;
            margin-bottom: 20px;
        }
        .cart-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Menu</h2>

    <?php foreach ($menu_items as $item): ?>
        <div class="menu-item">
            <h3><?php echo $item['name']; ?></h3>
            <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
            <form method="POST" action="Cart.php">
                <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                <input type="hidden" name="item_name" value="<?php echo $item['name']; ?>">
                <input type="hidden" name="item_price" value="<?php echo $item['price']; ?>">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>

    <div class="cart-button">
        <a href="Cart.php"><button>View Cart</button></a>
    </div>
</body>
</html>
