<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2{
            font-style: normal;
            color: #522258;
            font-size:30px;
            text-align:center;
}

        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #522258;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #522258;
        }
    </style>
</head>

<body>
    <h2>Add New Promotion</h2>
    <form action="add_promotion.php" method="POST">
        <label for="title">Promotion Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Promotion Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="discount">Discount Percentage:</label><br>
        <input type="number" id="discount" name="discount"  required><br><br>

        <label for="start_date">Start Date:</label><br>
        <input type="date" id="start_date" name="start_date" required><br><br>

        <label for="end_date">End Date:</label><br>
        <input type="date" id="end_date" name="end_date" required><br><br>
<!-- 
        <label for="image">Promotion Image:</label><br>
    <input type="file" id="image" name="image" accept="image/*" required><br><br> -->

        <input type="submit" value="Add Promotion">
    </form>
</body>
</html>
