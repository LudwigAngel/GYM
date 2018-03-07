<?php
    @session_start();

    require_once ('../controladores/c_tabla.php');
    require_once ('../controladores/c_ejercicio.php');
    require_once ('../controladores/c_usuario.php');

    $dni=$_SESSION['userID'];
  
    $db= conexion_BD();
    $idTabla = $_GET['id'];
    $tabla = c_tabla::getTabla($idTabla);
    $resultado = c_tabla::devolverDatosEjercicioTabla($idTabla);
    
    
     if(isset($_SESSION['userID'])  && $_SESSION['connected'] == true && $_SESSION['userType'] == 'Deportista')
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


      <p style="font-size: -webkit-xxx-large;" id="actividades">Datos Tabla</p>



       <div class="row" >
       <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-4">

       <?php
       if($tabla!=null){
          foreach ($tabla as $reg) {
      ?>

         <div>
          <br />
          <label for="nombre" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Nombre Tabla: <?php echo $reg['nombre']; ?></p></label>
          <br />
        </div>

		   <div>
          <br />
          <label for="tipo" style="margin-right:5px; font-weight:normal;"><p style="font-size: x-large;">Tipo Tabla: <?php echo $reg['tipo']; ?></p></label>
          <br />
        </div>

        <div>
          <br />
          <label for="instrucciones" style="margin-right:5px; font-weight:normal; font-size: x-large;">Instrucciones:</label><br />
          <textarea name="instrucciones" rows="7" cols="34"  required="" readonly><?php echo $reg['instrucciones']; ?></textarea><br />
        </div>

      </div>
      <?php
        }
      }
      ?>
        <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
		    <label style="margin-right:5px; font-weight:normal; font-size: x-large;">Lista de ejercicios:</label><br />

        <form id="complete" action="../controladores/c_ejercicio.php?var=3&idTabla=<?php echo $idTabla; ?>#" method="post">
      <?php
      if($tabla!=null){
        foreach ($resultado as $reg2) {
          ?>


        	 <p><label for="ejercicios" style="font-weight:normal;">Ejercicio: <?php echo($reg2['nombre']); ?></label></p>

            <?php
            if($reg2['tipo']=='cardio'){
            ?>

            <p><label for="tiempo" style="font-weight:normal;">Tiempo: <?php echo($reg2['tiempo']); ?></label></p>

            <?php
             }else if($reg2['tipo']=='resistencia'){
            ?>

            <p><label for="tiempo" style="font-weight:normal;">Tiempo: <?php echo($reg2['tiempo']); ?></label></p>
            <p><label for="peso" style="font-weight:normal;">Peso: <?php echo($reg2['peso']); ?></label></p>

            <?php
              }else{
            ?>

            <p><label for="repeticiones" style="font-weight:normal;">Repeticiones: <?php echo($reg2['repeticiones']); ?></label></p>
            <p><label for="peso" style="font-weight:normal;">Peso: <?php echo($reg2['peso']); ?></label></p>

            <?php
              }
            ?>
           
          
                   <?php echo "<div  style=\"margin-top:30px;\">";
                   echo "<img alt=\"Imagen\" src=\""."../images/ejercicios/".$reg2['URLImagen']."\" style=\"max-width: 70%;\">";?>
              <br>
                  <input name="completados[]" type="checkbox" id="completados[]" value="<?php echo($reg2['idEjercicio']); ?>" autofocus="">
                  <option> Completado</Option>
                  <i>Número de veces realizado: <?php echo(c_ejercicio::getVecesEjercicio($reg2['idEjercicio'])); ?> </i>
              <br>
              <br>
                <?php 
                  $res2 = c_usuario::getComentarios($reg2['idEjercicio'],$dni);
                  if ($res2!=null) {
                    foreach ($res2 as $reg3) {
                ?>
                 <textarea style="margin-left: 10px;" readonly rows="5" cols="40"><?php echo $reg3['comentario'] ?></textarea>
              <br>
             
                <?php 
                      }
                    }
                ?>
          </div>

    
          <br>
          <br>
          <br>

          <?php
          } echo "</div>"; }
          ?>

          <input type="hidden" name="submit" value="submit">

        </form>

         <div class="btn-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
         <div style="border: solid;border-radius:5px; border-color: black;">
          <form action="../controladores/c_usuario.php?var=7" method="post">

                
               <div>
                    <br>
                   <label for="coment" style="margin-left: 10px;"> Añadir Comentario: </label>
                  

                    <select name="idEjercicio">
                     <?php
                    if($tabla!=null){
                      foreach ($resultado as $reg4) {
                   ?>
                        <option value="<?php echo $reg4['idEjercicio'];?>"><?php echo $reg4['nombre']; ?></option>
                    <?php
                      }
                    }
                   ?>
                    </select>
                  

                  <br>
                   <br>

                   <textarea style="margin-left: 10px;" required="" rows="10" cols="40" maxlength="500" name="comentario" placeholder="Comentar ejercicio"></textarea>

                   <br>
                   <br>

                   <input type="hidden" name="idTabla" value="<?php echo $idTabla;?>">
                   <input type="hidden" name="dni" value="<?php echo $dni;?>">
                   <button type="submit" id="botonGuardarCambios" name="submit" class="btn btn-default2" style="margin-left: 10px; margin-bottom: 5px;">Guardar Comentario</button>

                   <br>
                   <br>
               </div>
            
              
          </form>
         </div> 
         <br>
         <br>
         </div>

         

        <div class="btn-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
          <a href="v_misTablas.php" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonAtras"><span class="glyphicon glyphicon-step-backward" style="margin-right: 5px;"></span>Atr&aacutes</button></a>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

		    <div class="btn-group col-xs-12 col-sm-2 col-md-2 col-lg-2">
          <button form="complete" type="submit" class="btn btn-default2" id="botonAtras"><span  style="margin-right: 5px;"></span>Tabla completada </button>
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
