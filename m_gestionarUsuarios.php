  <?php
  //require_once '../controladores/c_usuario.php';
  require_once '../funciones/conexion.php';

  class m_gestionarUsuarios{

    public $bd = null;

    function __construct()
    {
      $bd = conexion_BD(); //Hay qe iniciar la conexion bd en los metodos, queda saber pq????
    }

    public function comprobarUsuario($identificacion)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM usuario WHERE DNI = '".$identificacion."'");
  		if($r->num_rows > 0){
        $toret = true;
		  }
      else {
        $toret = false;
      }
      return $toret;
		}

		public function comprobarUsuarioLogin($id, $pass, $tipe)
    {
		$bd = conexion_BD();
		$r = $bd->query("SELECT * FROM usuario WHERE DNI = '".$id."' AND password='".$pass."' AND tipo ='".$tipe."' ");

    if($r->num_rows > 0){
      $toret = true;
      mysqli_data_seek ($r, 0);
  		$extraido= mysqli_fetch_array($r);

      $d = $extraido['tipo'];

  		if($d=='Entrenador'){

          $mensaje = "Login Correcto";
              echo "<script>";
              echo "alert('$mensaje');";
              echo "window.location = '../vistas/v_entrenador.php'";
              echo "</script>";

      } else if($d=='Deportista'){

  		  $mensaje = "Login correcto";
              echo "<script>";
              echo "alert('$mensaje');";
              echo "window.location = '../vistas/v_deportista.php'";
              echo "</script>";

  	  } else if ($d=='Administrador'){

  		  $mensaje = "Login correcto";
              echo "<script>";
              echo "alert('$mensaje');";
              echo "window.location = '../vistas/v_administrador.php'";
              echo "</script>";
  	  }

    } else {
      $toret = false;
      $mensaje = "Login incorrecto, introduzca los datos de nuevo";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/v_principal.php'";
            echo "</script>";
    }
      $bd->close();
      return $toret;
    }

    public function getUsuarios()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario";
      $result = mysqli_query($bd, $sql);//REALIZA LA CONSULTA

      return $result;
    }

    public function getDeportistas()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario where tipo='Deportista' ";
      $result = mysqli_query($bd, $sql);//REALIZA LA CONSULTA

      return $result;
    }

    public function getEntrenadores()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario where tipo='Entrenador' ";
      $result = mysqli_query($bd, $sql);//REALIZA LA CONSULTA

      $extraido= mysqli_fetch_array($result);
      return $result;

    }

    public function getDeportistasGeneral(){
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario where tipo='Deportista' and tipoDeportista='TDU'";
      $result = mysqli_query($bd, $sql);//REALIZA LA CONSULTA

      return $result;
    }

    public function getDeportistasPEF(){
      $bd = conexion_BD();
      $sql = "SELECT * FROM usuario where tipo='Deportista' and tipoDeportista='PEF'";
      $result = mysqli_query($bd, $sql);//REALIZA LA CONSULTA

      return $result;
    }

    public function getDatosUsuario($dni)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM usuario WHERE DNI='".$dni."'");

      mysqli_data_seek ($r, 0);
      $extraido= mysqli_fetch_array($r);
      return $extraido;
    }

	public function getHistorialDeportistas($dni)
    {
      $bd = conexion_BD();
      $extraido = $bd->query("SELECT * FROM historial WHERE Usuario_DNI='".$dni."' ORDER BY FECHA ASC");

      $r=$bd->affected_rows;
      if($r>0)
      {
        /*mysqli_data_seek ($r, 0);
        $extraido= mysqli_fetch_array($r);*/
        return $extraido;

      }else {
        $mensaje = "Su historial de entrenamiento esta vacio.";
              echo "<script>";
              echo "alert('$mensaje');";
              echo "window.location = '../vistas/v_deportista.php'";
              echo "</script>";

        return null;
      }
      $bd->close();

      /*mysqli_data_seek ($r, 0);
      $extraido= mysqli_fetch_array($r);
      return $extraido;*/
    }

    public function eliminarHistorialDeportista($dniDeportista)
    {
      $bd = conexion_BD();
      $extraido = $bd->query("DELETE FROM historial WHERE Usuario_DNI='".$dniDeportista."'");

      $r=$bd->affected_rows;
      if($r>0)
      {
        $mensaje = "Su historial ha sido eliminado.";
              echo "<script>";
              echo "alert('$mensaje');";
              echo "window.location = '../vistas/v_deportista.php'";
              echo "</script>";

      }else {
        $mensaje = "Su historial de entrenamiento esta vacio.";
              echo "<script>";
              echo "alert('$mensaje');";
              echo "window.location = '../vistas/v_deportista.php'";
              echo "</script>";
      }
      $bd->close();
    }

	public function altaUsuario($identificacion, $nombre, $pass, $correo, $surname, $tipe, $tipoD)
    {

        $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO usuario (dni, nombre, apellidos, email, password, tipo, tipoDeportista) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss', $identificacion, $nombre, $surname, $correo, $pass, $tipe, $tipoD);

        if(!$stmt->execute())
        {
          echo "<script>";
          echo "alert('Error en la consulta a la base de datos');";
          echo "window.location = '../vistas/v_gestionarUsuarios.php'";
          echo "</script>";
    		}
    		else
        {

    		$mensaje = "El usuario/Deportista ha sido dado de alta en el sistema";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/v_gestionarUsuarios.php'";
    							echo "</script>";
    		}

            $stmt->close();
    }

    public function bajaUsuario($identificacion)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("DELETE FROM usuario WHERE DNI= '$identificacion' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
			$mensaje = "El usuario/Deportista ha sido dado de baja";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/v_gestionarUsuarios.php'";
            echo "</script>";
      }
      $stmt->close();
    }

    public function modificarUsuario($nombre,$pass,$correo,$identificacion,$surname, $tipe, $tipoD)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("UPDATE usuario SET nombre='$nombre', apellidos='$surname', email='$correo', password='$pass', tipo='$tipe', tipoDeportista='$tipoD'  where DNI='".$identificacion."' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
        $mensaje = "El deportista/usuario ha sido modificado";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/v_gestionarUsuarios.php'";
        echo "</script>";

      }else{
        echo "<script>";
        echo "alert('No se ha realizado ningun cambio.');";
        echo "window.location = '../vistas/v_gestionarUsuarios.php'";
        echo "</script>";
      }
          $stmt->close();
    }

    public function modificarPerfil($nombre,$pass,$correo,$identificacion,$surname, $tipe, $tipoD)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("UPDATE usuario SET nombre='$nombre', apellidos='$surname', email='$correo', password='$pass', tipo='$tipe', tipoDeportista='$tipoD' where DNI='".$identificacion."' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
        $mensaje = "El deportista/usuario ha sido modificado";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/v_verPerfil.php'";
        echo "</script>";

      }else{
        echo "<script>";
        echo "alert('No se ha realizado ningun cambio.');";
        echo "window.location = '../vistas/v_verPerfil.php'";
        echo "</script>";
      }
          $stmt->close();
    }

    public static function añadirComentarioEjercicio($comentario,$idEjercicio,$dni,$idTabla){
      $bd = conexion_BD();
      $stmt = $bd->query("UPDATE comenta_ejercicio SET comentario='$comentario' where Usuario_DNI='".$dni."' AND Ejercicio_idEjercicio='".$idEjercicio."' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
        $mensaje = "Comentario Realizado";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/v_verTablaDeportista.php?id=$idTabla'";
        echo "</script>";

      }else{
        echo "<script>";
        echo "alert('No se ha realizado ningun cambio.');";
        echo "window.location = '../vistas/v_verTablaDeportista.php?id=$idTabla'";
        echo "</script>";
      }
          $stmt->close();
    }

    public static function getComentarios($idEjercicio,$dni){
      $bd = conexion_BD();
      $sql=  "SELECT comentario FROM comenta_ejercicio where Usuario_DNI='".$dni."' AND Ejercicio_idEjercicio='".$idEjercicio."'";
      $result = mysqli_query($bd, $sql);//REALIZA LA CONSULTA

      return $result;
    }

}

  ?>
