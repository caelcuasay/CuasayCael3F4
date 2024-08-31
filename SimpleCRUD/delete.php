<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";
// Create connection
    $connection = new mysqli($servername, $username, $password, $database);
    $sql = "DELETE FROM products WHERE id=$id";
    $connection->query($sql);
}
header("location: /simpleCRUD/index.php");
exit;
?>