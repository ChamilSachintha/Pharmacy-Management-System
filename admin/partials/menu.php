<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>

<html>
    <head>
        <title>Pharmacy Management System - Home Page</title>

        <link rel="stylesheet" href="../css/admin.css">

    </head>

    <body>

        <div class="navbar">
            <a href="index.php">Dashboard</a>

            <div class="dropdown">
                <button class="dropbtn">Users
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="manage-admin.php">Admins</a>
                <a href="manage-employee.php">Employees</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Drugs
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="manage-category.php">Categories</a>
                <a href="manage-medicine.php">Medicines</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Finance
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="manage-order.php">Orders</a>
                <a href="manage-purchases.php">Purchases</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Pharmacy
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="manage-pharmacy.php">Branches</a>
                <a href="manage-company.php">Companies</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Move to
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                <a href="<?php echo SITEURL; ?>">Main Site</a>
                <a href="logout.php">Logout</a>
                </div>
            </div>

        </div>
</html>