<?php
namespace App\Models;

use PDO;

class LoginModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=gorille', 'root', '');
    }

    public function createUser($pseudo, $email, $password, $color = null) {
        $stmt = $this->db->prepare("INSERT INTO users (pseudo, email, password, color) VALUES (?, ?, ?, ?)");
        $stmt->execute([$pseudo, $email, $password, $color]);
    }

    public function existUser($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public function retrievePassword($email, $password) {
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$password, $email]);
    }
}
?>