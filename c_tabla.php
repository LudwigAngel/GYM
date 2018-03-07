<?php

require_once '../modelos/m_gestionarTablas.php';

if(isset($_POST['submit']))
{
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      c_tabla::crearTabla();
      break;

    case 1:
      c_tabla::eliminarTabla();
      break;

    case 2:
      c_tabla::modificarTabla();
      break;

    case 3:
    c_tabla::asignarDeportistaTDU();
    break;

    case 4:
    c_tabla::desasignarDeportistaTDU();
    break;

    case 5:
    c_tabla::asignarDeportistaPEF();
    break;

    case 6:
    c_tabla::desasignarDeportistaPEF();
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
      echo "window.location = '../vistas/v_gestionarTablas.php'";
      echo "</script>";
      break;
  }
}
class c_tabla
{
	public static function devolverDatosTabla($id)
  {
  	$modelo_gestionarTablas = new m_gestionarTablas();

    if($modelo_gestionarTablas->comprobarTabla($id))
    {
		    return $modelo_gestionarTablas->getDatosTabla($id);
  	}else{
  		$mensaje = "El ID introducido no corresponde a ninguna tabla. Introduzca un ID valido";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_modificarTabla.php'";
                  echo "</script>";
  		return null;
  	}
  }

  public static function getDeportistasAsignados($id){
    $modelo_gestionarTablas = new m_gestionarTablas();
     return $modelo_gestionarTablas->getDeportistasAsignados($id);

  }

  public static function desasignarDeportistaTDU(){

      $deportista = $_POST['DNI'];
        $idTabla = $_POST['idTabla'];


    $modelo_gestionarTablas = new m_gestionarTablas();

    $eliminarDeportistaAsignado = $modelo_gestionarTablas->borrarDeportistaAsignadoTabla($idTabla,$deportista);


  }

  public static function desasignarDeportistaPEF(){

      $deportista = $_POST['DNI'];
        $idTabla = $_POST['idTabla'];


    $modelo_gestionarTablas = new m_gestionarTablas();

    $eliminarDeportistaAsignado = $modelo_gestionarTablas->borrarDeportistaAsignadoTablaPEF($idTabla,$deportista);

  }

  public static function asignarDeportistaTDU(){

      $deportista = $_POST['DNI'];
          $id = $_POST['idTabla'];

    $modelo_gestionarTablas = new m_gestionarTablas();
    if($modelo_gestionarTablas->comprobarTabla($id))
    {
       $modelo_gestionarTablas->asignarDeportistaTabla($id, $deportista);

        $mensaje = "Usuario asignado";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_asignarTabla.php?id=$id'";
                  echo "</script>";
    }else{
      $mensaje = "El ID introducido no corresponde a ninguna tabla, revise los datos";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_gestionarTablas.php?id=$id'";
                  echo "</script>";
    }
  }

  public static function asignarDeportistaPEF(){

      $deportista = $_POST['DNI'];
          $id = $_POST['idTabla'];

    $modelo_gestionarTablas = new m_gestionarTablas();
    if($modelo_gestionarTablas->comprobarTabla($id))
    {
       $modelo_gestionarTablas->asignarDeportistaTabla($id, $deportista);

        $mensaje = "Usuario asignado";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_asignarTablaPEF.php?id=$id'";
                  echo "</script>";
    }else{
      $mensaje = "El ID introducido no corresponde a ninguna tabla, revise los datos";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_gestionarTablas.php'";
                  echo "</script>";
    }
  }

  public static function getTablas(){
    $modelo_gestionarTablas = new m_gestionarTablas();
    return $modelo_gestionarTablas->getTablas();
  }

  public static function getTabla($id){
    $modelo_gestionarTablas = new m_gestionarTablas();
    return $modelo_gestionarTablas->getTabla($id);
  }

  public static function devolverDatosEjercicioTabla($id){
          $modelo_gestionarTablas = new m_gestionarTablas();
          return $modelo_gestionarTablas->devolverDatosEjercicioTabla($id);
  }

	public static function crearTabla()
  {
    $id = $_POST['idTabla'];
    $nombre = $_POST['nombre'];
    $tipe = $_POST['tipo'];
    $ins = $_POST['instrucciones'];
    $lista = $_POST['lista'];


    $modelo_gestionarTablas = new m_gestionarTablas();
    if(!$modelo_gestionarTablas->comprobarTabla($id))
    {
      $modelo_gestionarTablas->crearTabla($id, $nombre,$tipe, $ins);
      foreach ($lista as $ejercicio) {
        $asignarEjercicioTabla = $modelo_gestionarTablas::tablaTieneEjercicio($ejercicio, $id);
      }
    }else {
      $mensaje = "En el sistema ya existe un tabla con ese ID. Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarTablas.php'";
                echo "</script>";
    }
  }

  public static function eliminarTabla(){
	  $id = $_POST['idTabla'];

    $modelo_gestionarTablas = new m_gestionarTablas();
	if($modelo_gestionarTablas->comprobarTabla($id))
    {
		$modelo_gestionarTablas->eliminarTabla($id);
	}else{
		$mensaje = "El ID introducido no corresponde a ninguna Tabla, introduzca un ID valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_eliminarTabla.php'";
                echo "</script>";
	}
  }



  public static function modificarTabla()
  {
  	$id = $_POST['actualizaridTabla'];
    $nombre = $_POST['actualizarnombreTabla'];
    $tipe = $_POST['actualizartipo'];
    $ins = $_POST['actualizarinstrucciones'];
    $lista = $_POST['actualizarlista'];



  	$modelo_gestionarTablas = new m_gestionarTablas();
    if($modelo_gestionarTablas->comprobarTabla($id))
    {
  	   $modelo_gestionarTablas->modificarTabla($id,$nombre,$tipe,$ins);

       $modelo_gestionarTablas->borrarEjersTabla($id);

       foreach ($lista as $ejercicio) {
        $modelo_gestionarTablas->modificartablaTieneEjercicio($ejercicio, $id);
      }

    }else{
      $mensaje = "El ID introducido no corresponde a ninguna tabla, revise los datos";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_modificarTabla.php'";
                  echo "</script>";
    }
  }

  public static function getTablasDeportista()
  {
    $dni = $_SESSION['userID'];
    $modelo_gestionarTablas = new m_gestionarTablas();
		return $modelo_gestionarTablas->getTablasDeportista($dni);
  }

}
?>
