<?php
    session_start();
    require_once('LoginCheck.php');
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
        <link rel="stylesheet" href="css/CustomerIndexStyle.css">
    </head>
    <body>
        <h1>Welcome <?php echo $row['CustomerName']; ?></h1>

        <p id="subtitle">What would you like to do?</p>

        <div class="buttons">
            <a href="Order.php">Order Furniture</a>    
            <a href="ViewOrders.php">View Orders</a>
            <a href="Logout.php">Logout</a>
        </div>

    </body>
</html>