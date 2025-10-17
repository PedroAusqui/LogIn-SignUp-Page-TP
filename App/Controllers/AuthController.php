<?php

namespace App\Controllers;

require_once __DIR__ . '/BaseController.php';  

use App\Models\UserAuth;
use App\Controllers\BaseController;
use \DateTime;

class AuthController extends BaseController {

    protected $UserModel;

    public function __construct() {

        parent::__construct();
        $this->userModel = new UserAuth($this->db);
    }

    public function signUp(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_SignUp'])){

            if ((!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) || ($_POST['csrf_token'] !== $_SESSION['csrf_token'])){
                //verifica si existe y coincide el token csrf
                unset($_SESSION['csrf_token']);
                return;
            }
            unset($_SESSION['csrf_token']);

            $error = [];

            $Username = trim($_POST['Username']);  //trim para borrar espacio inicial y final
            $BirthDate = trim($_POST['Birthdate']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password= trim($_POST['ConfirmPassword']);
            
            //VERIFICACION DE DATOS

            if ((empty($Username)) || (!preg_match('/^[a-zA-Z0-9_]{5,20}$/', $Username))) {  //valida solo letras, numeros y guion bajo. tamaño minimo 5 maximo 20
            
                $error[] = "Nombre usuario invalido o vacio";
            }  

            $date_format = 'Y-m-d';
            $d = DateTime::createFromFormat($date_format, $BirthDate); //Crea un objeto DateTime, si no es posible devuelve False

            if((empty($BirthDate)) || (!$d || $d->format($date_format) !== $BirthDate)){ //Valida si existe $d o si es valido

                $error[] = "Fecha de nacimiento invalida o vacia";

            }else{
                $userBirthDate = new DateTime($BirthDate); 

                $maxAgeDate = (new DateTime())->modify('-90 years'); //Edad Maxima 90 años
                $minAgeDate = (new DateTime())->modify('-16 years'); //Edad Minima 16 años

                if(($d > $minAgeDate) || ($d < $maxAgeDate)){ //verifica si esta en el rango de edad

                    $error[] = "Rango de edad inadecuado";
                }
                
            }

            if(empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))){ //verifica si es un mail valido

                $error[] = "Mail vacio o Invalido";

            }

            if (empty($password) || empty($confirm_password) || ($password !== $confirm_password)) { //corrobora si las 2 contraseñas son identicas

                $error[] = "Contraseña vacia o no coinciden";
                
            }else{

                $Check = VerificarContraseñaSegura($password); //si no es segura $check = false

                if (!$Check){

                    $error[] = "Contraseña no segura";
                }


            }

            if (count($error) === 0){

            $hashed_password = password_hash($password,PASSWORD_DEFAULT);
            $Usuario = $this->userModel->createUser($Username,$BirthDate,$email,$hashed_password);

            if ($Usuario){

                return $Usuario;
            }

            }else{

                //ERROR ENCONTRADO

            }

        }else {
            
            //ERROR NO ENCONTRO POST

        }

    }

    public function logIn(){

         if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_LogIn'])){

            if ((!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) || ($_POST['csrf_token'] !== $_SESSION['csrf_token'])){
                unset($_SESSION['csrf_token']);
                return;
            }
            unset($_SESSION['csrf_token']);

            $error = [];

            $Username = trim($_POST['Username']);
            $password = trim($_POST['password']);

            if ((empty($Username)) || (!preg_match('/^[a-zA-Z0-9_]{5,20}$/', $Username))) {  //valida solo letras, numeros y guion bajo. tamaño minimo 5 maximo 20
            
                $error[] = "Nombre usuario invalido o vacio";
            }  

            if (empty($password)){

                $error[] = "contraseña vacia";
            }

            if (count($error) === 0){

            $Usuario = $this->userModel->CheckUserlogin($Username,$password);
            
            if ($Usuario){
                return $Usuario;

            }

            }else{
                
                //ERROR ENCONTRADO
            }

  	  	 }else {
             //ERROR NO ENCONTRO POST
        }

    }

    public function logOut(){
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);

        session_destroy();
    }

    }

}


function VerificarContraseñaSegura($Password){
    
    //.{8,} Verifica longitud minima de 8
    //(?=.*[\W_]) Verifica si existe algun numero
    //(?=.*\d) Verifica si hay algun numero
    //(?=.*[A-Z]) verifica si hay alguna letra mayuscula

    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,40}$/'; 

    if (!preg_match($regex, $Password)){

        return false;
    }

    return true;
}


?>