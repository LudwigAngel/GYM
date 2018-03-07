<?php
function conexionBD()
{
		//CONEXION A LA BASE DE DATOS
			define('DB_SERVER','localhost');
			define('DB_NAME','usuarios');
			define('DB_USER','root');
			define('DB_PASS','');
		
			$con = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			if ($con->connect_errno) 
			{
				echo "EROOR AL CONCECTAR CON MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
			}
}
?>