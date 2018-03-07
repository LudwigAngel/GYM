<?php
@session_start();

  if(isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true){
  $var = $_GET['id'];

require_once '../funciones/conexion.php';
require_once '../funciones/sesion.php';
require_once '../controladores/c_sesion.php';
require_once '../controladores/c_usuario.php';

  $bd= conexion_BD();
  $result = c_sesion::getSesionesActividad($var);

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
            <!--EN LA IMAGEN METER A HREF A LA PAG INICIAL DEL ADMIN.-->
            <a class="navbar-brand" href="#"><img src="../images/navbar-footer/tiburonlogo.png" style="margin-top:-10px;"></img></a>
          </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 3px;">
            <ul class="nav navbar-nav">
						<li class="current"><a href="../vistas/v_deportista.php">Principal</a></li>
						<li><a href="../vistas/v_gestionarActividades.php">Actividades</a></li>
						<li><a href="../vistas/v_misActividades.php">Mis actividades</a></li>
						<li><a href="../vistas/v_misTablas.php">Mis tablas</a></li>
            <li><a href="../vistas/v_miHistorial.php">Mi Historial</a></li>
						<li><a href="../vistas/v_verPerfil.php" id="botonPerfil"><span class="glyphicon glyphicon-user" aria-hidden="true" style="margin-right: 5px;"></span>Ver Perfil</a></li>
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

      <p style="font-size: -webkit-xxx-large;" id="actividades">Sesiones</p>

      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

         <thead> <!-- CABECERA DE LA TABLA -->

            <tr>
              <th>ID Sesion</th> <th>Fecha</th> <th>Hora</th> <th>Monitor</th> <th>Plazas disponibles</th><!-- EN LA TABLA SOLO QUEREMOS QUE EN LA CABECERA SALGA EL NOMBRE DE ACTIVIDAD
				 LOS BOTONES SE PUEDEN METES A MAYORES SIN TENER CABECERA PROPIA  -->

            </tr>

          </thead>

          <tbody>


            <?php

              foreach ($result as $reg) {//LA VARIABLE $REG GUARDA LOS REGISTROS DE LA CONSULTA REALIZADA

            ?>




		<tr>
			<td><?php echo $reg['idSesion']; ?></td>
			<td><?php echo $reg['fecha']; ?></td>
			<td><?php echo $reg['hora']; ?></td>
      <td><?php $aux = c_usuario::devolverUsuario($reg['Usuario_DNI']); echo $aux['nombre']; ?></td>
      <td><?php echo $reg['nPlazasActual']; ?></td>
      <td>
				<a href="v_reservarSesion.php?idSesion=<?php echo $reg['idSesion'] ;?>" style="text-decoration: none;"><button id="botonGuardarCambios" type="button" class="btn btn-default2" >Reservar Sesion</button></a>
			</td>

			<td>
				<a href="v_cancelarReservaSesion.php?idSesion=<?php echo $reg['idSesion'] ;?>" style="text-decoration: none;"><button id="botonEliminar" type="button" class="btn btn-default2" >Cancelar reserva Sesion</button></a>
			</td>

		</tr>
</body>
</html>
			  <?php

  }

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
      if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador')
      {

      echo "<script>";
      echo "alert('No tienes permisos para entrar en esta pagina');";
      echo "window.location = '../vistas/v_entrenador.php'";
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
