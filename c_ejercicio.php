<?php

require_once '../modelos/m_gestionarEjercicios.php';

if(isset($_POST['submit'])){
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      c_ejercicio::altaEjercicio();
      break;

      case 1:
      c_ejercicio::bajaEjercicio();
      break;

      case 2:
        c_ejercicio::modificarEjercicio();
        break;

      case 3:
        session_start();
        c_ejercicio::contarEjercicio();
        break;
     /*
     *
     *Ponemos la opcion que sea en la vista como Get por ejemplo:
     *<form method="post" action="../controladores/c_ejercicio.php?var=0#" >
     *c_ejercicio.php?var= a lo que sea i ponemos el numero en el case y .
     *
     */

    default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/v_gestionarEjercicios.php'";
      echo "</script>";
      break;
  }
}
class c_ejercicio
{

  public static function devolverDatosEjercicio($id)
  {

  	$modelo_gestionarEjercicios = new m_gestionarEjercicios();

    if($modelo_gestionarEjercicios->comprobarEjercicio($id))
    {
		return $modelo_gestionarEjercicios->getDatosEjercicio($id);
  	}else{
  		$mensaje = "El DNI introducido no corresponde a ningun ejercicio. Introduzca un DNI valido";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_gestionarEjercicios.php'";
                  echo "</script>";
  		return null;
  	}
}


public static function devolverDatosEjercicios()
  {

  	$modelo_gestionarEjercicios = new m_gestionarEjercicios();

		return $modelo_gestionarEjercicios->getDatosEjercicios();

 }

  public static function altaEjercicio()
  {
    $id = $_POST['ejercicio'];
    $name = $_POST['nombreEjercicio'];
    $des = $_POST['descripcion'];
    $peso = $_POST['peso'];
    $rep = $_POST['repeticiones'];
    $tipo = $_POST['tipo'];
    $tiempo = $_POST['tiempo'];

    //Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
    if($_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/gif"){

      //Creamos ruta donde guardamos la imagen yle damos nombre
               $ruta = "../images/ejercicios";
                $archivo = file_get_contents($_FILES['imagen']['tmp_name']);
                $nombreArchivo = $_FILES['imagen']['name'];
                move_uploaded_file($archivo, $ruta."/".$nombreArchivo);

      $modelo_gestionarEjercicios = new m_gestionarEjercicios();

        if(!$modelo_gestionarEjercicios->comprobarEjercicio($id))
          {
            $modelo_gestionarEjercicios->altaEjercicio($id, $name ,$des, $peso, $rep, $nombreArchivo, $tipo, $tiempo);
          }else {
             $mensaje = "El ID introducido tiene asociado ya un ejercicio. Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarEjercicios.php'";
                echo "</script>";
            }
    }else{
           $mensaje = "El Formato de imagen no es valido. Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarEjercicios.php'";
                echo "</script>";
          }
  }

  public static function bajaEjercicio()
  {
    $id = $_POST['idEjercicio'];
    $modelo_gestionarEjercicios = new m_gestionarEjercicios();
    if($modelo_gestionarEjercicios->comprobarEjercicio($id))
    {
      $modelo_gestionarEjercicios->bajaEjercicio($id);
	  $mensaje = "El ejercicio ha sido eliminado";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarEjercicios.php'";
                echo "</script>";
    }else {
      $mensaje = "El Id introducido no corresponde a ningun ejercicio, revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_bajaEjercicio.php'";
                echo "</script>";
    }
  }

  public static function modificarEjercicio()
  {
  	$id = $_POST['actualizarid'];
  	$nombre = $_POST['actualizarnombre'];
  	$descripcion = $_POST['actualizardes'];
  	$peso = $_POST['actualizarpeso'];
    $rep = $_POST['actualizarrepeticiones'];
    $time = $_POST['actualizartiempo'];
    $tipo = $_POST['actualizartipo'];

    //Comprobamos el tipo de la Imagen, SI es correcto, obtenemos los datos de la ruta y de la imagen
    if($_FILES['actualizarimagen']['type']=="image/jpeg" || $_FILES['actualizarimagen']['type']=="image/png" || $_FILES['actualizarimagen']['type']=="image/jpg" || $_FILES['actualizarimagen']['type']=="image/gif"){

      //Creamos ruta donde guardamos la imagen yle damos nombre
               $ruta = "../images/ejercicios";
                $archivo = file_get_contents($_FILES['actualizarimagen']['tmp_name']);
                $nombreArchivo = $_FILES['actualizarimagen']['name'];
                move_uploaded_file($archivo, $ruta."/".$nombreArchivo);


  	$modelo_gestionarEjercicios = new m_gestionarEjercicios();
    if($modelo_gestionarEjercicios->comprobarEjercicio($id))
    {
  	   $modelo_gestionarEjercicios->modificarEjercicio($id,$nombre,$descripcion,$peso, $rep, $time, $nombreArchivo, $tipo);
    }else{
      $mensaje = "El ID introducido no corresponde a ningun ejercicio. Introduzca un DNI valido";
                  echo "<script>";
                  echo "alert('$mensaje');";
                  echo "window.location = '../vistas/v_gestionarEjercicios.php'";
                  echo "</script>";
          }
  }else{
           $mensaje = "El Formato de imagen no es valido. Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarEjercicios.php'";
                echo "</script>";
      }
  }

  public static function contarEjercicio()
  {

  	$dni = $_SESSION['userID'];
    if (isset ($_POST['completados']))
      $ejercicios = $_POST['completados'];
    else {
      $ejercicios = null;
    }
    $tabla = $_GET['idTabla'];

  	$modelo_gestionarEjercicios = new m_gestionarEjercicios();

  	$modelo_gestionarEjercicios->contarEjercicio($dni,$ejercicios, $tabla);

  }

  public static function getVecesEjercicio($idEjercicio)
  {
  	$dni = $_SESSION['userID'];

    $modelo_gestionarEjercicios = new m_gestionarEjercicios();

  	return $modelo_gestionarEjercicios->getVecesEjercicio($dni,$idEjercicio);
  }
}

?>
