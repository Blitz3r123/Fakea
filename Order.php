<?php
    session_start();
    require_once('connect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Make an Order</title>
    </head>
    <body>
        <h1>Make an Order:</h1>
        <a href="CustomerIndex.php">Back</a>
        <?php 
            if( isset($_REQUEST['CustomerOrderID']) ){
                $CustomerOrderID = $_REQUEST['CustomerOrderID'];
            }else{
                $CustomerOrderID = '';
            } 
        ?>
        <form action="OrderScript.php?CustomerOrderID=<?php echo $CustomerOrderID; ?>" method="post">
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if( isset($_REQUEST['CustomerOrderID']) ){
                    $sql = "SELECT * FROM CustomerOrderLine, Furniture WHERE CustomerOrderLine.FurnitureID = Furniture.FurnitureID AND CustomerOrderID = " . $_REQUEST['CustomerOrderID'];

                    $result = mysqli_query($conn, $sql);

                    $total = 0;

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            
                            $total += $row['Price'] * $row['Quantity'];

                            echo '
                                <tr>
                                    <td>' .$row['FurnitureName']. '</td>
                                    <td>' .$row['Quantity']. '</td>
                                    <td>&pound;' .$row['Price']. '</td>
                                    <td>&pound;' .$row['Price'] * $row['Quantity']. '</td>
                                    <td><a href="RemoveOrderItem.php?CustomerOrderID=' .$CustomerOrderID. '&CustomerOrderLineID=' .$row['CustomerOrderLineID']. '">Remove</a></td>
                                </tr>
                            ';
                        }
                    }
                }
            ?>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="1">Total:</td>
                    <td><?php 
                        if(isset($total)){
                            echo '&pound;' . $total;
                        }else{
                            echo 0;
                        }
                    ?></td>
                    <td><a href="DeleteOrder.php?CustomerOrderID=<?php echo $CustomerOrderID; ?>">Cancel Order</a></td>
                </tr>
                <tr>
                    <td>
                        <select name="furnitureName" required>
                            <option value="" selected disabled>Select Furniture</option>
                            <?php
                                $sql = "SELECT * FROM FURNITURE";

                                $result = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        echo '<option value="' .$row['FurnitureID']. '">' .$row['FurnitureName']. '</option>';
                                    }
                                }else{
                                    echo '<option>No Furniture Found</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="quantity" required>
                    </td>
                    <td><input type="submit" value="Add"></td>
                </tr>
            </tbody>
        </table>
        </form>
    </body>
</html>