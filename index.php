<?php
require 'autoload.php';

use App\Models\Admin;
use App\Models\RegularUser;
use App\Services\AuthService;

$authService = new AuthService();

echo "<h2>Version 1 - OOP (no DB)</h2>";
$admin = new Admin("Alice", "alice@example.com", "admin123");
$user = new RegularUser("Bob", "bob@example.com", "user123");
echo $authService->authenticate($admin, "alice@example.com", "admin123") . "<br>";
echo $authService->authenticate($user, "bob@example.com", "user123") . "<br>";
echo $admin->logout() . "<br>";

echo "<h2>Version 2 - With Database</h2>";
echo $authService->register("Alice", "alice@example.com", "admin123", "Admin") . "<br>";
echo $authService->register("Bob", "bob@example.com", "user123", "Regular User") . "<br>";
echo $authService->loginFromDB("alice@example.com", "admin123") . "<br>";
echo $authService->loginFromDB("bob@example.com", "user123") . "<br>";
