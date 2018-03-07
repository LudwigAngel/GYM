
			<?php
			$codicefiscale = $_POST['codicefiscale'];
			$nome = $_POST['nome'];
			$pass = $_POST['pass'];
			$rpass = $_POST['rpass'];
	
			
				
								include_once "conexion.php";
								define('DB_SERVER','localhost');
			define('DB_NAME','usuarios');
			define('DB_USER','root');
			define('DB_PASS','');
		
			$con = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			if ($con->connect_errno) 
			{
				echo "EROOR AL CONCECTAR CON MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
			}
								
								echo("hola");
								//insert
								$pass = md5($pass);
								mysqli_query($con,"INSERT INTO `alumnos` (`codicefiscale`, `nome`, `pass`) VALUES ('".$codicefiscale."', '".$nome."', '".$pass."')");
				
								//cerrarBD();
								mysqli_close($con);
							
		
								
				?>
				
