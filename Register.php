<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <p>
            <a href="index.php">Back</a>
        </p>

        <h2>
            <?php 
                if(isset($_SESSION['RegisterError'])){
                    echo $_SESSION['RegisterError'];
                }
            ?>
        </h2>

        <form action="RegisterScript.php" method="post">

            <p>
                Name:
                <input required type="text" name="CustomerName" placeholder="Your whole name">
            </p>

            <p>
                Email:
                <input required type="email" name="EmailAddress" placeholder="Your whole email address">
            </p>

            <p>
                Telephone Number:
                <input required type="tel" name="TelephoneNumber" placeholder="Your whole number" pattern="[0-9]{11}">
            </p>

            <p>
                Username:
                <input required type="text" name="Username" placeholder="What do you want your username to be?">
            </p>

            <p>
                Password:
                <input required type="password" name="Password" placeholder="What do you want your password to be?">
            </p>

            <p>
                <input required type="submit" value="Register">
            </p>

        </form>
    </body>
</html>