<?php

require_once '../modelos/m_gestionarSesiones.php';

if(isset($_POST['submit']))
{
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      c_sesion::altaSesion();
      break;

    case 1:
      c_sesion::bajaSesion();
      break;

    case 2:
      c_sesion::modificarSesion();
      break;

	  case 3:
	  c_sesion::reservarSesion();
	  break;

	  case 4:
	  c_sesion::cancelarSesion();
	  break;
     /*
     *
     *Ponemos la opcion que sea en la vista como Get por ejemplo:
     *<form method="post" action="../controladores/c_deportista.php?var=0#" >
     *c_deportista.php?var= a lo que sea i ponemos el numero en el case y .
     *
     */
    default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/v_gestionarDeportistas.php'";
      echo "</script>";
      break;
  }
}

class c_sesion
{



  public static function devolverDatosSesion($id)
  {
  	$modelo_gestionarSesiones = new m_gestionarSesiones();

    if($modelo_gestionarSesiones->comprobarSesion($id))
    {
		return $modelo_gestionarSesiones->getDatosSesion($id);
	  }else{
		$mensaje = "Algo mal piratilla";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarSesiones.php'";
                echo "</script>";
		return null;
   }
  }

  public static function getSesionesActividad($var)
  {
  	$modelo_gestionarSesiones = new m_gestionarSesiones();

    if($modelo_gestionarSesiones->comprobarSesionActividad($var))
    {
		return $modelo_gestionarSesiones->getDatosSesionesActividad($var);
	  }else{
		$mensaje = "La actividad no tiene sesiones publicadas";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_misActividades.php'";
                echo "</script>";
		return null;
   }
  }

  public static function getEsto($var){

	  $modelo_gestionarSesiones = new m_gestionarSesiones();
	if($modelo_gestionarSesiones->comprobarSesionesActividad($var))
    {
		return $modelo_gestionarSesiones->getDatosSesionesActividad($var);
	} else {
			$mensaje = "Esta actividad no tiene sesiones";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarActividades.php'";
                echo "</script>";
		return null;
		}
  }




  public static function reservarSesion(){
	$sesionID = $_POST['sesion'];
	$id = $_POST['dniU'];

	 $modelo_gestionarSesiones = new m_gestionarSesiones();

	 if((!$modelo_gestionarSesiones->comprobarReserva($id,$sesionID))){
		  $modelo_gestionarSesiones->reservaSesiones($id,$sesionID);
	  }else {
		$mensaje = "Ya tienes hecha una reserva para esta sesión";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_misActividades.php'";
                echo "</script>";
	}

  }


  public static function cancelarSesion()
  {
	$sesionID = $_POST['sesion'];
	$id = $_POST['dniU'];
	$modelo_gestionarSesiones = new m_gestionarSesiones();
		  $modelo_gestionarSesiones->cancelarReservaSesion($id,$sesionID);
  }

  public static function altaSesion()
  {
    //$id = $_POST['idSesion'];
    $date = $_POST['fecha'];
    $hour = $_POST['hora'];
    $places = $_POST['plazas'];
	  $acplaces =$_POST['acplazas'];
    $activity = $_POST['actividad'];
	  $monitor = $_POST['user'];

    $modelo_gestionarSesiones = new m_gestionarSesiones();

		  if ($acplaces > $places) {
        $mensaje = "Introduzca un numero de plazas actuales correcto";
                    echo "<script>";
                    echo "alert('$mensaje');";
                    echo "window.location = '../vistas/v_altaSesion.php?id=" .$activity."'";
                    echo "</script>";
		  }else{
        require_once '../modelos/m_gestionarUsuarios.php';

        $modelo_gestionarUsuarios = new m_gestionarUsuarios();

        $usr = $modelo_gestionarUsuarios->getDatosUsuario($monitor);

        if(($usr != null) && ($usr['tipo'] == "Entrenador"))
        {
          $modelo_gestionarSesiones->altaSesion($date, $hour,$places,$acplaces, $monitor, $activity);
        }
        else {
          $mensaje = "Introduzca un ID de entrenador correcto";
                      echo "<script>";
                      echo "alert('$mensaje');";
                      echo "window.location = '../vistas/v_altaSesion.php?id=" .$activity."'";
                      echo "</script>";
        }
		  }
      //$modelo_gestionarSesiones->altaSesion($date, $hour,$places,$acplaces, $hombre, $activity);
  }

  public static function bajaSesion()
  {
    $id = $_POST['idSesion'];

    $modelo_gestionarSesiones = new m_gestionarSesiones();
	   if($modelo_gestionarSesiones->comprobarSesion($id))
    {
		    $modelo_gestionarSesiones->bajaSesion($id);
    }else{
    $mensaje = "El ID introducido no corresponde a ninguna sesion. Introduzca un ID valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_bajaSesion.php'";
                echo "</script>";
	 }
  }

  public static function modificarSesion()
  {
  	$id = $_POST['actualizaridsesion'];
  	$fecha = $_POST['actualizarfecha'];
  	$hora = $_POST['actualizarhora'];
  	$places = $_POST['actualizarplazas'];
  	$acplaces = $_POST['actualizarplazasactual'];
	$user = $_POST['actualizardni'];
    $activity = $_POST['actualizaridactividad'];


  	$modelo_gestionarSesiones = new m_gestionarSesiones();
    if($modelo_gestionarSesiones->comprobarSesion($id))
    {
  	   $modelo_gestionarSesiones->modificarSesion($id, $fecha, $hora, $places, $acplaces, $user, $activity);
    }else{
      $mensaje = "El ID introducido no corresponde a ninguna sesion. Introduzca un ID valido";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_modificarSesion.php'";
                  echo "</script>";
    }
  }

  /*Mis reservas*/

  public static function getMisReservas(){
	  $identificacion= $_SESSION['userID'];
	  $modelo_gestionarSesiones = new m_gestionarSesiones();
	   return $modelo_gestionarSesiones -> getMisReservas($identificacion);
  }

  public static function devolverInscritos($sesion)
  {
    //$activity = $_GET['id'];

    $modelo_gestionarSesiones = new m_gestionarSesiones();

    return $modelo_gestionarSesiones-> devolverInscritos($sesion);
  }



}

?>
