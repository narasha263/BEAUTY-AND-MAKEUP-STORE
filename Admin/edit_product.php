<?php
session_start();

// Initialize variables
$plant_id = $plant_name = $plant_price = $plant_image = "";

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

// Fetch plant details based on ID
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $plant_id = trim($_GET["id"]);
    
    // Prepare and execute SQL statement to fetch plant details
    $sql_select = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql_select);
    $stmt->bind_param("i", $plant_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if plant exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $plant_name = $row["name"];
        $plant_price = $row["price"];
        $plant_image = $row["image"];
    } else {
        echo "Product not found.";
        exit();
    }
}

// Process form submission to update plant details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $new_name = $_POST['name'];
    $new_price = $_POST['price'];
    
    // Check if image file is uploaded
    if (!empty($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])) {
        $new_image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    } else {
        // If no image is uploaded, retain the existing image
        $new_image = $plant_image;
    }

    // Prepare and execute SQL statement to update plant details
    $sql_update = "UPDATE products SET name = ?, image = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssdi", $new_name, $new_image, $new_price, $plant_id);
    if ($stmt->execute()) {
        echo "<script>alert('Products details updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating product details.');</script>";
    }

    
}


// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Beauty Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
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
        /* Add any additional styles for hover state */
    }


        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Positioning the form within the main content area */
        .main-content {
            margin-left: 250px; /* Same width as sidebar */
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
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
        <h2>Edit Beauty Product</h2>
        <div class="form-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $plant_id; ?>">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" value="<?php echo $plant_name; ?>" required><br>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image"><br>
                <label for="price">Price:</label><br>
                <input type="text" id="price" name="price" value="<?php echo $plant_price; ?>" required><br>
                <input type="submit" value="Update Product">
            </form>
        </div>
</body>
</html>
