<?php
/**
 * Configuração da Landing Page
 * IMPORTANTE: Use as MESMAS credenciais do sistema /print3d/
 */

// ===== EDITE AQUI - MESMAS CREDENCIAIS DO SISTEMA =====
define('DB_HOST', 'localhost');
define('DB_NAME', 'seu_banco_aqui');      // Mesmo nome usado no /print3d/
define('DB_USER', 'seu_usuario_aqui');
define('DB_PASS', 'sua_senha_aqui');
define('DB_CHARSET', 'utf8mb4');
// =========================================================

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_general_ci",
            ]);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    return $pdo;
}
