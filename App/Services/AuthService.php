<?php
namespace App\Services;

use App\Core\AuthInterface;
use App\Core\Database;

class AuthService {
    public function authenticate(AuthInterface $user, $email, $password) {
        return $user->login($email, $password);
    }

    public function register($name, $email, $password, $role) {
        $db = Database::getConnection();
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed, $role]);
        return "User '$name' registered in database!";
    }

    public function loginFromDB($email, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return "✅ {$user['role']} '{$user['name']}' logged in from database!";
        }
        return "❌ Invalid credentials.";
    }
}