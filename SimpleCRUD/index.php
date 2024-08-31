<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    </head>
    <body>
        <div id="container my-5">
            <h2>Products</h2>
            <a class="btn btn-primary" href="/simpleCRUD/create.php" role="button">New Product</a>
            <br>
            <table class="table">
                <thread>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                </thread>
                <tbody>
                    <?php
                    //connect
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "myshop";

                    $connection = new mysqli($servername, $username, $password, $dbname);
                    //check
                    if ($connection->connect_error) {
                        die("Connection failed: ". $connection->connect_error);
                    }

                    //read
                    $sql = "SELECT * FROM products";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    //read row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>". $row['id']. "</td>";
                        echo "<td>". $row['name']. "</td>";
                        echo "<td>". $row['description']. "</td>";
                        echo "<td>". $row['price']. "</td>";
                        echo "<td>". $row['quantity']. "</td>";
                        echo "<td>". $row['created_at']. "</td>";
                        echo "<td>". $row['updated_at']. "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-primary btn-sm' href='/simpleCRUD/edit.php?id=". $row['id']. "'>Edit</a>";
                        echo "<a class='btn btn-danger btn-sm' href='/simpleCRUD/delete.php?id=". $row['id']. "'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </body>