<?php include 'includes/indexheader.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Beauty Products</title>
    <style>
        body{
            background-color:  #f8f9fa;
        }
        .card {
            margin-bottom: 20px; 
            height: 100%; 
        }
        .card-img-top {
            height: 200px; 
            object-fit: cover; 
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .row > div[class^="col-"] {
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Beauty Products Available</h2>
        <div class="row">
            <?php
            // Establish connection to your database
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

            // Fetch plants from the database
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    // Format price in Ksh
                    $price_in_ksh = "Ksh " . number_format($row["price"], 2);

                    // Output card for each plant
                    echo '<div class="col-md-4">
                            <div class="card">
                                <img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" class="card-img-top" alt="Plant Image">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row["name"] . '</h5>
                                    <p class="card-text">' . $price_in_ksh . '</p>
                                    <a href="buy.php?id='.$row["id"].'&name='.$row["name"].'&price='.$row["price"].'" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo "No Products available.";
            }

            // Close database connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
<?php include 'includes/footer.php'; ?>
</html>
