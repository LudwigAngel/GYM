<?php
  @session_start();


 require_once '../funciones/conexion.php';


require_once '../modelos/m_gestionarInscripciones.php';
require_once '../funciones/sesion.php';

if(isset($_POST['submit'])){
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      c_inscripcion::inscripcionActividad();
      break;

    case 1:
      c_inscripcion::cancelarInscripcion();
      break;
	  default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/v_gestionarUsuarios.php'";
      echo "</script>";
      break;
  }
}

class c_inscripcion
{
	public static function inscripcionActividad()
  {
    $identificacion = $_POST['dniU'];
    $activity = $_POST['actividad'];
	$name = $_POST['nombreActividad'];

	$modelo_gestionarInscripciones = new m_gestionarInscripciones();
    if(!$modelo_gestionarInscripciones->comprobarDeportistaActividad($identificacion, $activity))
	{

	$modelo_gestionarInscripciones-> inscripcionActividad($identificacion,$activity);
	} else {
		$mensaje = "Ya estas inscrito en esta actividad, no puedes volver a inscribirte";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarActividades.php'";
                echo "</script>";
	}
  }

	public static function cancelarInscripcion()
  {
    $identificacion = $_POST['dniU'];
    $activity = $_POST['actividad'];

    $modelo_gestionarInscripciones = new m_gestionarInscripciones();
	$modelo_gestionarInscripciones -> cancelarInscripcion($identificacion, $activity);

  }

  public static function getMisActividades(){
	  $identificacion= $_SESSION['userID'];
	  $modelo_gestionarInscripciones = new m_gestionarInscripciones();
	   return $modelo_gestionarInscripciones -> getMisActividades($identificacion);
  }


  public static function devolverInscritos($activity)
  {
    //$activity = $_GET['id'];

    $modelo_gestionarInscripciones = new m_gestionarInscripciones();

    return $modelo_gestionarInscripciones-> devolverInscritos($activity); 
  }
}


?>
