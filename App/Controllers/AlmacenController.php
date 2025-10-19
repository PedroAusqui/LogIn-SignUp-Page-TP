<?php

namespace App\Controllers;

require_once __DIR__ . '/BaseController.php';  

use App\Controllers\BaseController;

class AlmacenController extends BaseController{

    public function __construct() {

        parent::__construct();
        $this->Almacen = new UserAlmacen($this->db);
    }

     public function getStock() {
        
        $Inventory = $this->Almacen->getInventory();
        
    }


}


?>