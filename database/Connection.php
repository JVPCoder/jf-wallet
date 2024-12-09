<?php
    require_once('config/config.php');
    
    class Connection {
        private static $instancia;
        public static function getConnection() {
            try {
                if(!isset(self::$instancia)) {
                    self::$instancia = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASS);
                }

                return self::$instancia;
            } catch (Exception $ex) {
                var_dump($ex->getMessage());
            }
        }
    }
