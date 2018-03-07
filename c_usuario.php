<?php

require_once '../modelos/m_gestionarUsuarios.php';
require_once '../funciones/sesion.php';

if(isset($_POST['submit'])){
  $var = $_GET['var'];

  switch ($var) {
    case 0:
      c_usuario::altaUsuario();
      break;

    case 1:
      c_usuario::bajaUsuario();
      break;

    case 2:
     c_usuario::modificarUsuario();
     break;

     case 3:
  		c_usuario::loginUsuario();
  		break;

    case 4:
      c_usuario::logOutUsuario();
      break;

    case 5:
      c_usuario::modificarPerfil();
      break;

	  case 6:
      c_usuario::eliminarHistorialDeportista();
      break;

    case 7:
      c_usuario::añadirComentarioEjercicio();
      break;
     /*
     *
     *Ponemos la opcion que sea en la vista como Get por ejemplo:
     *<form method="post" action="../controladores/c_usuario.php?var=0#" >
     *c_usuario.php?var= a lo que sea i ponemos el numero en el case y .
     *
     */

    default:
      echo "<script>";
      echo "alert('No se reconoce la accion del metodo GET');";
      echo "window.location = '../vistas/v_gestionarUsuarios.php'";
      echo "</script>";
      break;
  }
}

class c_usuario
{

	public static function loginUsuario()
	{
	   $id = $_POST['dni'];
     $pass = $_POST['contrasena'];
	   $tipe = $_POST['tipo'];

     $encriptada = md5($pass);

    $modelo_gestionarUsuarios = new m_gestionarUsuarios();

    if($modelo_gestionarUsuarios->comprobarUsuarioLogin($id, $encriptada, $tipe))
    {
      iniciarSesion($id, $tipe);  // require_once '../funciones/sesion.php';
    }else {
      $mensaje = "Error en los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarUsuarios.php'";
                echo "</script>";
    }
	}

  public static function logOutUsuario()
	{
	   cerrarSesion();   // require_once '../funciones/sesion.php';
	    $mensaje = "Error en los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_principal.php'";
                echo "</script>";

	}

  public static function devolverUsuario($dni)//Esta funcion le pasamos un dni para coger los datos de ese dni
  {

    $modelo_gestionarUsuarios = new m_gestionarUsuarios();

    if($modelo_gestionarUsuarios->comprobarUsuario($dni))
    {
      return $modelo_gestionarUsuarios->getDatosUsuario($dni);
    }else{
    $mensaje = "El DNI introducido no corresponde a ningun usuario/Deportista /n Introduzca un DNI valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarUsuarios.php'";
                echo "</script>";
    return null;
   }
  }

  public static function getUsuarios(){
    $modelo_gestionarUsuarios = new m_gestionarUsuarios();
    return $modelo_gestionarUsuarios->getUsuarios();
  }

  public static function getEntrenadores(){
    $modelo_gestionarUsuarios = new m_gestionarUsuarios();
    return $modelo_gestionarUsuarios->getEntrenadores();
  }

  public static function getDeportistas(){
    $modelo_gestionarUsuarios = new m_gestionarUsuarios();
    return $modelo_gestionarUsuarios->getDeportistas();
  }

  public static function getDeportistasGeneral(){
    $modelo_gestionarUsuarios = new m_gestionarUsuarios();
    return $modelo_gestionarUsuarios->getDeportistasGeneral();
  }

  public static function getDeportistasPEF(){
    $modelo_gestionarUsuarios = new m_gestionarUsuarios();
    return $modelo_gestionarUsuarios->getDeportistasPEF();
  }

  public static function getHistorialDeportistas(){

    //session_start();

    $dniUsuario = $_SESSION['userID'];
    $modelo_gestionarUsuarios = new m_gestionarUsuarios();
    return $modelo_gestionarUsuarios->getHistorialDeportistas($dniUsuario);
  }

