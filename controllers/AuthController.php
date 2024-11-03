<?php
require_once 'models/Database.php';

class AuthController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function checkAuth() {
        return isset($_SESSION['user_id']);
    }

    public function login($email, $password) {
        $pdo = $this->db->getConnection();

        if ($pdo) {
            try {
                // Consulta preparada para evitar SQL Injection
                $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && $user['password'] === $password) {
                    // Credenciais válidas
                    $_SESSION['user_id'] = $user['id'];
                    header("Location: index.php");
                    exit();
                } else {
                    // Credenciais inválidas
                    return "Email ou senha incorretos.";
                }
            } catch (PDOException $err) {
                return "Erro ao acessar o banco de dados: " . $err->getMessage();
            }
        }
        return "Erro ao conectar ao banco de dados.";
    }
}
?>
