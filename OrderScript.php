<?php
    session_start();

    require_once('connect.php');

    $today = date("Y-m-d");         // Format today's date
    
    /*
        1. Find if there already exists an order
            1.1. If order already exists then list items of order already
            1.2. If order doesn't exist, then no need to list items since none exist
        2. Add items to the order by referencing the order id.
    */

    // Get posted data values
    $furnitureName = $_POST['furnitureName'];
    $quantity = $_POST['quantity'];
    
    $CustomerID = $_SESSION['CustomerID'];      // Get CustomerID for current customer logged in

    if( isset($_REQUEST['CustomerOrderID']) && $_REQUEST['CustomerOrderID'] == '' ){
        // Order does NOT exist
        // Insert straight into CustomerOrder table since its first time making this order
        $sql = "INSERT INTO CustomerOrder(CustomerID, Date) VALUES(" .$CustomerID. ", '" .$today. "')";

        if(mysqli_query($conn, $sql)){
            // Get ID of row that was just inserted into CustomerOrder table
            $CustomerOrderID = mysqli_insert_id($conn);
            // Insert furniture and quantity into the CustomerOrderLine table using ID from above line
            $sql = "INSERT INTO CustomerOrderLine(CustomerOrderID, FurnitureID, Quantity) VALUES(" .$CustomerOrderID. ", " .$furnitureName. ", " .$quantity. ")";
            // Redirect back to order page to continue ordering
            if(mysqli_query($conn, $sql)){
                echo "<script>window.location = 'Order.php?CustomerOrderID=" .$CustomerOrderID. "';</script>";
            }else{
                echo 'line: ' . __LINE__ . ':<br>' .$sql. '<br>';
                echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';    
            }

        }else{
            echo 'line: ' . __LINE__ . ':<br>' .$sql. '<br>';
            echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';
        }

    }else{
        // Order exists
        // Get the existing CustomerOrderID
        $CustomerOrderID = $_REQUEST['CustomerOrderID'];
        // Insert furniture and quantity values using the existing CustomerOrderID
        $sql = "INSERT INTO CustomerOrderLine(CustomerOrderID, FurnitureID, Quantity) VALUES(" .$CustomerOrderID. ", " .$furnitureName. ", " .$quantity. ")";
        // Redirect back to order page to continue ordering
        if(mysqli_query($conn, $sql)){
            echo "<script>window.location = 'Order.php?CustomerOrderID=" .$CustomerOrderID. "';</script>";
        }else{
            echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';
        }
    }
?>