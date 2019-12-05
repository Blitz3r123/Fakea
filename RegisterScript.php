<?php

    session_start();

    if(isset($_SESSION['RegisterError'])){
        unset($_SESSION['RegisterError']);
    }

    require_once('connect.php');

    $CustomerName = $_REQUEST['CustomerName'];
    $EmailAddress = $_REQUEST['EmailAddress'];
    $TelephoneNumber = $_REQUEST['TelephoneNumber'];
    $Username = $_REQUEST['Username'];
    $Password = $_REQUEST['Password'];

    function checkExist($field, $value, $conn){
        $sql = "SELECT * FROM Customer WHERE $field = '$value'";

        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                return true;
            }else{
                return false;
            }
        }else{
            echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';
        }
    }

    if(  
        checkExist('CustomerName', $CustomerName, $conn) && 
        checkExist('EmailAddress', $EmailAddress, $conn) && 
        checkExist('TelephoneNumber', $TelephoneNumber, $conn) 
    ){
        $_SESSION['RegisterError'] = 'Looks like you already exist.';
    }else if(checkExist('Username', $Username, $conn)){
        $_SESSION['RegisterError'] .= ' That username already exists.';
    }else{

        if(isset($_SESSION['RegisterError'])){
            unset($_SESSION['RegisterError']);
        }

        $sql = "INSERT INTO Customer(CustomerName, EmailAddress, TelephoneNumber, Username, Password) VALUES('" .$CustomerName. "', '" .$EmailAddress. "', '" .$TelephoneNumber. "', '" .$Username. "', '" .$Password. "')";

        if(mysqli_query($conn, $sql)){
            echo "<script>window.location = 'index.php';</script>";
        }else{
            echo 'line: ' . __LINE__ . ':<br>' .mysqli_error($conn). '<br>';
        }
    }    

    echo "<script>window.location = 'Register.php';</script>";
?>