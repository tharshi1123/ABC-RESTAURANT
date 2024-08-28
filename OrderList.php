<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Signature Cuisine</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    </head>
    
    <body>
    <h2 class="text-center mb-4">List of Orders</h2>
    <tbody>
        <?php
$conn = mysqli_connect("localhost", "root", "", "data");
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Item</th><th>Quantity</th><th>Name</th><th>Address</th><th>Email</th><th>Action</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row["id"] . '</td><td>'
            . $row["item"] . '</td><td>'
            . $row["quantity"] . '</td><td>'
            . $row["name"] . '</td><td>'
            . $row["address"] . '</td><td>'
            . $row["email"] . '</td><td>'
            . '<form method="post" action="AdminPage.php" style="display:inline;">
                <input type="hidden" name="order_id" value="' . $row["id"] . '">
                <button type="submit" name="action" value="accept"  class="btn btn-success">Accept</button>
              </form>'
            . '</td></tr>';
    }
    echo '</table>';
}
?>


<?php
// Include the necessary PHPMailer classes
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$conn = mysqli_connect("localhost", "root", "", "data");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $orderId = $_POST['order_id'];
    $action = $_POST['action'];

    // Fetch order details from the database
    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if ($order && $action === 'accept') {
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
            $mail->setFrom('tharshika.balachandran98@gmail.com', 'Tharshi'); // Replace with your email and name
            $mail->addAddress($order['email'], $order['name']); // Send email to the customer

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Order Accepted';
            $mail->Body = 'Dear ' . $order['name'] . ',<br>Your order for ' . $order['item'] . ' has been accepted.<br>Thank you for shopping with us!';
            $mail->AltBody = 'Dear ' . $order['name'] . ', Your order for ' . $order['item'] . ' has been accepted. Thank you for shopping with us!';

            $mail->send();
            echo "<script type='text/javascript'>alert('Email sent successfully');</script>";;
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } elseif ($action === 'decline') {
        
    }
    exit();
}
?>

          
        </tbody>
    </table>


    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script> 
    <script src="assets/js/mixitup.js"></script> 
    <script src="assets/js/accordions.js"></script>
    
    <script src="assets/js/custom.js"></script>

  </body>
</html>







*****

