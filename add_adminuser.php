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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $userRole = $conn->real_escape_string($_POST['userRole']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);

    // SQL query to insert promotion data into the database
    $sql = "INSERT INTO adminusers (username, userRole , password, email) VALUES ('$username', '$userRole', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New admin user added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
