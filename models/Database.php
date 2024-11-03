<?php

class Database {
    public function getConnection() {
        try {
            // Usando as constantes definidas em config.php
            $pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASS);
            // Configurações adicionais do PDO, se necessário
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $err) {
            // Exibe o erro de conexão, pode ser ajustado para um log em produção
            var_dump($err);
            exit; // Encerrar o script em caso de erro
        }
    }
}
?>
