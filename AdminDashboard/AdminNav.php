<?php
// Start session
session_start();

// Check if user is an admin or staff
$is_admin = isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">

  <head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>ABC RESTAURANT</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    </head>
    <style>

        /* General styles for the header area */
.header-area {
    background-color: #343a40; /* Dark background for the header */
    padding: 10px 0; /* Padding around the header */
}

.header-sticky {
    position: sticky;
    top: 0;
    z-index: 1000; /* Ensure the header is above other content */
}

.main-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav {
    list-style: none;
    display: flex;
    padding: 0;
    margin: 0;
}

.nav li {
    margin-right: 20px;
}

.nav a {
    color: #ffffff; /* White text color */
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    padding: 10px 15px;
    display: block;
    transition: background-color 0.3s, color 0.3s;
}

.nav a.active {
    background-color: #007bff; /* Blue background for the active link */
    color: #ffffff; /* White text color for active link */
    border-radius: 4px; /* Rounded corners */
}

.nav a:hover {
    background-color: #495057; /* Darker background on hover */
    color: #ffffff; /* White text color on hover */
    border-radius: 4px; /* Rounded corners on hover */
}

/* Style for dropdown items */
.dropdown-menu {
    position: absolute;
    background-color: #ffffff; /* White background for dropdown */
    border: 1px solid #dee2e6; /* Light border for dropdown */
    border-radius: 4px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow for dropdown */
    display: none;
    top: 100%;
    left: 0;
    width: 200px; /* Width of dropdown */
}

.dropdown-item {
    color: #343a40; /* Dark text color for dropdown items */
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s, color 0.3s;
}

.dropdown-item:hover {
    background-color: #f8f9fa; /* Light background on hover */
    color: #007bff; /* Blue text color on hover */
}

/* Show the dropdown menu when the parent is hovered */
.nav li.dropdown:hover .dropdown-menu {
    display: block;
}

/* Style for buttons */
.btn-success {
    background-color: #28a745; /* Green background */
    color: #ffffff; /* White text color */
    border: none;
    padding: 10px 20px;
    border-radius: 4px; /* Rounded corners */
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-success:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Style for menu-trigger */
.menu-trigger {
    display: none; /* Hidden by default */
    cursor: pointer;
    color: #ffffff; /* White text color */
    font-size: 18px;
    padding: 10px 20px;
}

/* Responsive styles */
@media (max-width: 768px) {
    .nav {
        flex-direction: column;
        display: none; /* Hidden by default */
    }

    .nav li {
        margin: 10px 0;
    }

    .menu-trigger {
        display: block; /* Show the menu trigger button on small screens */
    }

    .menu-trigger.active + .nav {
        display: flex; /* Show the navigation when menu trigger is active */
    }
}

        </style>

    <body>
        
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
            
                        <ul class="nav">
                            <li><a href="AdminPage.php" class="active">Home</a></li>
                            <li><a href="AdminOrderDashboard\OrderList.php" class="active">Orders</a></li>
                            <li><a href="AdminOrderDashboard\Accepted_orders.php" class="active">Accepted orders</a></li>
                            <li><a href="Users\Users.php" class="active">Customers</a></li>
                            <li><a href="AdminPromotionDashboard\Promotions.php" class="active">Promotions</a></li>
                            <li><a href="AdminQueryDashboard\AdminQueryList.php" class="active">Quaries</a></li>
                            <li><a href="AdminQueryDashboard\RepliedQuery.php" class="active"> Query replies</a></li>
                          
 <!-- Conditionally disable buttons for staff -->
 <?php if ($is_admin): ?>
    <li><a href="Adminuser_dashboard.php" class="active">Adminusers</a></li>

                                <li>
                                    <form action="AdminPromotionDashboard\CreateOffer.php" method="post">
                                        <button type="submit" name="connectButton" class="btn btn-success">Create New Promotions</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="CreateAdminUsers.php" method="post">
                                        <button type="submit" name="connectButton" class="btn btn-success">Create New Users</button>
                                    </form>
                                </li>
                            <?php else: ?>
                                <!-- Hide or disable buttons for staff -->
                                <li>
                                    <button class="btn btn-secondary" disabled>Adminusers (Admin Only)</button>
                                </li>
                                <li>
                                    <button class="btn btn-secondary" disabled>Create New Promotions (Admin Only)</button>
                                </li>
                                <li>
                                    <button class="btn btn-secondary" disabled>Create New Users (Admin Only)</button>
                                </li>
                            <?php endif; ?>
    
                            <li class="dropdown">
                              
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="Signup.php" class="active">Sign up</a>
                                </div>
                            </li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>

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