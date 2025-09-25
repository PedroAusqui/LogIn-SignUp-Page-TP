<?php

require __DIR__ . '/../App/Core/config.php';

session_start();

$request = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);

$request = trim($request, '/');


switch ($request) {
    case '':
    case 'login': //MUY SIMPLIFICADO AGREGAR CHECKS

        require __DIR__ . '/../App/Views/Login.php';   
        break;

    case 'signup': //MUY SIMPLIFICADO AGREGAR CHECKS

        require __DIR__ . '/../App/Views/SignUp.php';
        break;

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}

?>