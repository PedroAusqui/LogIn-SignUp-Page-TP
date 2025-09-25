<?php

namespace App\Models;

class User{

    private $db

    public function __construct($db_connection){
        $this->db = $db_connection;
    }

    public function create($email, $hashed_password){

        $sql = "INSERTAR DATOS EN DB"
        

        // La llamada a `prepare` se hace sobre el objeto `$this->db`
        // que es la instancia de PDO que recibiste en el constructor.

        
    }

    public function CheckUser($email, $hashed_password){


    }

}

?>