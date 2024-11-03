<?php
    // Configurações do banco de dados
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'jf_db');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    // URL base do projeto
    define('BASE_URL', 'http://localhost/jf-wallet');

    // Incluindo classes
    require_once 'models/Database.php';
    require_once 'models/UserModel.php';
    require_once 'controllers/AuthController.php';
    require_once 'controllers/EntryController.php';

?>
