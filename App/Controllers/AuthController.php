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

            $errors = [];

            $Username = trim($_POST['Username']);  //trim para borrar espacio inicial y final
            $BirthDate = trim($_POST['Birthdate']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password= trim($_POST['ConfirmPassword']);
            
            //VERIFICACION DE DATOS

            if ((empty($Username)) || (!preg_match('/^[a-zA-Z0-9_]{0,10}$/', $Username))) {  //valida solo letras, numeros y guion bajo. tamaño maximo 10
                
                $errors['global'] = "Nombre usuario invalido";

            }
            if(empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))){ //verifica si es un mail valido

                $errors['global'] = "Mail Invalido";

            }

            $date_format = 'Y-m-d';
            $d = DateTime::createFromFormat($date_format, $BirthDate); //Crea un objeto DateTime, si no es posible devuelve False

            if((empty($BirthDate)) || (!$d || $d->format($date_format) !== $BirthDate)){ //Valida si existe $d o si es valido

                $errors['global'] = "Fecha de nacimiento invalida";

            }else{
                $userBirthDate = new DateTime($BirthDate); 

                $maxAgeDate = (new DateTime())->modify('-90 years'); //Edad Maxima 90 años
                $minAgeDate = (new DateTime())->modify('-16 years'); //Edad Minima 16 años

                if(($d > $minAgeDate) || ($d < $maxAgeDate)){ //verifica si esta en el rango de edad

                    $errors['global'] = "Rango de edad inadecuado";
                }
                
            }
            if (empty($password) || empty($confirm_password) || ($password !== $confirm_password)) { //corrobora si las 2 contraseñas son identicas

                $errors['global'] = "Contraseñas no coinciden";
                
            }else{

                $Check = VerificarContraseñaSegura($password); //si no es segura $check = false

                if ($Check == false){

                    $errors['global'] = "Contraseña no segura";
                }
            }

            if (empty($errors)){
                $hashed_password = password_hash($password,PASSWORD_DEFAULT);
                $Data = $this->userModel->createUser($Username,$BirthDate,$email,$hashed_password);

                if ($Data["Result"] == true){
                    
                    //CHECK VIA MAIL

                    return $Data["User"];

                }else{

                    $_SESSION['flash']['error'] = $Data["Error"];

                    return;

                }

            }else{
                 $_SESSION['flash']['error'] = $errors['global'];

                return;
            }

        }else {

            return;
        }

    }

    public function logIn(){

         if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_Login'])){

            $errors = [];

            

            $Username = trim($_POST['Username']);
            $password = trim($_POST['password']);
            
            if ((empty($Username))) {  //valida solo letras, numeros y guion bajo. tamaño minimo 5 maximo 20
            
                $errors['global'] = "Nombre usuario vacio";
            }  

            if (empty($password)){

                $errors['global'] = "contraseña vacia";
            }

            if (empty($errors)){

            $Data = $this->userModel->CheckUserlogin($Username,$password);
            
            if ($Data["Result"] == true){



                return $Data["User"];
            }else{
                
                $_SESSION['flash']['error'] = $Data["Error"];

                return;
            }

            }else{
                
                $_SESSION['flash']['error'] = $errors['global'];
                 
                return;
              
            }

  	  	 }else {
            return;
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
    //(?=.*[\W_]) Verifica si existe algun caracter especial
    //(?=.*\d) Verifica si hay algun numero
    //(?=.*[A-Z]) verifica si hay alguna letra mayuscula

    $regex = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,40}$/'; 

    if (!preg_match($regex, $Password)){
        
        return false;
    }

    return true;
}


?>