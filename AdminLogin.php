<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="css/LoginStyle.css">
    </head>
    <body>
        <div class="column">
            <h1>Admin Login</h1> 

            <form action="AdminLoginScript.php" method="post">
            
                <p class="error-message">
                    <?php
                        if(isset($_SESSION['LoginError'])){
                            echo $_SESSION['LoginError'];
                            unset($_SESSION['LoginError']);
                        }
                    ?>
                </p>

                <p class="back-button">
                    <a href="index.php"><ion-icon name="arrow-round-back"></ion-icon></a>
                </p>

                <div class="login-input">
                    <p>
                        <span class="input-title">Username:</span> <input type="text" placeholder="Username" name="username" autofocus>
                    </p>

                    <p>
                    <span class="input-title">Password:</span> <input type="password" placeholder="Password" name="password">
                    </p>
                </div>

                <p>
                    <input class="login-button" type="submit" value="Login">
                </p>

            </form>
        </div>

        <!-- Ionicons Import -->
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    </body>
</html>