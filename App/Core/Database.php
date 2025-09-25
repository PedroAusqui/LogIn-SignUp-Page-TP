<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {

    private $host = 'localhost';
    private $dbname = 'tu_base_de_datos';    //CAMBIAR
    private $username = 'tu_usuario';               
    private $password = 'tu_contraseña'; 
    private $pdo;

    public function __construct() {
        if ($this->pdo === null) {
            try {
                $DataSourceName = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
                $this->pdo = new PDO($DataSourceName, $this->username, $this->password);
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