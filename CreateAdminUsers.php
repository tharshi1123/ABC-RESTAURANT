<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotion</title>
</head>
<body>
    <h2>Add New Admin User</h2>
    <form action="Connection.php" method="POST">
        <label for="username">User name:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="description">User description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

   

        <input type="submit" value="Add admin user">
    </form>
</body>
</html>
