<? php
header("controlador_login.php");
?>
<html>
	<head>
	<title> LOGIN </title>
	<link rel='stylesheet' type='text/css' href='estilo.css' media='all'>
</head>
	<body class='tablaLogin' background='imagen0.jpg'>
		<h1 class='tituloLogin'> UNIVERSITA DI CATANIA </h1>
	
		<form method="POST" action="" />
	
			<table style="margin: 30 auto;">	
			
				<tr>
				<td class='menuLogin'> CODICE FISCALE:</td>
				<td> <input class='tablaLogin' type="name" name="codicefiscale" /> </td>
				</tr>
				
				
				<tr>
				<td class='menuLogin'> PASSWORD :</td>
				<td> <input class='tablaLogin' type="password" name="pass" /> </td>
				</tr>
				
			</table>
		
			<input class='botonesLogin' type="submit" name="loguearse" value="LOGUEARSE" /> 	
			<input type="button" value="REGISTRARSI" onclick="window.location.href='formulario.php'">
		</form>			
	</body>
</html>