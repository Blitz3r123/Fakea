<?php
    session_start();
    require_once('connect.php');
    
    $CustomerID = $_SESSION['CustomerID'];

    $sql = "SELECT * FROM Customer WHERE CustomerID = " . $CustomerID;

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Customer Home</title>
    </head>
    <body>
        <h1>Welcome <?php echo $row['CustomerName']; ?></h1>
        <p>What would you like to do?</p>
        <p>
            <a href="Order.php">Order Furniture</a>    
        </p>
        <p>
            <a href="ViewOrders.php">View Orders</a>
        </p>
        <p>
            <a href="Logout.php">Logout</a>
        </p>
    </body>
</html>