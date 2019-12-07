<?php
    session_start();
    require_once('connect.php');

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM Customer WHERE Username = '" .$username. "' AND Password = '" .$password. "'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        $_SESSION['CustomerID'] = $row['CustomerID'];

        echo "<script>window.location = 'CustomerIndex.php';</script>";
    }else{
        // Login Incorrect

        $_SESSION['LoginError'] = "Incorrect username or password";

        echo "<script>window.location = 'Login.php';</script>";
    }

?>