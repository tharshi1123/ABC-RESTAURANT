<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotion</title>
</head>
<body>
    <h2>Add New Promotion</h2>
    <form action="add_promotion.php" method="POST">
        <label for="title">Promotion Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Promotion Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="discount">Discount Percentage:</label><br>
        <input type="number" id="discount" name="discount" min="1" max="100" required><br><br>

        <label for="start_date">Start Date:</label><br>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">End Date:</label><br>
        <input type="date" id="end_date" name="end_date" required><br><br>

        <!-- <label for="image">Promotion Image:</label><br>
    <input type="file" id="image" name="image" accept="image/*" required><br><br> -->

        <input type="submit" value="Add Promotion">
    </form>
</body>
</html>
