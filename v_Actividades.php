<?php
  require_once '../funciones/conexion.php';
  require_once '../funciones/sesion.php';
  require_once '../controladores/c_actividad.php';
  $bd= conexion_BD();
  $result = c_actividad::getActividades();
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
					<a class="navbar-brand" href="v_principal.php"><img src="../images/navbar-footer/tiburonlogo.png" style="margin-top:-10px;"></img></a>
				</div>

<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top: 3px;">
					<ul class="nav navbar-nav">
						<li><a href="v_principal.php#instalaciones">Instalaciones</a></li>
						<li><a href="v_principal.php#localizacion">Localizaci&oacuten</a></li>
						<li><a href="v_principal.php#contacto">Contacto y Horarios</a></li>
						<li><a href="../vistas/v_Actividades.php">Actividades</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">


<!-- COMIENZO MODAL -->

					<div class="form-group">
						<button id="modalButton" type="button" class="btn btn-default1" data-toggle="modal" data-target=".bs-example-modal-sm" style="margin-left: 10px;">Iniciar Sesi&oacuten</button>
							<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
								<div class="modal-dialog modal-sm" role="document">
									<div class="modal-content" id="modalLogin">
										<div class="modal-header">
											<h4 style="text-align: center; color:white;" class="modal-title">Iniciar Sesi&oacuten</h4>
										</div>
										<div class="text-center">
											<p style="text-align: center; margin-top: 20px;"><img src="../images/navbar-footer/tiburon2.png"></img></p>
											<div class="login-form-1">
												<div class="login-form-main-message"></div>
													<div class="main-login-form">
														<div class="login-group">

															<form action="../controladores/c_usuario.php?var=3#" method="post">

																<p><label >Dni:</label></p>
																<input name="dni" type="text" id="dni" placeholder="Ingresa dni" autofocus="" required=""></p>

																 <p><label >Contraseña:</label></p>
																  <input name="contrasena" type="password" id="contrasena" placeholder="Ingresa contraseña" autofocus="" required=""></p>


																  <p>Tipo:
																<select id="tipo" name="tipo" required="">
																<option> Deportista </Option>
																<option> Entrenador </Option>
																<option> Administrador </Option>
																</select>
																</p>

																	<p id="bot"><button type="submit" class="btn btn-default1" id="botonModificar" name="submit" style="margin-bottom: 10px;" class="btn btn-default3">Iniciar Sesi&oacuten</button></p>
															</form>
														</div>
													</div>
										    </div>
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

      <p style="font-size: -webkit-xxx-large;" id="actividades">Actividades</p>

        
       <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">
         
         <thead> <!-- CABECERA DE LA TABLA -->

            <tr>
              <th>Nombre Actividad</th><!-- EN LA TABLA SOLO QUEREMOS QUE EN LA CABECERA SALGA EL NOMBRE DE ACTIVIDAD
                                        LOS BOTONES SE PUEDEN METES A MAYORES SIN TENER CABECERA PROPIA  -->
            </tr>

          </thead>

          <tbody>
            <?php
              
              foreach ($result as $reg) {//LA VARIABLE $REG GUARDA LOS REGISTROS DE LA CONSULTA REALIZADA
             
            ?>
            <tr>
              <td><?php echo $reg['nombre']; ?></td>
              <td>
               <textarea rows="7" cols="44" readonly> <?php echo $reg['descripcion']; ?> </textarea>
              </td>
            </tr>

            <?php }
             
           ?>
          </tbody>

        </table>
      </div>
       
    </div>
        

  </body>

</html>