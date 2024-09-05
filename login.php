<?php
session_start();
$valid_username = 'admin';
$vpassword = '123';
$hashpassword = password_hash($vpassword, PASSWORD_DEFAULT);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username =$_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)) {
        $error_message = "Username and password are required.";
    } else {
    
        if ($username === $valid_username && password_verify($password,$hashpassword )) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
       
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
