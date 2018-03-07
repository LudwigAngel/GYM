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
						<li><a href="#instalaciones">Instalaciones</a></li>
						<li><a href="#localizacion">Localizaci&oacuten</a></li>
						<li><a href="#contacto">Contacto y Horarios</a></li>
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

<p style="font-size: -webkit-xxx-large;" id="instalaciones">Instalaciones</p>

<div id="myCarousel" class="carousel slide" data-ride="carousel" style="
background-color: #616b85;">
<!-- Indicators -->
<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>
<li data-target="#myCarousel" data-slide-to="3"></li>


</ol>

<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
<div class="item active">
<img width="1200" height="270" src="../images/instalaciones/gimnasio.jpg">
</div>

<div class="item" data-target="#myCarousel">
<img width="1200" height="270" src="../images/instalaciones/spinning.jpg">
</div>

<div class="item">
<img width="1200" height="270" src="../images/instalaciones/futsal.jpg">
</div>

<div class="item">
<img width="1200" height="270" src="../images/instalaciones/tenis.jpg">
</div>


</div>

<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>

<div class="localizacion" id="localizacion">


 <p style="font-size: -webkit-xxx-large; ">Localizaci&oacuten</p>
        <p style="font-size: large;">Lonia, s/n - CAMPUS UNIVERSITARIO - 32004 Ourense</p>
          <div class="embed-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2948.979895347437!2d-7.8523016!3d42.342952!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2ffebfc4e9e631%3A0x8a96205e37b805b4!2sPolideportivo+Universitario%2C+%E2%9B%89+Campus+As+Lagoas%2C+4.%C2%BA+piso%2C+32004+Orense%2C+Ourense!5e0!3m2!1ses!2ses!4v1479152548796" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
          <br>
          <br>
       <img width="800" height="338" src="../images/index/pabellon.PNG" class="img-responsive"></img>
</div>
<!------------------IMPORTANTEEE-------------->
<!------------------IMPORTANTEEE-------------->
<!------------------IMPORTANTEEE-------------->
<!------------------IMPORTANTEEE-------------->
<!-- he cambiado la ruta de la imagen del pabellon-->



<div class="row">

<div class="flex_column one_fourth first col-xs-12  col-sm-5  col-md-5  col-lg-5" >
<div id="text-7" class="widget widget_text">
<h3 class="widgettitle">
<span class="widget_first" id="contacto" style="font-size: larger;">Contacto: </span>
</h3>
<div class="textwidget">
<p>Direcci&oacuten: Lonia, s/n - CAMPUS UNIVERSITARIO<br>
32004 Ourense<br>
Tel&eacutefono: 988 387 198<br>
Email: depor-ou@uvigo.es<br>
</p>
</div>
<span class="seperator extralight-border"></span>
</div>
</div>

<div class="flex_column one_fourth col-xs-12  col-sm-5  col-md-5  col-lg-5">
<div id="text-4" class="widget widget_text">
<h3 class="widgettitle">
<span class="widget_first" style="font-size: larger;">Horarios:</span></h3>
<div class="textwidget">De lunes a viernes: 09:00 - 23:00<br>
S&aacutebados: 10:00 - 14:00 y 16:00 - 21:00<br>
Domingos: 10:00 - 14:00 y 16:00 - 20:00<br>
</div>
<span class="seperator extralight-border"></span>
</div>
</div>

</div>

</div>

</body>

</html>

