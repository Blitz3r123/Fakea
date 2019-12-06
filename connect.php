<?php
    $conn = mysqli_connect('localhost', 'root', '', 'fakea');

    if(!$conn){
        die('Connection failed: ' . mysqli_connect_error());
    }
?>