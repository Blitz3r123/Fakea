<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
       <h1>Login</h1> 
        <p>
            <a href="index.php">Back</a>
        </p>

        <form action="LoginScript.php" method="post">
        
            <p>
                Username: <input type="text" placeholder="Username" name="username" autofocus>
            </p>

            <p>
                Password: <input type="password" placeholder="Password" name="password">
            </p>

            <p>
                <input type="submit" value="Login">
            </p>

        </form>
    </body>
</html>