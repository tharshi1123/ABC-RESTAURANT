<?php
// Include the necessary PHPMailer classes
require 'C:\xampp\htdocs\ABC restaurant\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\ABC restaurant\PHPMailer\src\SMTP.php';
require 'C:\xampp\htdocs\ABC restaurant\PHPMailer\src\Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
$conn = mysqli_connect("localhost", "root", "", "data");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $orderId = $_POST['order_id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        // Fetch order details from the database
        $sql = "SELECT * FROM order_details WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();

        if ($order) {
            // Send email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'tharshika.balachandran98@gmail.com'; // Replace with your SMTP username
                $mail->Password = 'xzlbjqfdgdwxmdxn'; // Replace with your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('tharshika.balachandran98@gmail.com', 'ABC Restaurant');
                $mail->addAddress($order['email'], $order['cardholder_name']); // Send email to the customer

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Your Order Bill';
                $mail->Body = '
                <html>
                <head>
                    <style>
                        .card {
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            padding: 20px;
                            margin: 20px auto;
                            width: 80%;
                            max-width: 600px;
                        }
                        .card-header {
                            background-color: #f8f9fa;
                            padding: 10px;
                            border-bottom: 1px solid #ddd;
                            font-size: 1.25em;
                            font-weight: bold;
                        }
                        .card-body {
                            padding: 10px;
                        }
                        .card-body table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .card-body th, .card-body td {
                            padding: 10px;
                            border-bottom: 1px solid #ddd;
                        }
                        .card-footer {
                            text-align: center;
                            padding: 10px;
                            border-top: 1px solid #ddd;
                            background-color: #f8f9fa;
                            font-size: 0.875em;
                        }
                    </style>
                </head>
                <body>
                    <div class="card">
                        <div class="card-header">Order Confirmation</div>
                        <div class="card-body">
                            <p>Dear ' . htmlspecialchars($order['cardholder_name']) . ',</p>
                            <p>Your order with ID #' . htmlspecialchars($order['id']) . ' has been accepted.</p>
                            <table>
                                <tr><th>ID</th><td>' . htmlspecialchars($order['id']) . '</td></tr>
                                <tr><th>Item</th><td>' . htmlspecialchars($order['item_names']) . '</td></tr>
                                <tr><th>Quantity</th><td>' . htmlspecialchars($order['quantity']) . '</td></tr>
                                <tr><th>Total Amount</th><td>' . htmlspecialchars($order['total_amount']) . '</td></tr>
                                <tr><th>Address</th><td>' . htmlspecialchars($order['delivery_address']) . '</td></tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            Thank you for shopping with us!
                        </div>
                    </div>
                </body>
                </html>';
                $mail->AltBody = 'Dear ' . htmlspecialchars($order['cardholder_name']) . ', Your order with ID #' . htmlspecialchars($order['id']) . ' has been accepted. Thank you for shopping with us!';

                $mail->send();

                // Move order to accepted_orders table
                $insertSql = "INSERT INTO accepted_orders (item, quantity, name, address, total_amount, email) VALUES (?, ?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param('sissis', $order['item_names'], $order['quantity'], $order['cardholder_name'], $order['delivery_address'], $order['total_amount'], $order['email']);
                $insertStmt->execute();

                // Delete order from orders table
                $deleteSql = "DELETE FROM order_details WHERE id = ?";
                $deleteStmt = $conn->prepare($deleteSql);
                $deleteStmt->bind_param('i', $orderId);
                $deleteStmt->execute();

                echo "<script type='text/javascript'>alert('Email sent and order moved successfully'); window.location.href='order_list.php';</script>";
            } catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Order List</title>
</head>
<style>
    /* Center the table and add margin */
    .table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    /* Style table headers */
    .table thead th {
        background-color: #f8f9fa; /* Light gray background for headers */
        color: #343a40; /* Dark gray text color */
        padding: 10px;
        border-bottom: 2px solid #dee2e6; /* Darker bottom border */
        text-align: left;
    }

    /* Style table cells */
    .table tbody td {
        background-color: #ffffff; /* White background for cells */
        color: #495057; /* Darker gray text color */
        padding: 10px;
        border-bottom: 1px solid #dee2e6; /* Light gray border for rows */
    }

    /* Alternate row colors */
    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Light gray background for odd rows */
    }

    .table tbody tr:hover {
        background-color: #e9ecef; /* Slightly darker gray on hover */
    }

    /* Style for empty rows message */
    .table tbody td.text-center {
        text-align: center;
        color: #6c757d; /* Light gray color for text */
        padding: 20px; /* More padding for the message */
    }

    /* Add table borders */
    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }
</style>
<body>
    <h2 class="text-center mb-4">List of Orders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item name</th>
                <th>Cardholder Name</th>
                <th>Expiry Date</th>
                <th>CVV</th>
                <th>Total Amount</th>
                <th>Quantity</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM order_details";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td>' . htmlspecialchars($row["id"]) . '</td><td>'
                    . htmlspecialchars($row["item_names"]) . '</td><td>'
                        . htmlspecialchars($row["cardholder_name"]) . '</td><td>'
                        . htmlspecialchars($row["expiry_date"]) . '</td><td>'
                        . htmlspecialchars($row["cvv"]) . '</td><td>'
                        . htmlspecialchars($row["total_amount"]) . '</td><td>'
                        . htmlspecialchars($row["quantity"]) . '</td><td>'
                        
                        . htmlspecialchars($row["delivery_address"]) . '</td><td>'
                        . htmlspecialchars($row["email"]) . '</td><td>'
                         . htmlspecialchars($row["contact_number"]) . '</td><td>'
                        . '<form method="post" action="" style="display:inline;">
                            <input type="hidden" name="order_id" value="' . htmlspecialchars($row["id"]) . '">
                            <button type="submit" name="action" value="accept" class="btn btn-success">Accept</button>
                          </form>'
                        . '</td></tr>';
                }
            } else {
                echo '<tr><td colspan="10" class="text-center">No order details found</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
