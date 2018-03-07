<?php
    require_once('../controladores/c_tabla.php');
    require_once('../controladores/c_ejercicio.php');
    @session_start();
    $db= conexion_BD();
    $resultado =c_ejercicio::devolverDatosEjercicios();
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


      <p style="font-size: -webkit-xxx-large;" id="actividades">Publicar Tabla</p>



      <form id="contact_form" action="../controladores/c_tabla.php?var=0#" method="post" enctype="multipart/form-data" style="margin-right:5px;">

       <div class="row" >
       <div class="btn-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div>
          <label for="idTabla" style="margin-right:5px; font-weight:normal; font-size: x-large;">Id Tabla:</label><br />
          <input  placeholder="Introduce el id de la tabla" name="idTabla" type="text" size="30" required=""/><br />
        </div>

        <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal; font-size: x-large;">Nombre tabla:</label><br />
          <input  placeholder="Introduce el nombre de la Tabla" name="nombre" type="text" size="30" required=""/><br />
        </div>

		    <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Tipo Tabla:</label>
          <select id="tipo" name="tipo" required="">
            <option value="General"> General </option>
            <option value="PEF"> PEF </option>
          </select>
        </div>



        <div>
          <br />
          <label for="instrucciones" style="margin-right:5px; font-weight:normal; font-size: x-large;">Instrucciones:</label><br />
          <textarea name="instrucciones" rows="7" cols="44" required=""></textarea><br />
        </div>
        </div>

      <div>
		    <label style="margin-right:5px; font-weight:normal; font-size: x-large;">Lista de ejercicios:</label><br />
          <br />

      <div class="btn-group col-xs-12 col-sm-6 col-md-6 col-lg-6">

<?php
      if($resultado!=null){
        foreach ($resultado as $reg) {

          ?>


        	<p><label for="ejercicios" style="font-weight:normal;">Ejercicio: <?php echo($reg['nombre']); ?></label></p>

          <?php
            if($reg['tipo']=='cardio'){
          ?>

          <p><label for="tiempo" style="font-weight:normal;">Tiempo: <?php echo($reg['tiempo']); ?></label></p>

          <?php
           }else if($reg['tipo']=='resistencia'){
          ?>

          <p><label for="tiempo" style="font-weight:normal;">Tiempo: <?php echo($reg['tiempo']); ?></label></p>
          <p><label for="peso" style="font-weight:normal;">Peso: <?php echo($reg['peso']); ?></label></p>

          <?php
            }else{
          ?>

          <p><label for="repeticiones" style="font-weight:normal;">Repeticiones: <?php echo($reg['repeticiones']); ?></label></p>
          <p><label for="peso" style="font-weight:normal;">Peso: <?php echo($reg['peso']); ?></label></p>

          <?php
            }
          ?>

          <input name="lista[]" type="checkbox" id="lista[]" value="<?php echo($reg['idEjercicio']); ?>" autofocus="" readonly>
                   <?php echo "<div  style=\"margin-top:30px;\">";
                   echo "<img alt=\"Imagen\" src=\""."../images/ejercicios/".$reg['URLImagen']."\" style=\"max-width: 70%;\">";?>
              <br>
              <br>
              <br>


          <?php
} echo "</div>";}
?>
                </div>

              </div>

          </div>

        </div>

        <div class="row">
          <br />
          <form class="col-xs-12  col-sm-6  col-md-6  col-lg-6" method="post" action="">
             <div class="btn-group col-xs-12 col-sm-6 col-md-4 col-lg-4" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <button type="submit" id="submit" name="submit" class="btn btn-default3" id="botonGuardarCambios" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Publicar Tabla</button>
              </div>
            <!--<p id="bot"><input type="submit" value="Crear Actividad" id="submit" name="submit" class="button" /></p>-->
          </form>

            <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <a href="v_gestionarTablas.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
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
