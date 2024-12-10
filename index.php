<?php
    session_start(); 

    error_reporting(E_ALL ^ E_DEPRECATED);

    // Exemplo de rota: /transacao/listar
    // Quebramos a rota em um array
    $rota = explode('/', substr($_SERVER['REQUEST_URI'], 1));

    // $rota[1] é o recurso | $rota[2] é a ação 
    // Página padrão: "transacao" para recurso vazio
    $recurso = empty($rota[1]) ? 'transacao' : $rota[1];
    $acao = empty($rota[2]) ? 'listar' : $rota[2];

    // Verifica se o usuário está logado
    // Assumimos que a variável $_SESSION['usuario_logado'] é definida no login
    if (!isset($_SESSION['usuario_logado'])) {
        // Se não estiver logado, redireciona para o controlador de autenticação
        $recurso = 'auth';
        $acao = 'login'; // Define uma ação padrão para o login
    }

    // Cria o caminho dinâmico para o controlador
    $controlador = "controllers/{$recurso}.controller.php";

    // Verifica se o controlador existe
    if (file_exists($controlador)) {
        require($controlador);

        // Verifica se a função da ação existe no controlador
        if (function_exists($acao)) {
            $acao(); // Chama a ação dinamicamente
        } else {
            // Redireciona para uma página de erro caso a ação não exista
            require("controllers/404.controller.php");
        }
    } else {
        // Redireciona para uma página de erro caso o controlador não exista
        require("controllers/404.controller.php");
    }
