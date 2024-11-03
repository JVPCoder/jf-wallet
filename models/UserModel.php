<?php

require_once "models/Database.php";
class UserModel extends Database {
    private $pdo;

    public function __construct() {
        $this->pdo = $this->getConnection();
    }

    public function usersFetch() {
        $stm = $this->pdo->query("SELECT * FROM users");
        if ($stm->rowCount() > 0) {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function fetchById($id) {
        $stm = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    // Novo método para buscar usuário pelo email
    public function fetchByEmail($email) {
        $stm = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stm->execute([$email]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
}
