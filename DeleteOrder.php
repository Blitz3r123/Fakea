<?php
    require_once('connect.php');

    $CustomerOrderID = $_REQUEST['CustomerOrderID'];

    $sql = "DELETE FROM CustomerOrderLine WHERE CustomerOrderID = " . $CustomerOrderID;

    if(mysqli_query($conn, $sql)){
        $sql = "DELETE FROM CustomerOrder WHERE CustomerOrderID = " .$CustomerOrderID;

        if(mysqli_query($conn, $sql)){
            echo "<script>window.location = 'ViewOrders.php';</script>";
        }else{
            echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';    
        }

    }else{
        echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';
    }
?>