<?php

  @session_start();
  require_once '../funciones/conexion.php';
  require_once '../controladores/c_actividad.php';
  $db= conexion_BD();
  $idActividad = $_GET['id'];
  $result = c_actividad::devolverActividad($idActividad);
  if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Administrador')
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

      <p style="font-size: -webkit-xxx-large; ">Modificar Actividad</p>

     

       <form id="contact_form" action="../controladores/c_actividad.php?var=2#" method="post" enctype="multipart/form-data" style="margin-right:5px;">

        <div class="col-xs-12  col-sm-5  col-md-5  col-lg-5">


        <div>
          <br />
          <label for="nombreA" style="margin-right:5px; font-weight:normal; font-size: x-large;">Nombre Actividad:</label>
          <input  value="<?php echo $result['nombre']?>" name="actualizarnombre" type="text" size="30" required=""/>
        </div>

        <div>
          <br /> 
          <label for="tipo" style="margin-right:5px; font-weight:normal; font-size: x-large;">Tipo Actividad:</label>
          <select name="actualizartipo" style="font-weight:normal; font-size: x-large;" required="">
			     <option><?php echo $result['tipo']; ?></option>
            <option value="Cardio">Cardio</option>
            <option value="Arte Marcial" >Arte marcial</option>
            <option value="Muscular">Muscular</option>
            <option value="Deportiva">Deportiva</option>
            <option value="Competicion">Competici&oacuten</option>
          </select>
        </div>

        <div>
          <br />
          <label for="descripcion" style="margin-right :5px; font-weight:normal; font-size: x-large;">Descripci&oacuten:</label><br />
          <textarea name="actualizardescrip" rows="7" cols="44" required=""> <?php echo $result['descripcion']; ?> </textarea>
        </div>

        <div>
          <br />
          <label for="lugar" style="margin-right:5px; font-weight:normal; font-size: x-large;">Lugar:</label>
          <input type="text" name="actualizarlugar" value="<?php echo $result['lugar'];?>" required=""></input>
        </div>

        </div>

         <input type="hidden" name="actualizarid" value="<?php echo $result['idActividad'];?>"></input>    
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_verActividad.php?id=<?php echo $result['idActividad'] ;?>" style="text-decoration: none;"><button type="submit" class="btn btn-default3" id="botonGuardarCambios" name="submit" style="background-color: #279B13; color: black;"><span class="glyphicon glyphicon-ok" style="margin-right: 5px;"></span>Guardar Cambios</button></a>
        </div>

        <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px; margin-bottom: 15px;">
          <a href="v_verActividad.php?id=<?php echo $result['idActividad'] ;?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar"><span class="glyphicon glyphicon-remove" style="margin-right: 5px;"></span>Cancelar</button></a>
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