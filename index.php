<?php
session_start();
$action = $_GET['action'] ?? 'login/loginIndex';
list($controllerName, $method) = explode('/', $action);

switch ($controllerName) {
    case 'login':
        require_once 'controllers/LoginController.php';
        $controller = new \Controllers\LoginController();
        break;
    case 'chat':
        require_once 'controllers/ChatController.php';
        $controller = new \Controllers\ChatController();
        break;
    default:
        die("Page non trouvée");
}

if (method_exists($controller, $method)) {
    $controller->$method();
} else {
    die("Méthode non trouvée");
}