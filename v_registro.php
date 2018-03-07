<?php
header("controlador_registro.php");
?>
<html>
			<head>
				<title> Formulario para registrar deportista </title>
					<link rel='stylesheet' type='text/css' href='estilo.css' media='all'>
			</head>
					<body class='tablaPrincipal' background='imagen1.jpg'>
						<h1 class='tituloPrincipal'> FORMULARIO DEPORTISTA </h1>
						<h3 class='informacionPrincipal'> los campos con asteriscos son obligatorios </h3>
							<form method="POST" action="" />
								<table style="margin: 30 auto;">	
			
									<tr>
									<td class='menuPrincipal'> DNI:</td>
									<td> <input class='tablaPrincipal' type="name" name="codicefiscale" /> </td>
									</tr>
										
									<tr>
									<td class='menuPrincipal'> *Nombre y apellidos:</td>
									<td> <input class='tablaPrincipal' type="name" name="nome" /> </td>
									</tr>
										
									<tr>
									<td class='menuPrincipal'> *Contraseña :</td>
									<td> <input class='tablaPrincipal' type="password" name="pass" /> </td>
									</tr>
										
									<tr>
									<td class='menuPrincipal'> *Repetir contraseña :</td>
									<td> <input class='tablaPrincipal' type="password" name="rpass" /> </td>
									</tr>
								</table>
			
										<input class='botonesPrincipal' type="submit" name="submit" value="REGISTRARSI" /> 
										<input class='botonesPrincipal' type="reset" value='AZZERA I CAMPI'/>	
							</form>
		</body>
	</html>