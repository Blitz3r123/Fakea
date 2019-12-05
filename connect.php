<?php
    $conn = mysqli_connect('localhost:3310', 'root', '', 'fakea');

    if(!$conn){
        die('Connection failed: ' . mysqli_connect_error());
    }
?>