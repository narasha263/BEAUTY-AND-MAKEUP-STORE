<?php
session_start();

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beauty";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete message if ID is provided
if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    $sql_delete = "DELETE FROM contact WHERE id = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Message deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting message');</script>";
    }
}

// Fetch all messages
$sql_select = "SELECT * FROM contact ORDER BY created_at DESC";
$result = $conn->query($sql_select);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 20px; /* Adjust as needed */
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .table-container {
            margin: 0 auto;
            width: 90%; /* Adjust as needed */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        .btn-delete {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
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

    <div class="main-content">
        <h2>Messages</h2>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo"<td>" . $row["id"] . "</td>" .
                            "<td>" . $row["name"] . "</td>" .
                            "<td>" . $row["email"] . "</td>" .
                            "<td>" . $row["message"] . "</td>" .
                            "<td>" . $row["created_at"] . "</td>" .
                            "<td>" .
                            "<a href='?delete=" . $row["id"] . "' class='btn-delete'>Delete</a>" .
                            "</td>" .
                            "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No messages found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>                            
