<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {

    private $host = 'localhost';
    private $dbname = '_baseDepV2_';
    private $pdo;

    public function __construct() {
        if ($this->pdo === null) {
            try {
                 $this->pdo = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4","root","");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                
                die("Error de conexión a la base de datos: " . $e->getMessage()); //muestra en pantalla el error
                //cambiarlo para guardar en un log de errores

            }
        }
    }


    public function getConnection() {
        return $this->pdo;
    }
}


?>