<?php
    @session_start();
    require_once ('../controladores/c_ejercicio.php');

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
      <p style="font-size: -webkit-xxx-large;" id="actividades">Nuevo ejercicio</p>

      <form id="contact_form" action="../controladores/c_ejercicio.php?var=0#" method="post"  enctype="multipart/form-data" style="margin-right:5px;">

        <div>
          <label for="ejercicio" style="margin-right:5px; font-weight:normal; font-size: x-large;">Id Ejercicio:</label><br />
          <input  placeholder="Introduce el id del ejercicio" name="ejercicio" type="text" size="30" required=""/><br />
        </div>

        <div>
          <br />
          <label for="nombreEjercicio" style="margin-right:5px; font-weight:normal; font-size: x-large;">Nombre Ejercicio:</label><br />
          <input  placeholder="Introduce el nombre del ejercicio" name="nombreEjercicio" type="text" size="30" required=""/><br />
        </div>
		
		  <div>
          <br />
          <label for="descripcion" style="margin-right:5px; font-weight:normal; font-size: x-large;">Descripci&oacuten:</label><br />
          <textarea name="descripcion" rows="7" cols="44" required=""></textarea><br />
        </div>
		
		       <div>
           <br />
              <label for="repeticiones"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Repeticiones: </label>
              <input type="text" name="repeticiones" placeholder="xx-xx-xx-xx">
          </div>
         
          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: </label>
              <input type="number" min="0" name="peso">
          </div>

          <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: </label>
              <input type="text" name="tiempo">
          </div>
          <!-- DIV IMAGEN-->
          <div style="margin-top:30px;">
              <label for="imgEjer"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Subir Imagen: </label>
              <input type="file" required="" name="imagen">
          </div>

          <div>
            <br />
              
              <select name="tipo">
                  <option value="brazos">Brazos</option>
                  <option value="espalda">Espalda</option>
                  <option value="pecho">Pecho</option>
                  <option value="piernas">Piernas</option>
                  <option value="cardio">Cardio</option>
                  <option value="resistencia">Resistencia</option>
              </select>
                        
          </div> 
		
     

        <div class="row">
          <br />
          <form class="col-xs-5  col-sm-3  col-md-3  col-lg-3" method="post" action="" enctype="multipart/form-data">
             <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <button type="submit" id="submit" name="submit" class="btn btn-default3" id="botonGuardarCambios" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Publicar Ejercicio</button>
              </div>
            <!--<p id="bot"><input type="submit" value="Crear Actividad" id="submit" name="submit" class="button" /></p>-->
          </form>

            <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <a href="v_gestionarEjercicios.php?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
            </div>
          </div>
      </form>           
      </div>
    </footer>

  </body>

</html>

<?php
}
else 
  {

    if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador')
    {   ?>
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
      <p style="font-size: -webkit-xxx-large;" id="actividades">Nuevo ejercicio</p>

      <form id="contact_form" action="../controladores/c_ejercicio.php?var=0#" method="post"  enctype="multipart/form-data" style="margin-right:5px;">

        <div>
          <label for="ejercicio" style="margin-right:5px; font-weight:normal; font-size: x-large;">Id Ejercicio:</label><br />
          <input  placeholder="Introduce el id del ejercicio" name="ejercicio" type="text" size="30" required=""/><br />
        </div>

        <div>
          <br />
          <label for="nombreEjercicio" style="margin-right:5px; font-weight:normal; font-size: x-large;">Nombre Ejercicio:</label><br />
          <input  placeholder="Introduce el nombre del ejercicio" name="nombreEjercicio" type="text" size="30" required=""/><br />
        </div>
    
      <div>
          <br />
          <label for="descripcion" style="margin-right:5px; font-weight:normal; font-size: x-large;">Descripci&oacuten:</label><br />
          <textarea name="descripcion" rows="7" cols="44" required=""></textarea><br />
        </div>
    
           <div>
           <br />
              <label for="repeticiones"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Repeticiones: </label>
              <input type="text" name="repeticiones" placeholder="xx-xx-xx-xx">
          </div>
         
          <div>
          <br />
              <label for="peso"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Peso: </label>
              <input type="number" min="0" name="peso">
          </div>

          <div>
          <br />
              <label for="tiempo"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Tiempo: </label>
              <input type="text" name="tiempo">
          </div>
          <!-- DIV IMAGEN-->
          <div style="margin-top:30px;">
              <label for="imgEjer"  style="margin-right:5px; font-weight:normal; font-size: x-large;">Subir Imagen: </label>
              <input type="file" required="" name="imagen">
          </div>

          <div>
            <br />
              
              <select name="tipo">
                  <option value="brazos">Brazos</option>
                  <option value="espalda">Espalda</option>
                  <option value="pecho">Pecho</option>
                  <option value="piernas">Piernas</option>
                  <option value="cardio">Cardio</option>
                  <option value="resistencia">Resistencia</option>
              </select>
                        
          </div> 
    
     

        <div class="row">
          <br />
          <form class="col-xs-5  col-sm-3  col-md-3  col-lg-3" method="post" action="" enctype="multipart/form-data">
             <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <button type="submit" id="submit" name="submit" class="btn btn-default3" id="botonGuardarCambios" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Publicar Ejercicio</button>
              </div>
            <!--<p id="bot"><input type="submit" value="Crear Actividad" id="submit" name="submit" class="button" /></p>-->
          </form>

            <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
                <a href="v_gestionarEjercicios.php?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
            </div>
          </div>
      </form>           
      </div>
    </footer>

  </body>

</html>

<?php

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