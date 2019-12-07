<?php
    session_start();
    require_once('connect.php');
    $CustomerID = $_SESSION['CustomerID'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Order</title>
        <link rel="stylesheet" href="ViewOrdersStyle.css">
    </head>
    <body>
        <h1>Your orders:</h1>
        <a href="CustomerIndex.php">Back</a>
        <?php
            $CustomerOrderIDs = [];

            $sql = "SELECT * FROM CustomerOrder";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
                echo "<table border='1' cellpadding='10'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Furniture</th>";
                echo "<th>Total</th>";
                echo "<th>Actions</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                while($row = mysqli_fetch_array($result)){
                    $CustomerOrderIDs[] = $row['CustomerOrderID'];
                }

                foreach($CustomerOrderIDs as $key=>$value){
                    echo "<tr>";
                    echo "<td>" .($key + 1). "</td>";

                    $query = "SELECT * FROM CustomerOrderLine, Furniture WHERE CustomerOrderLine.FurnitureID = Furniture.FurnitureID AND CustomerOrderID = $value";

                    $orderResult = mysqli_query($conn, $query);

                    if(mysqli_num_rows($orderResult) > 0){
                        echo "<td><a href='ViewOrder.php?CustomerOrderID=" .$value. "'>";
                        
                        $total = 0;
                        
                        while($orderRow = mysqli_fetch_array($orderResult)){
                            echo $orderRow['FurnitureName'] . " x " .$orderRow['Quantity']. "<br>";
                            $total += $orderRow['Price'] * $orderRow['Quantity'];
                        }
                        echo "</a></td>";

                        echo '<td>' .money_format('&pound;%n', $total). '</td>';

                        echo '<td>
                                <a href="DeleteOrder.php?CustomerOrderID=' .$value. '">Delete</a>
                                <br>
                                <a href="Order.php?CustomerOrderID=' .$value. '">Edit</a>
                            </td>';
                    }else{
                        echo "<td>No Furniture Found</td>";
                    }


                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            }else{
                echo '
                    <p>You don\'t have any orders</p>
                ';
            }

        ?>
    </body>
</html>