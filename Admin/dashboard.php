<?php
session_start();

// Get admin username from session
$admin_username = $_SESSION["admin_username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: black;
            font-weight: bold;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 50px; /* Adjust as needed */
        }
        .main-content {
            margin-left: 250px; /* Same width as sidebar */
            padding: 20px;
        }
        .navbar-brand {
        color: #fff; /* Text color */
        font-size: 24px; /* Font size */
        font-weight: bold; /* Font weight */
        text-decoration: none; /* Remove underline */
        align-text:center;
    }

    .navbar-brand:hover {
        color: #ccc; /* Text color on hover */
        
    }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <!-- Add your sidebar links here -->
            <li class="nav-item">
                <a class="nav-link" href="Users.php">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Products.php">Manage Products</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="messages.php">Manage Messages</a>
            </li>
           
            
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <h2>Welcome, <?php echo $admin_username; ?>!</h2>
        <p>This is your dashboard. You can manage your admin tasks here.</p>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+raYXN2wE6z3nssL3k/AAfUt9a0Zvsg+3g6PVCt25X5b5J9p2StU8z+nJs" crossorigin="anonymous"></script>
</body>
</html>
