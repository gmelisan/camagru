<?php

/* simple PSR-4 autoloader */
spl_autoload_register(function($name) 
{   
    $DS = DIRECTORY_SEPARATOR;
    $basedir = "./Application";
    $prefix = "\Camagru";
    $parts = explode('\\', $name);
    $parts[0] = $basedir;
    $path = implode($DS, $parts) . ".php";
    if (file_exists($path)) {
        require $path;
    }
});

date_default_timezone_set("Europe/Moscow");
require_once "config/database.php";

try {
    $pdo = new PDO(
    $DB_DSN, $DB_USER, $DB_PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo "Can't connect to database (code " . $e->getCode() . ").";
    die;
}

session_start();

$frontController = new \Camagru\FrontController($pdo);
$frontController->output();
