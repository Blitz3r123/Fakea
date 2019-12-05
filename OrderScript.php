<?php
    session_start();

    require_once('connect.php');

    $today = date("Y-m-d");
    
    /*
        1. Find if there already exists an order
            1.1. If order already exists then list items of order already
            1.2. If order doesn't exist, then no need to list items since none exist
        2. Add items to the order by referencing the order id.
    */

    $furnitureName = $_POST['furnitureName'];
    $quantity = $_POST['quantity'];

    $CustomerID = $_SESSION['CustomerID'];

    if( isset($_REQUEST['CustomerOrderID']) && $_REQUEST['CustomerOrderID'] == '' ){
        // Order doesn't exist
        
        $sql = "INSERT INTO CustomerOrder(CustomerID, Date) VALUES(" .$CustomerID. ", " .$today. ")";

        if(mysqli_query($conn, $sql)){
            $CustomerOrderID = mysqli_insert_id($conn);

            $sql = "INSERT INTO CustomerOrderLine(CustomerOrderID, FurnitureID, Quantity) VALUES(" .$CustomerOrderID. ", " .$furnitureName. ", " .$quantity. ")";

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
        $CustomerOrderID = $_REQUEST['CustomerOrderID'];
        $sql = "INSERT INTO CustomerOrderLine(CustomerOrderID, FurnitureID, Quantity) VALUES(" .$CustomerOrderID. ", " .$furnitureName. ", " .$quantity. ")";

        if(mysqli_query($conn, $sql)){
            echo "<script>window.location = 'Order.php?CustomerOrderID=" .$CustomerOrderID. "';</script>";
        }else{
            echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';
        }
    }
?>