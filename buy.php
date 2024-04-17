<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Buy Beauty and Make Up Products</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            

            
        }
        .container {
            margin-top: 50px; /* Add some space from the top */
        }
        h2 {
            color: #007bff; /* Blue color for the heading */
            font-size: 24px; /* Adjust the font size */
            font-weight: bold; /* Make the text bold */
            text-align: center; /* Center align the text */
            margin-bottom: 30px; /* Add space below the heading */
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Add a subtle shadow to the cards */
            max-width: 600px; /* Limit the maximum width of the card */
            margin: 0 auto; /* Center the card horizontally */
        }
        .card-body {
            padding: 20px; /* Add padding inside the card body */
        }
        .card-title {
            margin-bottom: 15px; /* Add some space below the card title */
        }
        .card-text {
            margin-bottom: 20px; /* Add some space below the card text */
        }
        .btn-primary {
            background-color: #007bff; /* Blue primary button */
            border-color: #007bff; /* Matching border color */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Matching border color on hover */
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Beauty and Make Up Details</h2>
        <?php
        if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price'])) {
            $id = $_GET['id'];
            $name = $_GET['name'];
            $price = $_GET['price'];
            echo '<div class="card">
                    <div class="card-body">
                        <h5 class="card-title">' . $name . '</h5>
                        <p class="card-text">Price: Ksh ' . number_format($price, 2) . '</p>
                        <a href="M-PESA/checkout.php?id='.$id.'&name='.$name.'&price='.$price.'" class="btn btn-primary">Checkout</a>
                    </div>
                </div>';
        } else {
            echo "Beauty and Make Up details not provided.";
        }
        ?>
    </div>
</body>

</html>
