<?php

namespace App\Models;

use \PDO;

class UserAuth{

    private $db;

    public function __construct($db_connection){
        $this->db = $db_connection;
    }

    public function createUser($Username,$BirthDate,$email,$hashed_password){

        $query = "INSERT INTO usuarios (nombre_usuario, Email, password ,nivel, FechaNacimiento,Activa, fecha_ingreso) 
                VALUES (:username, :email , :password_hash ,:nivel , :birthdate,:Activa, :fecha_ingreso)";

        try {
            $stmt = $this->db->prepare($query);

            $success = $stmt->execute([
                ':username'      => $Username,
                ':email'         => $email,
                ':password_hash' => $hashed_password ,
                ':nivel' => "empleado",
                ':birthdate'     => $BirthDate,
                ':Activa'     => 1,
                ':fecha_ingreso'     => date('Y-m-d H:i:s')
            ]);

            $userId = $this->db->lastInsertId();

            if ($success){

                $nuevoUsuario = [
                    'UserId'  => $userId,
                    'nombre_usuario'  => $Username,
                    'Email'           => $email,
                    'nivel'           => "empleado",
                    'FechaNacimiento' => $BirthDate,
                    'fecha_ingreso'   => date('Y-m-d H:i:s')
                ];

                //PREVIAMENTE VERIFICAR ACTIVO

                $_SESSION['user'] = $nuevoUsuario;

                return [
                    "Result" => true,
                    "User" => $nuevoUsuario, //retorna el array con los datos de usuario
                    "Error" => []
                ];
            
            }else{

                return [
                    "Result" => false,
                    "User" => [],
                    "Error" => []
                ];

            }

            
        } catch (\PDOException $e) {

            $errors = [];

             if ($e->getCode() === '23000') {
                $msg = $e->getMessage();

                $errors['global'] = 'El usuario o  el correo ya estan en uso';

                return [
                    "Result" => false,
                    "User" => [], 
                    "Error" => $errors['global']
                ];
            }
            return [
                    "Result" => false,
                    "User" => [], 
                    "Error" => 'Error de base de datos.'
            ]; 
        }

    }

    public function CheckUserlogin($Username, $hashed_password){

        $query = "SELECT * FROM usuarios WHERE nombre_usuario = :username";

        try {

            $stmt = $this->db->prepare($query);

            $success = $stmt->execute([
                ':username'      => $Username
            ]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario){

                return [
                    "Result" => false,
                    "User" => [], 
                    "Error" => 'Credenciales incorrectas'
                ];
            }

            $hash_almacenado = $usuario['password'];
            $Activo = $usuario['Activa'];

            if ($Activo == 0){
                return [
                    "Result" => false,
                    "User" => [], 
                    "Error" =>'Cuenta Inactiva'
                ]; 
            }

            if (password_verify($hashed_password, $hash_almacenado)){ //AGREGAR CHECK DE ACTIVO

                unset($usuario['password']);
                $_SESSION['user'] = $usuario;

                return [
                    "Result" => true,
                    "User" => $usuario, 
                ];

            }else{
                
                return [
                    "Result" => false,
                    "User" => [], 
                    "Error" =>'Credenciales incorrectas'
                ]; 
            }

        } catch (\PDOException $e) {
            
            return [
                    "Result" => false,
                    "User" => [], 
                    "Error" =>'Ocurrio un error inesperado'
            ]; 
        }
    }

}

?>