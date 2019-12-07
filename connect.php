<?php
    $conn = mysqli_connect('localhost', 'root', '', 'Fakea');

    if(!$conn){
        die('Connection failed: ' . mysqli_connect_error());
    }
?>