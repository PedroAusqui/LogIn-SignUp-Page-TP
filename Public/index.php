<?php

require_once __DIR__ . '/../App/Controllers/AuthController.php';

require __DIR__ . '/../App/Core/config.php';



use App\Controllers\AuthController;


session_start();

$request = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);

$request = trim($request, '/');

$method = $_SERVER['REQUEST_METHOD'];

$authController = new AuthController(); 

switch ($request) {
    case '':
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        } else {
            header('Location: ' . BASE_URL . 'main');
            exit;
        }
        break;
    case 'login' : 
        
        if (!empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'main');
            exit;
        }

        require __DIR__ . '/../App/Views/Login.php';  
        
        if ($method === 'POST' && isset($_POST['submit_Login'])) {
            $usuario = $authController->logIn();

            if ($usuario){
                
                header('Location: ' . BASE_URL . 'Main'); 

            }else{
                header('Location: ' . BASE_URL . 'login');

            }
            
        }

        break;

    case 'signup':
        if (!empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'main');
            exit;
        }
        
        require __DIR__ . '/../App/Views/SignUp.php';

        if ($method === 'POST' && isset($_POST['submit_SignUp'])) {
            $usuario = $authController->signUp();

            if ($usuario){
                
                header('Location: ' . BASE_URL . 'Main');
                
            }else{
                header('Location: ' . BASE_URL . 'signup');
            }
            
            
        };

        break;

    case 'Main':

        if (empty($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }

        require __DIR__ . '/../App/Views/Main.php';
   
        break;
    case 'Compras':
        
        if (empty($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }

        require __DIR__ . '/../App/Views/compras.php';

        break;
    case 'Almacen':

        if (empty($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }

        require __DIR__ . '/../App/Views/almacen.php';

        break;
    case 'Consumo':

        if (empty($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }

        require __DIR__ . '/../App/Views/consumo.php';

        break;
    case 'Proveedores':

        if (empty($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }

        require __DIR__ . '/../App/Views/proveedores.php';

        break;
    case 'Pedidos':

        if (empty($_SESSION['user'])) { header('Location: ' . BASE_URL . 'login'); exit; }

        require __DIR__ . '/../App/Views/pedidos.php';

        break;
    case 'Config':

       if (empty($_SESSION['user']) || ($_SESSION['user']['nivel'] ?? '') !== 'administrador') {

            http_response_code(403);
            echo "403 - Prohibido";
            exit;

       }
        require __DIR__ . '/../App/Views/configuracion.php';

        break;

    case 'LogOut':

        if (!empty($_SESSION['user'])){ 

            $authController->logOut();

            header('Location: ' . BASE_URL . 'login'); 
            exit;
        }

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}


?>