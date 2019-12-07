<?php
    session_start();
    require_once('connect.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Admin WHERE AdminUsername = '" .$username. "' AND AdminPassword = '" .$password. "'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        $_SESSION['AdminID'] = $row['AdminID'];

        echo "<script>window.location = 'CustomerIndex.php';</script>";
    }

?>