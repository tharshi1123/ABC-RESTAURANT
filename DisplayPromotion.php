<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve promotion data from the database
$sql = "SELECT title, description, discount, start_date, end_date, image FROM promotions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion Cards</title>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .card h3 {
            margin-top: 0;
            color: #333;
        }
        .card p {
            margin: 5px 0;
            color: #555;
        }
        .card .discount {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <h2>Current Promotions</h2>
    <div class="card-container">
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="uploads/' . $row["image"] . '" alt="Promotion Image">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<p class="discount">Discount: ' . $row["discount"] . '%</p>';
                echo '<p>Start Date: ' . $row["start_date"] . '</p>';
                echo '<p>End Date: ' . $row["end_date"] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No promotions found.</p>';
        }
        // Close the connection
        $conn->close();
        ?>
    </div>
</body>
</html>
