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

if ($auth->checkAuth()) {
    $page = $_GET['page'] ?? 'dashboard';

    switch ($page) {
        case 'acoes':
            include 'views/acoes.php';
            break;
        case 'dashboard':
        default:
            include 'views/dashboard.php';
            break;
    }
} else {
    include 'views/login.php';
}
