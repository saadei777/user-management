<?php
session_start();
require 'autoload.php';
use App\Services\AuthService;

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authService = new AuthService();
    $result = $authService->loginFromDB($_POST['email'], $_POST['password']);
    if (str_contains($result, '✅')) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "❌ Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <p><?= $message ?></p>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <a href="register.php">No account? Register here</a>
</body>
</html>