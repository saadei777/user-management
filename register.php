<?php
session_start();
require 'autoload.php';
use App\Services\AuthService;

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authService = new AuthService();
    $message = $authService->register(
        $_POST['name'],
        $_POST['email'],
        $_POST['password'],
        'Regular User'
    );
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Register</h2>
    <p><?= $message ?></p>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>