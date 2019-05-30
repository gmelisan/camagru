<?php
spl_autoload_register(function($name) {
    $DS = DIRECTORY_SEPARATOR;
	$parts = explode('\\', $name);
    $parts[0] = ($parts[0] == 'Camagru' ? 'Model' : $parts[0]);
    $path = 'Application' . $DS . implode($DS, $parts) . '.php';
    if (file_exists($path))
        require $path;
});

date_default_timezone_set("Europe/Moscow");

require_once "config/database.php";
require_once "Application/Router.php";
require_once "Application/FrontController.php";

$pdo = new PDO(
    $DB_DSN, $DB_USER, $DB_PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

session_start();

$frontController = new FrontController($pdo);
$frontController->output();
