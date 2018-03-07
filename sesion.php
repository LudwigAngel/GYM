<?php

  function iniciarSesion ($id, $tipo)   //Para abrir la sesion llamamos a esta funcion
  {
    session_start();
    $_SESSION['connected'] = true;                             //Iniciamos sesion.
    $_SESSION['userID'] = $id;
    $_SESSION['userType'] = $tipo;
  }

  function cerrarSesion ()      //Para cerrar la sesion llamamos a esta funcion
  {
    session_start();
    unset($_SESSION["userID"]);
    //unset($_SESSION["userType"]);
    unset($_SESSION["connected"]);

    session_destroy();
	
  }
?>
