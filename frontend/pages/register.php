<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/register.css">
</head>
<body>
    <form class="register" action="../../backend/register.php" method="post">
        <h2>NEXUS</h2>
        <p>Please Register</p>
        <input type="text" placeholder="First Name" name="firstName"/>
        <input type="text" placeholder="Last Name" name="lastName" />
        <input type="text" placeholder="Email" name="email"/>
        <input type="password" placeholder="Password" name="password"/>
        <input type="submit" value="Create Account" name="submit"/>
        <div class="links">
            <a href="login.php">Log In</a>
        </div>
    </form>
</body>
</html>