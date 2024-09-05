
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="losty.css">
</head>
<body>
    <div class="login-container">
        <form action="aut.php" method="post">
            <h2>Login</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
