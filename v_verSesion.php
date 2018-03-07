<?php
@session_start();

  require_once '../funciones/conexion.php';
  require_once '../controladores/c_sesion.php';
  require_once '../controladores/c_usuario.php';
  $db= conexion_BD();
  $id = $_GET['idSesion'];

  $result = c_sesion::devolverDatosSesion($id);
  $users = c_sesion::devolverInscritos($id);

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

      </nav>

    </header>


    <div class="container">
      <!-- --------------------------- ----------------EDITAR TODALA VISTA DENTRO DE ESTE DIV ----------------------- -->

      <div class="row">
        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

          <p style="font-size: -webkit-xxx-large; ">Datos Sesi&oacuten: </p>
        </div>

      <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">
        <div>
          <br />
          <label for="sesion" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">ID Sesion: <?php echo $result['idSesion']; ?></p></label>
          <br />
        </div>

	      <div>
          <br />
          <label for="fecha" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Fecha: <?php echo date("d-m-Y",strtotime($result['fecha']));?></p></label>
          <br />
        </div>

        <div>
          <br />
          <label for="hora" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Hora: <?php echo date("H:i",strtotime($result['hora'])); ?></p></label>
          <br />
        </div>

		<div>
          <br />
          <label for="plazas" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Numero de Plazas: <?php echo $result['nPlazasMax']; ?></p></label>
        </div>

		<div>
          <br />
          <label for="plazas" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Numero de Plazas actual: <?php echo $result['nPlazasActual']; ?></p></label>
        </div>

        <div>
          <br />
          <label for="usuario" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Entrenador: <?php $aux=c_usuario::devolverUsuario($result['Usuario_DNI']); echo($aux['nombre']); echo(", "); echo ($aux['apellidos']); ?></p></label><br />
        </div>

		<div>
          <br />
          <label for="actividad" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">ID Actividad: <?php echo $result['Actividad_idActividad']; ?></p></label><br />
        </div>
      </div>


        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_modificarSesion.php?id=<?php echo $result['idSesion'];?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonModificar"><span class="glyphicon glyphicon-floppy-open" style="margin-right: 5px;"></span>Modificar Sesi&oacuten </button></a>
        </div>

        <form action="../controladores/c_sesion.php?var=1#" method="post">
          <input type="hidden" name="idSesion" value="<?php echo $result['idSesion'];?>"></input>
          <input type="hidden" name="submit" value="true"></input>
          <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
            <button type="submit" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-floppy-remove" style="margin-right: 5px;"></span>Eliminar sesion</button>
          </div>
        </form>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_gestionarActividades.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button></a>
        </div>

        <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <table class="table table-striped">

           <thead> <!-- CABECERA DE LA TABLA -->

              <tr>
                <th><h2>Nombre Deportistas Inscritos</h2></th><!-- EN LA TABLA SOLO QUEREMOS QUE EN LA CABECERA SALGA EL NOMBRE DE ACTIVIDAD
                                          LOS BOTONES SE PUEDEN METES A MAYORES SIN TENER CABECERA PROPIA  -->
              </tr>

            </thead>

            <tbody>
              <?php

                foreach ($users as $reg2) {//LA VARIABLE $REG GUARDA LOS REGISTROS DE LA CONSULTA REALIZADA
              ?>
              <tr>

                <td><?php $aux=c_usuario::devolverUsuario($reg2["Usuario_DNI"]); echo($aux["nombre"]); echo " ,"; echo($aux["apellidos"]);?></td>
              </tr>

             <?php
                } ?>
            </tbody>

          </table>
        </div>

	<?php
  }
  else
  {

    if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista')
    {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/v_deportista.php'";
    echo "</script>";
    exit();

    } else{
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

              </nav>

            </header>


            <div class="container">
              <!-- --------------------------- ----------------EDITAR TODALA VISTA DENTRO DE ESTE DIV ----------------------- -->

              <div class="row">
                <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">

                  <p style="font-size: -webkit-xxx-large; ">Datos Sesi&oacuten: </p>
                </div>

              <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">
                <div>
                  <br />
                  <label for="sesion" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">ID Sesion: <?php echo $result['idSesion']; ?></p></label>
                  <br />
                </div>

        	      <div>
                  <br />
                  <label for="fecha" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Fecha: <?php echo date("d-m-Y",strtotime($result['fecha']));?></p></label>
                  <br />
                </div>

                <div>
                  <br />
                  <label for="hora" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Hora: <?php echo date("H:i",strtotime($result['hora'])); ?></p></label>
                  <br />
                </div>

        		<div>
                  <br />
                  <label for="plazas" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Numero de Plazas: <?php echo $result['nPlazasMax']; ?></p></label>
                </div>

        		<div>
                  <br />
                  <label for="plazas" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Numero de Plazas actual: <?php echo $result['nPlazasActual']; ?></p></label>
                </div>

                <div>
                  <br />
                  <label for="usuario" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Entrenador: <?php $aux=c_usuario::devolverUsuario($result['Usuario_DNI']); echo($aux['nombre']); echo(", "); echo ($aux['apellidos']); ?></p></label><br />
                </div>

        		<div>
                  <br />
                  <label for="actividad" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">ID Actividad: <?php echo $result['Actividad_idActividad']; ?></p></label><br />
                </div>
              </div>

                <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                  <a href="v_gestionarActividades.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button></a>
                </div>

                <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <table class="table table-striped">

                   <thead> <!-- CABECERA DE LA TABLA -->

                      <tr>
                        <th><h2>Nombre Deportistas Inscritos</h2></th><!-- EN LA TABLA SOLO QUEREMOS QUE EN LA CABECERA SALGA EL NOMBRE DE ACTIVIDAD
                                                  LOS BOTONES SE PUEDEN METES A MAYORES SIN TENER CABECERA PROPIA  -->
                      </tr>

                    </thead>

                    <tbody>
                      <?php

                        foreach ($users as $reg2) {//LA VARIABLE $REG GUARDA LOS REGISTROS DE LA CONSULTA REALIZADA
                      ?>
                      <tr>

                        <td><?php $aux=c_usuario::devolverUsuario($reg2["Usuario_DNI"]); echo($aux["nombre"]); echo " ,"; echo($aux["apellidos"]);?></td>
                      </tr>

                     <?php
                        } ?>
                    </tbody>

                  </table>
                </div>
<?php
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
