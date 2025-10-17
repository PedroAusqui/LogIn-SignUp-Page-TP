<?php 
   
   //require_once("class/config.php");
   
   if(isset($_SESSION["user"])){

    //require_once("class/configuracionModulo.php");

    //$config= new Configuracion();

    //$datos=$config->get_configuracion();

?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Configuracion</title>
   <?php require __DIR__ . '/Includes/head.php';?>
</head>

  <body>
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Configuracion"; ?>   
  <!-- LLAMO A MENU PRINCIPAL-->
  <?php require __DIR__ . '/Includes/menu_principal.php';?>
  <!--Area trabajo fija -->
  <div class="d-flex align-items-stretch<">
  <!--LLAMO A MENU LATERAL-->
  <div class="d-flex">  
    <?php 
      if(isset($_SESSION["user"]["nivel"])){     
        if($_SESSION["user"]["nivel"] == "administrador")
          { require __DIR__ . '/Includes/menu_lateral.php';}
        else {  require __DIR__ . '/Includes/menu_lateral_empleado.php';}
      }
    ?>
  </div>

 <!-- ACA CONTENIDO -->
 <div class="page-content">
        
<div class="page-header"> <!-- panel usuario --> 
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h4">Configuracion</h1>
      </div>
</div><!--fin page-header-->

  <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid">
 <div class="row"> <!--diseño cuadrilla-->
                
      <div class="col-lg-12">
                <div class="block margin-bottom-sm"> <!--le da el color de fondo -->
                  <div class="title"><strong>Datos de Empresa</strong></div>
                 
      <div class="table-responsive"> 
                    <table class="table" id="myTable">
                     <!--OPCIONES TABLA -->
              <thead>
                  <tr>
                    <th>CUIT</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Nombre gerente</th>
                    <th>DNI gerente</th>
                    <th>Correo gerente</th>
                    <th>Acciones</th>
                  </tr>
              </thead>

               <tbody>
                    <?php for($i=0;$i<sizeof($datos);$i++){?>
                  <tr>
                    <td><?php echo $datos[$i]["cuit_empresa"];?></td>
                    <td><?php echo $datos[$i]["nombre_empresa"];?></td>
                    <td><?php echo $datos[$i]["direccion_empresa"];?></td>
                    <td><?php echo $datos[$i]["telefono_empresa"];?></td>
                    <td><?php echo $datos[$i]["correo_empresa"];?></td>
                    <td><?php echo $datos[$i]["nombre_gerente"];?></td>
                    <td><?php echo $datos[$i]["dni_gerente"];?></td> 
                    <td><?php echo $datos[$i]["correo_gerente"];?></td>

                    <!-- BOTON EDITAR -->
                 <td>
                  <a class="btn btn-primary" href="<?php echo Conectar::ruta();?>editar_configuracion.php?id_configuracion=<?php echo $datos[$i]["cod_configuracion"];?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a> 
                 </td>
                  
                  </tr>
                  <?php }?>
                </tbody>
                    </table>

    </div> <!--table-responsive -->
    </div>
    </div> <!--class="col-lg-8" -->

  </section>
  </div> <!--fin container-fluid -->
  </div> <!--fin row-->

</div>

 <!-- ACA FOOTER -->
    <?php require __DIR__ . '/Includes/footer.php';?>

    
  </body>
</html>

<?php 
} else {header('Location: ' . BASE_URL . 'login'); }
?>
