<?php
namespace App\Controllers; 

require __DIR__ . '/../Core/Database.php'; 
require __DIR__ . '/../Models/UserAuth.php';

use App\Core\Database;


abstract class BaseController{

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

   
}

?>