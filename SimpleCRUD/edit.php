<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myshop";

$connection = new mysqli($servername, $username, $password, $dbname);

$id = "";
$name = "";
$description = "";
$price = "";
$quantity = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get
    if (!isset($_GET["id"])) {
        header("location: /simpleCRUD/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /simpleCRUD/index.php");
        exit;
    }

    $name = $row["name"];
    $description = $row["description"];
    $price = $row["price"];
    $quantity = $row["quantity"];
} else {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    do {
        if (empty($id) || empty($name) || empty($description) || empty($price) || empty($quantity)) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE products SET name='$name', description='$description', price='$price', quantity='$quantity' WHERE id=$id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Product successfully updated";

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

    <?php if (!empty($errorMessage)) {
        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
    } ?>

    <div class="container my-5">
        <h2>Edit Product</h2>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>" required>
                </div>
            </div>

            <?php if (!empty($successMessage)) {
                echo '<div class="alert alert-success">' . $successMessage . '</div>';
            } ?>

            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/simpleCRUD/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