  public static function altaUsuario()
  {
    $identificacion = $_POST['dni'];
    $nombre = $_POST['usuario'];
    $pass = $_POST['contrasena'];
    $correo = $_POST['email'];
    $surname = $_POST['apellidos'];
	  $tipe = $_POST['tipo'];
    $tipoD = $_POST['tipoDeportista'];

    $encriptada=md5($pass);

    $modelo_gestionarUsuarios = new m_gestionarUsuarios();

    if(!$modelo_gestionarUsuarios->comprobarUsuario($identificacion))
    {
      $modelo_gestionarUsuarios->altaUsuario($identificacion, $nombre,$encriptada, $correo, $surname,$tipe, $tipoD);
    }else {
      $mensaje = "El usuario con el DNI introducido ya esta dado de alta en el sistema, /n Revise los datos";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarUsuarios.php'";
                echo "</script>";
    }
  }

  public static function bajaUsuario()
  {
    $identificacion = $_POST['dni'];

    $modelo_gestionarUsuarios = new m_gestionarUsuarios();
	if($modelo_gestionarUsuarios->comprobarUsuario($identificacion))
    {
    $modelo_gestionarUsuarios->bajaUsuario($identificacion);

	  } else {
				$mensaje = "El DNI introducido no corresponde a ningun usuario/Deportista /n Introduzca un DNI valido";
                echo "<script>";
                echo "alert('$mensaje');";
                echo "window.location = '../vistas/v_gestionarUsuarios.php'";
                echo "</script>";
    }
  }

  public static function modificarUsuario()
    {
      $nombre = $_POST['actualizarnombre'];
      $pass = $_POST['actualizarpass'];
      $email = $_POST['actualizaremail'];
      $dni = $_POST['actualizardni'];
      $apellidos = $_POST['actualizarapellidos'];
	    $tipe = $_POST['actualizartipo'];
      $tipoD = $_POST['actualizartipoD'];

      $encriptada=md5($pass);

      $modelo_gestionarUsuarios = new m_gestionarUsuarios();
      if($modelo_gestionarUsuarios->comprobarUsuario($dni))
      {
         $modelo_gestionarUsuarios->modificarUsuario($nombre,$encriptada,$email,$dni,$apellidos, $tipe, $tipoD);
      }else{
        $mensaje = "El DNI introducido no corresponde a ningun usuario/Deportista /n Introduzca un DNI valido";
                    echo "<script>";
                    echo "alert('$mensaje');";
                    echo "window.location = '../vistas/v_gestionarUsuarios.php'";
                    echo "</script>";
      }
    }

    public static function modificarPerfil()
    {
      $nombre = $_POST['actualizarnombre'];
      $pass = $_POST['actualizarpass'];
      $email = $_POST['actualizaremail'];
      $dni = $_POST['actualizardni'];
      $apellidos = $_POST['actualizarapellidos'];
      $tipe = $_POST['actualizartipo'];
      $tipoD = $_POST['actualizartipoD'];

      $encriptada=md5($pass);

      $modelo_gestionarUsuarios = new m_gestionarUsuarios();
      if($modelo_gestionarUsuarios->comprobarUsuario($dni))
      {
         $modelo_gestionarUsuarios->modificarPerfil($nombre,$encriptada,$email,$dni,$apellidos, $tipe, $tipoD);
      }else{
        $mensaje = "El DNI introducido no corresponde a ningun usuario/Deportista /n Introduzca un DNI valido";
                    echo "<script>";
                    echo "alert('$mensaje');";
                    echo "window.location = '../vistas/v_verPerfil.php'";
                    echo "</script>";
      }
    }

	public static function eliminarHistorialDeportista()
    {
      session_start();

      $dniDeportista = $_SESSION['userID'];

      $modelo_gestionarUsuarios = new m_gestionarUsuarios();
      return $modelo_gestionarUsuarios->eliminarHistorialDeportista($dniDeportista);
    }

    public static function añadirComentarioEjercicio()
    {

          $idTabla = $_POST['idTabla'];
          $idEjercicio = $_POST['idEjercicio'];
          $dni = $_POST['dni'];
          $comentario = $_POST['comentario'];

          $modelo_gestionarUsuarios = new m_gestionarUsuarios();
         return $modelo_gestionarUsuarios->añadirComentarioEjercicio($comentario,$idEjercicio,$dni,$idTabla);

  }

  public static function getComentarios($idEjercicio,$dni)
  {
      $modelo_gestionarUsuarios = new m_gestionarUsuarios();

      return $modelo_gestionarUsuarios->getComentarios($idEjercicio,$dni);
  }


}

?>
