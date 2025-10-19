 
<!-- MENU LATERAL PARA USUARIOS adminsitrador --> 

  <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="title">
            <h1 class="h5"><?php echo $_SESSION["user"]["nombre_usuario"] ?></h1>
            <p>   </p>
          </div>
        </div>
  <!-- Menu lateral-->
    <span class="heading">Inicio</span>
        <ul class="list-unstyled">
    <li <?php if($mi_pagina == 'Inicio'){ echo 'class="active"';}?>>
        <a href="<?php echo BASE_URL; ?>Main"> <i class="icon-home"></i>Inicio </a></li>
    <li <?php if($mi_pagina == 'Usuarios'){ echo 'class="active"';}?>>
        <a href="<?php echo BASE_URL; ?>Usuarios"> <i class="icon-user"></i>usuarios </a></li> 
    <li <?php if($mi_pagina == 'Inventario'){ echo 'class="active"';}?>>
        <a href="<?php echo BASE_URL; ?>Almacen"> <i class="icon-layers"></i>Inventario </a></li> 
    <li <?php if($mi_pagina == 'Compras'){ echo 'class="active"';}?>>
        <a href="<?php echo BASE_URL; ?>Compras"> <i class="icon-grid"></i>Compras </a></li> 
    <li <?php if($mi_pagina == 'Consumo'){ echo 'class="active"';}?>>
        <a href="<?php echo BASE_URL; ?>Consumo"> <i class="icon-dashboard"></i>Consumo </a></li> 
    <li><a href="#menuDesplegable" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Provedores </a>
      <ul id="menuDesplegable" class="collapse list-unstyled ">
        <li <?php if($mi_pagina == 'Proveedores'){ echo 'class="active"';}?>>
            <a href="<?php echo BASE_URL; ?>Proveedores"> <i class="icon-user-1"></i>Lista Proveedores </a></li>   
        <li <?php if($mi_pagina == 'Pedidos'){ echo 'class="active"';}?>>
            <a href="<?php echo BASE_URL; ?>Pedidos"> <i class="icon-list-1"></i>Pedidos</a></li>       
      </ul>  
    </li>
    <li <?php if($mi_pagina == 'Configuracion'){ echo 'class="active"';}?>>
        <a href="<?php echo BASE_URL; ?>Config"> <i class="icon-settings"></i>Configuraciòn </a></li> 

  </nav><!-- Fin menu lateral-->
     


