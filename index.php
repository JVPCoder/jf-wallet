<?php
session_start();
require 'config/config.php';

$auth = new AuthController();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Tenta fazer o login
    $errorMessage = $auth->login($username, $password);

    // Exibe mensagem de erro, se houver
    if ($errorMessage) {
        echo "<p style= 'color: red;'>$errorMessage</p>";
    }
}

// Verifica se o usuário está autenticado
if ($auth->checkAuth()) {
    include 'views/dashboard.php';
} else {
    include 'views/login.php';
}
?>
