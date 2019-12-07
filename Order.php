<?php
    session_start();
    require_once('connect.php');

    // Check if this an existing order
    if( isset($_REQUEST['CustomerOrderID']) ){
        $CustomerOrderID = $_REQUEST['CustomerOrderID'];
    }else{
        $CustomerOrderID = '';
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Make an Order</title>
        <link rel="stylesheet" href="css/OrderStyle.css">
    </head>
    <body>
        <h1 id="page-title">Make an Order:</h1>
        
        <div class="action-buttons">
            <a class="action-button" href="CustomerIndex.php">
                <ion-icon name="arrow-round-back"></ion-icon>
            </a>
            <a class="action-button" id="cancel-button" href="DeleteOrder.php?CustomerOrderID=<?php echo $CustomerOrderID; ?>">
                <ion-icon name="close"></ion-icon>
            </a>
        </div>

        <form action="OrderScript.php?CustomerOrderID=<?php echo $CustomerOrderID; ?>" method="post">
        <table>
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
                // Check order exists
                if( isset($_REQUEST['CustomerOrderID']) ){

                    /*
                        Display all the furniture in the current order if there are any

                        We check for an order by posting CustomerOrderID to this page from OrderScript.php
                    */

                    $sql = "SELECT * FROM CustomerOrderLine, Furniture WHERE CustomerOrderLine.FurnitureID = Furniture.FurnitureID AND CustomerOrderID = " . $_REQUEST['CustomerOrderID'];

                    $result = mysqli_query($conn, $sql);

                    $total = 0;
                    // Check to see if any data has come back
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            // Calculate total cost of all furniture in the order
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
                        // Check if the $total variable has a value then display it
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
                                /* 
                                    Display all furniture into a drop down list
                                */
                                $sql = "SELECT * FROM Furniture";

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

        <!-- Ionicons Import -->
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    </body>
</html>