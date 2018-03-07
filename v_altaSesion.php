<?php
  @session_start();
  require_once ('../controladores/c_sesion.php');
  require_once ('../controladores/c_usuario.php');
	$var = $_GET['id'];

  $result = c_usuario::getEntrenadores();

  if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador')
    {
?>
<script type="text/javascript">
function valida(f) {  //Valida que le numero de plazas actuales sea menor o igual qe las plazas disponibles
  var ok = true;
  var msg = "";
  if((f.elements["plazas"].value) < (f.elements["acplazas"].value))
  {
    msg += "El número de plazas actuales debe ser menor o igual al número de plazas asigado.";
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

  <?php
    require_once ('../controladores/c_sesion.php');
  ?>

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
      <p style="font-size: -webkit-xxx-large;" id="actividades">Nueva Sesión</p>

      <form id="contact_form" action="../controladores/c_sesion.php?var=0#" method="post" onsubmit="return valida(this)" enctype="multipart/form-data" style="margin-right:5px;">

        <div>
          <br />
          <label for="fecha" style="margin-right:5px; font-weight:normal; font-size: x-large;">Fecha:</label><br />
          <input  placeholder="Introduce la fecha" name="fecha" type="date" size="30" required=""/><br />
        </div>

        <div>
          <br />
          <label for="hora" style="margin-right:5px; font-weight:normal; font-size: x-large;">Hora:</label><br />
          <input  placeholder="Introduce la hora" name="hora" type="time" size="30" required=""/><br />
        </div>

        <div>
          <br />
          <label for="plazas" style="margin-right:5px; font-weight:normal; font-size: x-large;">Plazas:</label><br />
          <input  placeholder="Plazas" id="plazas" name="plazas" type="number" min="1" max="999" required=""/><br />
        </div>

		<div>
          <br />
          <label for="acplazas" style="margin-right:5px; font-weight:normal; font-size: x-large;">Plazas ACTUALES:</label><br />
          <input  placeholder="Plazas" id="acplazas" name="acplazas" type="number" min="0" max="999" required=""/><br />
        </div>

		<div>
      <label for="user" style="margin-right:5px; font-weight:normal; font-size: x-large;">Asignar Entrenador:</label><br />
      <div class="form-group">
              <select name="user">
              <?php
              if($result!=null){
                foreach ($result as $usuario) {
              ?>
                <option value="<?php echo $usuario['DNI'];?>"><?php echo $usuario['nombre'];?>, <?php echo $usuario['apellidos'];?></option>
              <?php
                }
              }
              ?>
              </select>
        </div>

        <div>
          <br />
          <label for="actividad" style="margin-right:5px; font-weight:normal; font-size: x-large;">ID Actividad:</label><br />
          <input type="text" name="actividad" value="<?php echo $var ?>" readonly="readonly"></input><br />
        </div>



        <div class="row">
          <br />
          <form class="col-xs-5  col-sm-3  col-md-3  col-lg-3" method="post" action="" onsubmit="return valida(this)">
             <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <a href="v_gestionarActividades.php"><button type="submit" id="submit" name="submit" class="btn btn-default3" id="botonGuardarCambios" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Publicar sesion</button></a>
             </div>
            <!--<p id="bot"><input type="submit" value="Crear Actividad" id="submit" name="submit" class="button" /></p>-->
          </form>

            <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <a href="v_gestionarActividades.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
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

    if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Entrenador')
    {
    echo "<script>";
    echo "alert('No tienes permisos para entrar en esta pagina');";
    echo "window.location = '../vistas/v_entrenador.php'";
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
