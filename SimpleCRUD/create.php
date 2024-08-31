<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myshop";

$connection = new mysqli($servername, $username, $password, $dbname);



$name = "";
$description = "";
$price = "";
$quantity = "";

 $errorMessage = "";
 $successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST ['name'];
    $description = $_POST ['description'];
    $price = $_POST ['price'];
    $quantity = $_POST ['quantity'];

    do {
        if (empty($name) || empty($description) || empty($price) || empty($quantity)) {
            $errorMessage = "All felds are required";
            break;
        }

        // add new client to database
        $sql = "INSERT INTO products (name, description, price, quantity) " .
            "VALUES ('$name', '$description', '$price', '$quantity')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $description = "";
        $price = "";
        $quantity = "";

        $successMessage = "Product added successfully";

        header("location: /simpleCRUD/index.php");
        exit;


    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <?php
    if( !empty($errorMessage)) {
        echo '<div class="alert alert-danger">'. $errorMessage. '</div>';
    }

    ?>

    <div class="container my-5">
        <h2>New Product</h2>
        <form method="post">
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                </div>
            </div>
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>" required>
                </div>
            </div>
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" required>
                </div>
            </div>
            <div class = "row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>" required>
                </div>
            </div>

            <?php if (!empty($successMessage)) {
                echo '<div class="alert alert-success">'. $successMessage. '</div>';  }?>
            

            <div class = "row mb-3">
                <div class="col-sm-6 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/simpleCRUD/index.php/" role="button">Cancel</a>
                </div>
                
        
            </div>
    </div>
        </form>
    </div>
</body>
</html>