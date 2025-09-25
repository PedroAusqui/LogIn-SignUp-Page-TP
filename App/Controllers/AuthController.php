<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\User;


class AuthController {

    private $UserModel;

    public function __construct() {
        $database = new Database();
        $db_connection = $database->getConnection();
        $this->userModel = new User($db_connection);
    }

    public function signUp(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //SANITIZAR DATOS Y VALIDAR DATOS COMPROBAR SI SON CORRECTOS PARA SUBIR A LA BASE DE DATOS

            $Username = $_POST['Username']

            $BirthDate = $_POST['Birthdate']

            $email = $_POST['email']
            
            $hashed_password = password_hash($_POST['password'],PASSWORD_DEFAULT)

            $Confirm_hashed_password = password_hash($_POST['ConfirmPassword'],PASSWORD_DEFAULT)

            //------------------------------

            $this->userModel->create($Username,$BirthDate,$email,$hashed_password);

        }else {
            require __DIR__ . '/../../App/Views/SignUp.php';
        }

    }

    public function logIn(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //SANITIZAR DATOS Y COMPARAR PARA LOG IN

            $hashed_password = password_hash($_POST['´password'],PASSWORD_DEFAULT)

            $this->userModel->create($_POST['email'], $hashed_password);

        }else {
            require __DIR__ . '/../../App/Views/LogIn.php';
        }

    }


}

?>