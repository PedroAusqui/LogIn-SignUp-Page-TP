<?php

namespace App\Models;

use \PDO;

class UserAuth{

    private $db;

    public function __construct($db_connection){
        $this->db = $db_connection;
    }

    public function createUser($Username,$BirthDate,$email,$hashed_password){

        $query = "INSERT INTO usuarios (nombre_usuario, Email, password ,nivel, FechaNacimiento, fecha_ingreso) 
                VALUES (:username, :email , :password_hash ,:nivel , :birthdate, :fecha_ingreso)";

        try {
            $stmt = $this->db->prepare($query);

            $success = $stmt->execute([
                ':username'      => $Username,
                ':email'         => $email,
                ':password_hash' => $hashed_password ,
                ':nivel' => "empleado",
                ':birthdate'     => $BirthDate,
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

                return $nuevoUsuario; //retorna el array con los datos de usuario
            
            }else{

                return false; 

            }

            
        } catch (\PDOException $e) {

            return false;
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

                //NO ENCONTRADO
                return false;
            }

            $hash_almacenado = $usuario['password'];

            if (password_verify($hashed_password, $hash_almacenado)){

                unset($usuario['password']);
                $_SESSION['user'] = $usuario;

                return $usuario;
            }else{
                
                //NO COINCIDE
                return false;
            }

        } catch (\PDOException $e) {
            error_log("Error de inicio de sesión: " . $e->getMessage());

            echo  $e->getMessage();

            return false;
        }
    }

}

?>