<?php include('Connection.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotion</title>
</head>
<body>
    <h2>Add New Admin User</h2>
    <form action="add_adminuser.php" method="POST">
        <label for="username">User name:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="userRole">User role:</label><br>
    <select id="userRole" name="userRole" required>
        <option value="">--Select a role--</option>
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
    </select><br><br>

    <label for="password">Password:</label><br>
    <input id="password" name="password" required></input><br><br>

    <label for="email">email:</label><br>
    <input id="email" name="email" required></input><br><br>

        <input type="submit" value="Add admin user">
    </form>
</body>
</html>
