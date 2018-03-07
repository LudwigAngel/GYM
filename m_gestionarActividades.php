<?php
  require_once '../controladores/c_actividad.php';
  require_once '../funciones/conexion.php';

  class m_gestionarActividades{

    public $bd = null;

    function __construct()
    {
      $bd = conexion_BD(); //Hay qe iniciar la conexion bd en los metodos, queda saber pq????
    }

    public function comprobarActividad($id)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM actividad WHERE idActividad = '".$id."'");
  		if($r->num_rows > 0){
        $toret = true;
		  }
      else {
        $toret = false;
      }
      return $toret;
		}

    public function getDatosActividad($id)
    {
      $bd = conexion_BD();
      $r = $bd->query("SELECT * FROM actividad WHERE idActividad='".$id."'");

      mysqli_data_seek ($r, 0);
      $extraido= mysqli_fetch_array($r);
      return $extraido;
    }

    public function getActividades()
    {
      $bd = conexion_BD();
      $sql = "SELECT * FROM actividad";
      $result = mysqli_query($bd, $sql);//REALIZA LA CONSULTA

      return $result;
    }


		public function publicarActividad($name,$tipe, $des, $place)
    {
        $id = '0';

        $bd = conexion_BD();
        $stmt = $bd->prepare("INSERT INTO actividad (idActividad, nombre,tipo,descripcion,lugar) VALUES ( ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $id, $name, $tipe, $des, $place);

        if(!$stmt->execute())
        {
          echo "<script>";
          echo "alert('Error en la consulta a la base de datos');";
          echo "window.location = '../vistas/v_gestionarActividades.php'";
          echo "</script>";
    		}
    		else
        {

    		$mensaje = "La actividad ha sido publicada";
    							echo "<script>";
    							echo "alert('$mensaje');";
    							echo "window.location = '../vistas/v_gestionarActividades.php'";
    							echo "</script>";
    		}

            $stmt->close();
    }

    public function cancelarActividad($id)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("DELETE FROM actividad WHERE idActividad= '$id' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
			$mensaje = "La actividad ha sido cancelada";
            echo "<script>";
            echo "alert('$mensaje');";
            echo "window.location = '../vistas/v_gestionarActividades.php'";
            echo "</script>";
      }
      $stmt->close();
    }

    public function modificarActividad($id,$nombre,$tipo,$des,$lugar)
    {
      $bd = conexion_BD();
      $stmt = $bd->query("UPDATE actividad SET nombre='$nombre', tipo='$tipo', descripcion='$des',lugar='$lugar'  where idActividad='".$id."' ");

      $r=$bd->affected_rows;
      if($r>0)
      {
        $mensaje = "La actividad ha sido modificada";
        echo "<script>";
        echo "alert('$mensaje');";
        echo "window.location = '../vistas/v_gestionarActividades.php'";
        echo "</script>";

      }else{
        echo "<script>";
        echo "alert('No se ha realizado ningun cambio.');";
        echo "window.location = '../vistas/v_gestionarActividades.php'";
        echo "</script>";
      }
          $stmt->close();
    }

}

  ?>
