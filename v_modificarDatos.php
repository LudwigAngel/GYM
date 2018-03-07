<?php
  @session_start();

  if(isset($_SESSION['userID'])  &&  $_SESSION['connected'])
  {       // Lo dejas entrar a la pagina

require_once '../funciones/conexion.php';
  require_once '../controladores/c_usuario.php';
  $db= conexion_BD();
  $result = c_usuario::devolverUsuario($_SESSION['userID']);
  }
?>

<script type="text/javascript">
function valida(f) {  //Valida que le numero de plazas actuales sea menor o igual qe las plazas disponibles
  var ok = true;
  var msg = "";

  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
  if(!(emailRegex.test(f.elements["actualizaremail"].value)))
  {
    msg += "La dirección de correo electrónico no parece válida.";
    ok = false;
  }

  if(ok == false)
    alert(msg);
  return ok;
}
</script>


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
	<?php
	if($_SESSION['userType'] == 'Administrador') {

	?>
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
              <li class="current"><a href="../vistas/v_administrador.php">Principal</a></li>
						<li><a href="../vistas/v_gestionarUsuarios.php">Gestión de usuarios</a></li>
						<li><a href="../vistas/v_gestionarActividades.php">Gestión de actividades</a></li>
						<li><a href="../vistas/v_gestionarEjercicios.php">Gestión de ejercicios</a></li>
						<li><a href="../vistas/v_verPerfil.php">Ver Perfil</a></li>

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
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

      </nav>

      </header>


    <div class="container">
      <!-- --------------------------- ----------------EDITAR TODALA VISTA DENTRO DE ESTE DIV ----------------------- -->

      <p style="font-size: -webkit-xxx-large; ">Modificar Perfil de Usuario</p>


       <form id="contact_form" action="../controladores/c_usuario.php?var=5#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="margin-right:5px;">

        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

    <div>
          <br />
          <label for="DNI" style="margin-right:5px; font-weight:normal; font-size: x-large;">DNI: </label>
          <input  value="<?php echo $result['DNI']; ?>"  name="actualizardni" type="text" size="30" required="" readonly="readonly"/>
        </div>

        <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal; font-size: x-large;">Nombre: </label>
          <input  value="<?php echo $result['nombre']; ?>"  name="actualizarnombre" type="text" size="30" required=""/>
        </div>

    <div>
          <br />
          <label for="apellidos" style="margin-right:5px; font-weight:normal; font-size: x-large;">Apellidos: </label>
          <input type="text" name="actualizarapellidos" value="<?php echo $result['apellidos']; ?>" required=""></input>
        </div>

        <div>
          <br />
          <label for="email" style="margin-right:5px; font-weight:normal; font-size: x-large;">Email: </label>
          <input type="text" name="actualizaremail" id="actualizaremail" value="<?php echo $result['email']; ?>" required=""></input>
        </div>

        <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Contrase&ntildea: </label>
          <input  value="<?php echo $result['password']; ?>" name="actualizarpass" type="password" size="30" required=""/>
        </div>

    <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Tipo de usuario: </label>
          <input  value="<?php echo $result['tipo']; ?>" name="actualizartipo" type="text" size="30" required="" readonly="readonly"/>
        </div>


        </div>

         <input type="hidden" name="actualizardni" value="<?php echo $result['DNI'];?>"></input>
         <input type="hidden" name="actualizartipoD" value="<?php echo $result['tipoDeportista'];?>"></input>
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <button type="submit" class="btn btn-default3" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black;""><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button>
        </div>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_verPerfil.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
        </div>



        </form>

       </div>
    </div>

  </body>

</html>
	  <?php
	} else if($_SESSION['userType'] == 'Entrenador') {
	?>

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

      <p style="font-size: -webkit-xxx-large; ">Modificar Perfil de Usuario</p>


       <form id="contact_form" action="../controladores/c_usuario.php?var=5#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="margin-right:5px;">

        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

    <div>
          <br />
          <label for="DNI" style="margin-right:5px; font-weight:normal; font-size: x-large;">DNI: </label>
          <input  value="<?php echo $result['DNI']; ?>"  name="actualizardni" type="text" size="30" required="" readonly="readonly"/>
        </div>

        <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal; font-size: x-large;">Nombre: </label>
          <input  value="<?php echo $result['nombre']; ?>"  name="actualizarnombre" type="text" size="30" required=""/>
        </div>

    <div>
          <br />
          <label for="apellidos" style="margin-right:5px; font-weight:normal; font-size: x-large;">Apellidos: </label>
          <input type="text" name="actualizarapellidos" value="<?php echo $result['apellidos']; ?>" required=""></input>
        </div>

        <div>
          <br />
          <label for="email" style="margin-right:5px; font-weight:normal; font-size: x-large;">Email: </label>
          <input type="text" name="actualizaremail" id="actualizaremail" value="<?php echo $result['email']; ?>" required=""></input>
        </div>

        <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Contrase&ntildea: </label>
          <input  value="<?php echo $result['password']; ?>" name="actualizarpass" type="password" size="30" required=""/>
        </div>

    <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Tipo de usuario: </label>
          <input  value="<?php echo $result['tipo']; ?>" name="actualizartipo" type="text" size="30" required="" readonly="readonly"/>
        </div>


        </div>

         <input type="hidden" name="actualizardni" value="<?php echo $result['DNI'];?>"></input>
         <input type="hidden" name="actualizartipoD" value="<?php echo $result['tipoDeportista'];?>"></input>
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <button type="submit" class="btn btn-default3" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black;""><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button>
        </div>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_verPerfil.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
        </div>



        </form>

       </div>
    </div>

  </body>

</html>





<?php }else if($_SESSION['userType'] == 'Deportista') {
	?>

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
            <li><a href="../vistas/v_deportista.php">Principal</a></li>
            <li><a href="../vistas/v_gestionarActividades.php">Actividades</a></li>
            <li><a href="../vistas/v_misActividades.php"">Mis actividades</a></li>
            <li><a href="../vistas/v_misTablas.php"">Mis tablas</a></li>
            <li><a href="../vistas/v_verPerfil.php" id="botonPerfil"><span class="glyphicon glyphicon-user" aria-hidden="true" style="margin-right: 5px;"></span>Ver Perfil</a></li>
          </ul>

<!-- Botón para cerrar sesión -->
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

      <p style="font-size: -webkit-xxx-large; ">Modificar Perfil de Usuario</p>


       <form id="contact_form" action="../controladores/c_usuario.php?var=5#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="margin-right:5px;">

        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

		<div>
          <br />
          <label for="dni" style="margin-right:5px; font-weight:normal; font-size: x-large;">DNI: </label>
          <input  value="<?php echo $result['DNI']; ?>"  name="actualizardni" type="text" size="30" required="" readonly="readonly"/>
        </div>

        <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal; font-size: x-large;">Nombre: </label>
          <input  value="<?php echo $result['nombre']; ?>"  name="actualizarnombre" type="text" size="30" required=""/>
        </div>

		<div>
          <br />
          <label for="apellidos" style="margin-right:5px; font-weight:normal; font-size: x-large;">Apellidos: </label>
          <input type="text" name="actualizarapellidos" value="<?php echo $result['apellidos']; ?>" required=""></input>
        </div>

        <div>
          <br />
          <label for="email" style="margin-right:5px; font-weight:normal; font-size: x-large;">Email: </label>
          <input type="text" id="actualizaremail" name="actualizaremail" value="<?php echo $result['email']; ?>" required=""></input>
        </div>

        <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Contrase&ntildea: </label>
          <input  value="<?php echo $result['password']; ?>" name="actualizarpass" type="password" size="30" required=""/>
        </div>

		<div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Tipo de usuario: </label>
          <input  value="<?php echo $result['tipo']; ?>" name="actualizartipo" type="text" size="30" required="" readonly="readonly"/>
        </div>

        <div>
          <br />
          <label for="tipoDeportista" style="margin-right:5px; font-weight:normal; font-size: x-large;">Tipo de deportista: </label>
          <input  value="<?php echo $result['tipoDeportista']; ?>" name="actualizartipoD" type="text" size="30" required="" readonly="readonly"/>
        </div>


        </div>

         <input type="hidden" name="actualizardni" value="<?php echo $result['DNI'];?>"></input>
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <button type="submit" class="btn btn-default3" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button>
        </div>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_verPerfil.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
        </div>



        </form>

       </div>
    </div>

  </body>

</html>
   <?php
  }
   else {
    // Usuario que no se ha logueado
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/v_principal.php'";
    echo "</script>";
    exit();
  }


?>
