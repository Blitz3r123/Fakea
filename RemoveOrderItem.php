<?php
    session_start();
    require_once('connect.php');

    $CustomerOrderLineID = $_REQUEST['CustomerOrderLineID'];

    $CustomerOrderID = $_REQUEST['CustomerOrderID'];

    $sql = "DELETE FROM CustomerOrderLine WHERE CustomerOrderLineID = " . $CustomerOrderLineID;

    if(mysqli_query($conn, $sql)){
        echo "<script>window.location = 'Order.php?CustomerOrderID=" .$CustomerOrderID. "';</script>";
    }else{
        echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';
    }

?>