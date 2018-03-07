<?php

require_once '../modelos/m_gestionarActividades.php';

if(isset($_POST['submit'])){
$var = $_GET['var'];

switch ($var) {
  case 0:
    c_actividad::publicarActividad();
    break;

  case 1:
    c_actividad::cancelarActividad();
    break;

  case 2:
   c_actividad::modificarActividad();
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
    echo "window.location = '../vistas/v_gestionarActividades.php'";
    echo "</script>";
    break;
}
}
class c_actividad
{

  public static function devolverActividad($id)//Esta funcion le pasamos un id para coger los datos de ese id
  {

    $modelo_gestionarActividades = new m_gestionarActividades();

    if($modelo_gestionarActividades->comprobarActividad($id))
    {
    return $modelo_gestionarActividades->getDatosActividad($id);
    }else{
    $mensaje = "El ID introducido no corresponde a ninguna actividad. Introduzca un ID valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarActividades.php'";
                echo "</script>";
    return null;
   }
  }


  public static function devolverDatosActividad()
  {
    $id = $_POST['idActividad'];

    $modelo_gestionarActividades = new m_gestionarActividades();

    if($modelo_gestionarActividades->comprobarActividad($id))
    {
    return $modelo_gestionarActividades->getDatosActividad($id);
    }else{
    $mensaje = "El ID introducido no corresponde a ninguna actividad. Introduzca un ID valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarActividades.php'";
                echo "</script>";
    return null;
   }
 }

  public static function getActividades(){
    $modelo_gestionarActividades = new m_gestionarActividades();
    return $modelo_gestionarActividades->getActividades();
  }

  public static function publicarActividad()
  {
    //$id = $_POST['idActividad'];
    $name = $_POST['nombreA'];
    $tipe = $_POST['tipo'];
    $des = $_POST['descripcion'];
    $place = $_POST['lugar'];

    $modelo_gestionarActividades = new m_gestionarActividades();

    //if(!$modelo_gestionarActividades->comprobarActividad($id))
    //{
      $modelo_gestionarActividades->publicarActividad($name,$tipe, $des, $place);
    /*}else {
      $mensaje = "El id de la actividad corresponde a otra ya en el sistema, /n Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_publicarActividad.php'";
                echo "</script>";
    }*/
  }

  public static function cancelarActividad()
  {
    $id = $_POST['idActividad'];
    $modelo_gestionarActividades = new m_gestionarActividades();
	if($modelo_gestionarActividades->comprobarActividad($id))
    {
    $modelo_gestionarActividades->cancelarActividad($id);
    $mensaje = "La Actividad ha sido eliminada";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarActividades.php'";
                echo "</script>";

	} else {
				$mensaje = "El id introducido no corresponde a ninguna Actividad, Introduzca un id valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarActividad.php'";
                echo "</script>";
      }
  }

  public static function modificarActividad()
    {
      $id = $_POST['actualizarid'];
      $nombre = $_POST['actualizarnombre'];
      $tipo = $_POST['actualizartipo'];
      $des = $_POST['actualizardescrip'];
      $lugar = $_POST['actualizarlugar'];

      $modelo_gestionarActividades = new m_gestionarActividades();
      if($modelo_gestionarActividades->comprobarActividad($id))
      {
         $modelo_gestionarActividades->modificarActividad($id,$nombre,$tipo,$des,$lugar);
      }else{
        $mensaje = "El ID introducido no corresponde a ninguna Actividad, Introduzca un id valido";
                    echo "<script>";
                    echo "alert('$mensaje');";
                    echo "window.location = '../vistas/v_gestionarActividades.php'";
                    echo "</script>";
      }
    }

}

?>
