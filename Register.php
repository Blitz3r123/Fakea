<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="css/RegisterStyle.css">
    </head>
    <body>
        <h1>Register</h1>

        <h2 class="error-message">
            <?php 
                if(isset($_SESSION['RegisterError'])){
                    echo $_SESSION['RegisterError'];
                    unset($_SESSION['RegisterError']);
                }
                ?>
        </h2>

        <form action="RegisterScript.php" method="post">
            
            <p class="back-button">
                <a href="index.php"><ion-icon name="arrow-round-back"></ion-icon></a>
            </p>

            <div class="input-container">
                <p>
                    <span class="input-title">Name:</span>
                    <input required type="text" name="CustomerName" placeholder="Your whole name" autofocus>
                </p>

                <p>
                    <span class="input-title">Email:</span>
                    <input required type="email" name="EmailAddress" placeholder="Your whole email address">
                </p>

                <p>
                    <span class="input-title">Telephone Number:</span>
                    <input required type="tel" name="TelephoneNumber" placeholder="Your whole number" pattern="[0-9]{11}">
                </p>

                <p>
                    <span class="input-title">Username:</span>
                    <input required type="text" name="Username" placeholder="What do you want your username to be?">
                </p>

                <p>
                    <span class="input-title">Password:</span>
                    <input required type="password" name="Password" placeholder="What do you want your password to be?">
                </p>
            </div>
            
            <p>
                <input class="register-button" required type="submit" value="Register">
            </p>

        </form>

        <!-- Ionicons Import -->
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    </body>
</html>