<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <form class="login" action="../../backend/login.php" method="post">
        <h2>NEXUS</h2>
        <p>Please log in</p>
        <input type="text" placeholder="Email" name="email"/>
        <input type="password" placeholder="Password" name="password"/>
        <input type="submit" value="Log In" name="submit"/>
        <div class="links">
            <a href="#">Forgot password</a>
            <a href="register.php">Register</a>
        </div>
    </form>
</body>
</html>