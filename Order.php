<!DOCTYPE html>
<html>
<head>
    <style>
        body {
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 20px;
}

form {
    max-width: 400px;
    margin: 0 auto;
}

label {
    display: block;
    margin-top: 10px;
}

input[type="text"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    background-color: #0074D9;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

h1 {
    background-color: #333;
    color: #fff;
    padding: 10px;
}



    </style>

<script>
        function displaySuccessMessage() {
            var successMessage = document.getElementById("success-message");
            successMessage.style.display = "block";
        }
    </script>
    <title>Order Food</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Signature Cuisine</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    
    <!-- ***** Header Area Start ***** -->
    <?php include 'Navbar.php'; ?>
    <!-- ***** Header Area End ***** -->
    <br>
    <!-- ***** Call to Action Start ***** -->
    <section  id="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2> <em> Order Now</em></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->
    <form action="process_order.php" method="post" ass="form-group">
    <div class="form-group">
        <label for="item">Select Item:</label>
        <select name="item" id="item" class="form-control">
            <option value="VEGETABLE SPRING ROLLS">VEGETABLE SPRING ROLLS</option>
            <option value="FRENCH FRIES">FRENCH FRIES</option>
            <option value="CRISPY FRIED PRAWNS">CRISPY FRIED PRAWNS</option>
            <option value="burger">Caprese Salad</option>
            <option value="burger">Classic Cheeseburger</option>
            <option value="sushi">Grilled Salmon</option>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number"class="form-control" name="quantity" id="quantity" min="1" required>
        <label for="name">Your Name:</label>
        <input type="text" class="form-control" name="name" id="name" required>
        <label for="address">Delivery Address:</label>
        <textarea name="address" class="form-control" id="address" rows="4" required></textarea>
        <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
        <br>
        <button onclick="displaySuccessMessage()" class="btn btn-primary">Order Now</button>
    </div>
    </form>

     <!-- ***** Footer Area Start ***** -->
     <?php include 'Footer.php'; ?>
    <!-- ***** Footer Area End ***** -->
     
</body>
</html>
