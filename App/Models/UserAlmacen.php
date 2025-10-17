<?php

namespace App\Models;

use \PDO;


class UserAlmacen{

    public function __construct($db_connection){
        $this->db = $db_connection;
    }

    public function  getInventory() {
        
        //AGREGAR LOGICA DE RETORNAR INVENTARIO

    }

}

?>