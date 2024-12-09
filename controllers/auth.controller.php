<?php
    require_once('database/Connection.php');
    require_once('models/UserModel.php');

    $conn = Connection::getConnection();
    $mensagem_erro = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validação de login
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $query = $conn->prepare('SELECT * FROM users WHERE email = :email');
        $query->bindParam(':email', $email);
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_CLASS, 'UserModel');

        if(sizeof($users) === 0) {
            $mensagem_erro = "Usuário ou senha inválidos.";
        } else {
            if ($users[0]->getEmail() === $email && $users[0]->getSenha() === $senha) {
                $_SESSION['usuario_logado'] = true;
                header('Location: ' . BASE_URL . '/transacao/listar');
                exit;
            } else {
                $mensagem_erro = "Usuário ou senha inválidos.";
            }
        }

    }

    if($acao === 'logout'){
        session_destroy();
    }


    require_once('views.php');
