<?php
@session_start();


  require_once '../funciones/conexion.php';
  require_once '../controladores/c_ejercicio.php';
  $db= conexion_BD();
  $idEjercicio = $_GET['id'];
  $result = c_ejercicio::devolverDatosEjercicio($idEjercicio);
  
 if(isset($_SESSION['userID']) && $_SESSION['userType'] == 'Administrador' && $_SESSION['connected'] == true){
  

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
          <a class="navbar-brand" href="v_administrador.php"><img src="../images/navbar-footer/tiburonlogo.png" style="margin-top:-10px;"></img></a>
        </div>

<!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 3px;">
          <ul class="nav navbar-nav">
            <li><a href="../vistas/v_administrador.php">Principal</a></li>
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


</nav>

</header>


    <div class="container">
      <!-- --------------------------- ----------------EDITAR TODALA VISTA DENTRO DE ESTE DIV ----------------------- -->

      <div class="row">
        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

          <p style="font-size: -webkit-xxx-large; ">Datos Ejercicio: </p>
        </div>

      <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">
        <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">ID Ejercicio: <?php echo $result['idEjercicio']; ?></p></label>
          <br />
        </div>

		<div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Nombre Ejercicio: <?php echo $result['nombre']; ?></p></label>
          <br />
        </div>

        <div>
          <br />
          <label for="descripcion" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Descripci&oacuten:</p></label><br />
          <textarea name="descripcion" readonly rows="7" cols="44"><?php echo $result['descripcion']; ?></textarea><br />
        </div>

        <?php
            if($result['tipo'] == 'cardio'){
        ?>

        <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: <?php echo $result['tiempo']; ?></label>
          </div>

          <?php
              }else if($result['tipo'] == 'resistencia'){
          ?>

		      <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: <?php echo $result['tiempo']; ?></label>
          </div>

          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: <?php echo $result['peso']; ?></label>
          </div>

          <?php
              } else{
          ?>
          
          <div>
           <br />
              <label for="repeticiones"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Repeticiones: <?php echo $result['repeticiones']; ?></label>
          </div>

          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: <?php echo $result['peso']; ?></label>
          </div>

          <?php  
              }
          ?>
          
          <!-- DIV IMAGEN-->
          <div style="margin-top:30px;">
              <label for="imgEjer"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Imagen: </label>
             <img alt="imgEjer" src="../images/ejercicios/<?php echo $result['URLImagen']; ?>" style="max-width: 100%;max-height: 100%;">
          </div>

        </div>


        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_modificarEjercicio.php?id=<?php echo $result['idEjercicio'];?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonModificar"><span class="glyphicon glyphicon-floppy-open" style="margin-right: 5px;"></span>Modificar Ejercicio</button></a>
        </div>

        <form action="../controladores/c_ejercicio.php?var=1#" method="post">
          <input type="hidden" name="idEjercicio" value="<?php echo $result['idEjercicio'];?>"></input>
          <input type="hidden" name="submit" value="true"></input>
          <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
            <button type="submit" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-floppy-remove" style="margin-right: 5px;"></span>Eliminar Ejericio</button>
          </div>
        </form>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_gestionarEjercicios.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button></a>
        </div>


		<?php
  } else if(isset($_SESSION['userID']) && $_SESSION['userType'] == 'Entrenador' && $_SESSION['connected'] == true){
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

      <div class="row">
        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

          <p style="font-size: -webkit-xxx-large; ">Datos Ejercicio: </p>
        </div>

      <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">
        <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">ID Ejercicio: <?php echo $result['idEjercicio']; ?></p></label>
          <br />
        </div>

		<div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Nombre Ejercicio: <?php echo $result['nombre']; ?></p></label>
          <br />
        </div>

        <div>
          <br />
          <label for="descripcion" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Descripci&oacuten:</p></label><br />
          <textarea name="descripcion" readonly rows="7" cols="44"><?php echo $result['descripcion']; ?></textarea><br />
        </div>

		   <?php
            if($result['tipo'] == 'cardio'){
        ?>

        <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: <?php echo $result['tiempo']; ?></label>
          </div>

          <?php
              }else if($result['tipo'] == 'resistencia'){
          ?>

          <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: <?php echo $result['tiempo']; ?></label>
          </div>

          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: <?php echo $result['peso']; ?></label>
          </div>

          <?php
              } else{
          ?>
          
          <div>
           <br />
              <label for="repeticiones"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Repeticiones: <?php echo $result['repeticiones']; ?></label>
          </div>

          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: <?php echo $result['peso']; ?></label>
          </div>

          <?php  
              }
          ?>


          <!-- DIV IMAGEN-->
         <div style="margin-top:30px;">
              <label for="imgEjer"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Imagen: </label>
             <img alt="imgEjer" src="../images/ejercicios/<?php echo $result['URLImagen']; ?>" style="max-width: 100%;max-height: 100%;">
          </div>


      </div>


        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_modificarEjercicio.php?id=<?php echo $result['idEjercicio'];?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonModificar"><span class="glyphicon glyphicon-floppy-open" style="margin-right: 5px;"></span>Modificar Ejercicio</button></a>
        </div>

        <form action="../controladores/c_ejercicio.php?var=1#" method="post">
          <input type="hidden" name="idEjercicio" value="<?php echo $result['idEjercicio'];?>"></input>
          <input type="hidden" name="submit" value="true"></input>
          <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
            <button type="submit" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-floppy-remove" style="margin-right: 5px;"></span>Eliminar Ejericio</button>
          </div>
        </form>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_gestionarEjercicios.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button></a>
        </div>
<?php
  } else if(isset($_SESSION['userID']) && $_SESSION['userType'] == 'Deportista' && $_SESSION['connected'] == true){
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
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

    </header>


    <div class="container">
      <!-- --------------------------- ----------------EDITAR TODALA VISTA DENTRO DE ESTE DIV ----------------------- -->

      <div class="row">
        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

          <p style="font-size: -webkit-xxx-large; ">Datos Ejercicio: </p>
        </div>

      <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">
        <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">ID Ejercicio: <?php echo $result['idEjercicio']; ?></p></label>
          <br />
        </div>

		<div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Nombre Ejercicio: <?php echo $result['nombre']; ?></p></label>
          <br />
        </div>

        <div>
          <br />
          <label for="descripcion" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Descripci&oacuten:</p></label><br />
          <textarea name="descripcion" readonly rows="7" cols="44"><?php echo $result['descripcion']; ?></textarea><br />
        </div>

		     <?php
            if($result['tipo'] == 'cardio'){
        ?>

        <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: <?php echo $result['tiempo']; ?></label>
          </div>

          <?php
              }else if($result['tipo'] == 'resistencia'){
          ?>

          <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: <?php echo $result['tiempo']; ?></label>
          </div>

          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: <?php echo $result['peso']; ?></label>
          </div>

          <?php
              } else{
          ?>
          
          <div>
           <br />
              <label for="repeticiones"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Repeticiones: <?php echo $result['repeticiones']; ?></label>
          </div>

          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: <?php echo $result['peso']; ?></label>
          </div>

          <?php  
              }
          ?>


          <!-- DIV IMAGEN-->
          <div style="margin-top:30px;">
              <label for="imgEjer"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Imagen: </label>
             <img alt="imgEjer" src="../images/ejercicios/<?php echo $result['URLImagen']; ?>" style="max-width: 100%;max-height: 100%;">
          </div>


      </div>


        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_modificarEjercicio.php?id=<?php echo $result['idEjercicio'];?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonModificar"><span class="glyphicon glyphicon-floppy-open" style="margin-right: 5px;"></span>Modificar Ejercicio</button></a>
        </div>

        <form action="../controladores/c_ejercicio.php?var=1#" method="post">
          <input type="hidden" name="idEjercicio" value="<?php echo $result['idEjercicio'];?>"></input>
          <input type="hidden" name="submit" value="true"></input>
          <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
            <button type="submit" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-floppy-remove" style="margin-right: 5px;"></span>Eliminar Ejericio</button>
          </div>
        </form>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_gestionarEjercicios.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button></a>
        </div>

      </div>


    </div>

  </body>

</html>

<?php
  }
  else
  {
    // Usuario que no se ha logueado
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/v_principal.php'";
    echo "</script>";
    exit();
  }

?>
