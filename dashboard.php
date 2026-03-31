<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome! You are logged in as <?= $_SESSION['email'] ?></h2>
    <a href="logout.php">Logout</a>
</body>
</html>