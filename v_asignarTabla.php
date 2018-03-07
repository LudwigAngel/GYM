<?php
  require_once '../funciones/conexion.php';
  require_once '../controladores/c_usuario.php';
  require_once '../controladores/c_tabla.php';
  @session_start();
  $bd= conexion_BD();
  $idTabla = $_GET['id'];
  $result = c_tabla::getDeportistasAsignados($idTabla);
  $result2 = c_usuario::getDeportistasGeneral();
  if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador')
    { 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GYM-APP</title>


    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar2.css" rel="stylesheet">
    <link href="../css/botonesGestionar.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

  </head>


  <body>

    <header>
      <!-- DEBE IR BARRA DE NAVEGACION -->
      <nav class="navbar navbar-default1">
      <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="../images/navbar-footer/tiburonlogo.png" style="margin-top:-10px;"></img></a>
        </div>

<!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 3px;">
          <ul class="nav navbar-nav">
            <li><a href="../vistas/v_entrenador.php">Principal</a></li>
            <li><a href="../vistas/v_gestionarActividades.php">Actividades</a></li>
            <li><a href="../vistas/v_gestionarEjercicios.php">Gestión de ejercicios</a></li>
            <li><a href="../vistas/v_gestionarTablas.php">Gestión de tablas</a></li>
            <li><a href="../vistas/v_verPerfil.php">Mi perfil</a></li>
          </ul>


    <ul class="nav navbar-nav navbar-right">
      <div class="form-group">
        <button id="modalButton" type="button" class="btn btn-default1" data-toggle="modal" data-target=".bs-example-modal-sm" style="margin-left: 10px;">Cerrar Sesi&oacuten</button>
          <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content" id="modalLogin">
                <div class="modal-header">
                  <h4 style="text-align: center; color:white;" class="modal-title">Cerrar Sesi&oacuten</h4>
                </div>
                <div class="text-center">
                  <p style="text-align: center; margin-top: 20px;"><img src="../images/navbar-footer/tiburon2.png"></img></p>
                    <button type="submit" class="btn btn-default1" id="botonModificar" style="margin-bottom: 10px;" value="Confirmar" onclick = "location='../funciones/cerrar.php'">Cerrar Sesi&oacuten</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </ul>


</nav>

</header>


    <div class="container">
      <!-- --------------------------- ----------------EDITAR TODALA VISTA DENTRO DE ESTE DIV ----------------------- -->

       <div class="row" style="margin-top: 20px; margin-bottom: 10px;">

        <!-- COMIENZO DIV TABLA -->
        <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <h3>Deportistas Asignados</h3>
          <table class="table table-striped">
           
           <thead>

              <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
              </tr>

            </thead>

            <tbody>
              <?php 
              if($result!=null){
                foreach ($result as $usuario) {
               ?>
              <tr>
                <td><?php echo $usuario['DNI']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['apellidos']; ?></td>
                
              </tr>
              <?php
                }
              }
              ?>

            </tbody>

          </table>
      </div>

      
      <div id="container-formulario" class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
        <form action="../controladores/c_tabla.php?var=3#" method="POST" style="margin:10px;">
          
          <h3>Asignar Deportistas</h3>
          <div class="form-group">
                  <select name="DNI">
                  <?php
                  if($result2!=null){
                    foreach ($result2 as $usuario2) {
                  ?>
                    <option value="<?php echo $usuario2['DNI'];?>"><?php echo $usuario2['nombre'];?>, <?php echo $usuario2['apellidos'];?></option>
                  <?php
                    }
                  }
                  ?>
                  </select>
          </div> 
          <input type="hidden" name="idTabla" value="<?php echo $idTabla;?>">
          <p style="text-align:center">
          <button type="submit" name="submit" class="btn btn-default2" id="botonGuardarCambios" style="margin-right: 10px;">
            <span class="glyphicon glyphicon-ok">
          </button>
        </form>
      </div> 

      
      <div id="container-formulario" class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
        <form action="../controladores/c_tabla.php?var=4#" method="POST" style="margin:10px;">
          
          <h3>Eliminar Deportista Asignado</h3>
          <div class="form-group">
                  <select name="DNI">
                  <?php
                  if($result!=null){
                    foreach ($result as $usuario3) {
                  ?>
                    <option value="<?php echo $usuario3['DNI'];?>"><?php echo $usuario3['nombre'];?>, <?php echo $usuario3['apellidos'];?></option>
                  <?php
                    }
                  }
                  ?>
                  </select>
          </div> 
          <input type="hidden" name="idTabla" value="<?php echo $idTabla;?>">
          <p style="text-align:center">
          <button type="submit" name="submit" class="btn btn-default2" id="botonEliminar" style="margin-right: 10px;">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </form>
      </div> 

      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="visibility: hidden;"></div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <a href="v_gestionarTablas.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button>
      </div>

    </div>
    </div>


  </body>

</html>

<?php
  }
  else 
  {

    if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador')
    {   
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/v_administrador.php'";
    echo "</script>";
    exit(); 

    } else{
      if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista')
      {   

      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta pagina');";
      echo "window.location = '../vistas/v_deportista.php'";
      echo "</script>";
      exit(); 

    } else {
    // Usuario que no se ha logueado
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/v_principal.php'";
    echo "</script>";
    exit();
  }
  }
}
?>
