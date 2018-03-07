<?php
@session_start();
 
    if(isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true){
		 $var = $_GET['idSesion'];
 
		require_once '../funciones/conexion.php';
		require_once '../funciones/sesion.php';
		require_once '../controladores/c_inscripcion.php';
		require_once '../controladores/c_sesion.php';
		
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
        <li><a href="../vistas/v_misActividades.php"">Mis actividades</a></li>
        <li><a href="../vistas/v_misTablas.php"">Mis tablas</a></li>
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
		<p style="font-size: -webkit-xxx-large;" id="actividades">Confirmaci&oacuten</p>

		<form id="contact_form" action="../controladores/c_sesion.php?var=4#" method="post" enctype="multipart/form-data" style="margin-right:5px;">

			<div>
			<br />
			<label for="sesion" style="margin-right:5px; font-weight:normal; font-size: x-large;">ID Sesion:</label><br />
			<input  value="<?php echo $var ?>" name="sesion" type="text" size="30" required="" readonly="readonly"/><br />
			</div>

			<div>
			<label for="dniU" style="margin-right:5px; font-weight:normal; font-size: x-large;">DNI:</label><br />
			<input  value="<?php echo $_SESSION['userID'] ?>" name="dniU" type="text" size="30" required="" readonly="readonly"/><br />
			</div>

			<div class="row">
			<br />
			
			<form class="col-xs-5  col-sm-3  col-md-3  col-lg-3" method="post" action="">
			<div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
			<a href="v_misActividades.php"><button type="submit" id="submit" name="submit" class="btn btn-default3" id="botonGuardarCambios" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Confirmar</button></a>
			</div>
			
		</form>

				<div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
				<a href="v_misActividades.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
				</div>

	</div>

      </form>

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
