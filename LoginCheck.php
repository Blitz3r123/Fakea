<?php
    if(!isset($_SESSION['CustomerID'])){
        echo "<script>window.location = 'Login.php';</script>";
    }
?>