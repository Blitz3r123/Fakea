<?php
    session_start();
    require_once('connect.php');
    $CustomerID = $_SESSION['CustomerID'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Order</title>
    </head>
    <body>
        <h1>Your orders:</h1>
        <a href="viewOrders.php">Back</a>
        <?php

            $totalPrices = [];
            $totalPrice = 0;

            $sql = "SELECT Date, Quantity, FurnitureName, Category, Price, SupplierName FROM CustomerOrder, CustomerOrderLine, Furniture WHERE CustomerOrder.CustomerOrderID = CustomerOrderLine.CustomerOrderID AND Furniture.FurnitureID = CustomerOrderLine.FurnitureID AND CustomerOrder.CustomerOrderID = " . $_REQUEST['CustomerOrderID'];

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                echo "<table border='1' cellpadding='10'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Quantity</th>";
                echo "<th>Name</th>";
                echo "<th>Category</th>";
                echo "<th>Supplier</th>";
                echo "<th>Price</th>";
                echo "</tr>";
                echo "</thead>";

                echo "<tbody>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" .$row['Quantity']. "</td>";
                    echo "<td>" .$row['FurnitureName']. "</td>";
                    echo "<td>" .$row['Category']. "</td>";
                    echo "<td>" .$row['SupplierName']. "</td>";
                    echo "<td>&pound;" .($row['Price'] * $row['Quantity']). "</td>";
                    echo "</tr>";

                    $totalPrices[] = $row['Price'] * $row['Quantity'];

                    $totalPrice += $row['Price'] * $row['Quantity'];
                }
                echo "<tr><td colspan='3'></td><td>Total</td><td>&pound;" .$totalPrice. "</td></tr>";
                echo "</tbody>";
                echo "</table>";
            }else{
                echo "<p>It doesn't seem like you have any orders. How about <a href='Order.php'>making one</a>?</p>";
            }
        ?>
    </body>
</html>