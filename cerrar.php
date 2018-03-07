<?php
session_start();
    unset($_SESSION["userID"]);
    //unset($_SESSION["userType"]);
    unset($_SESSION["connected"]);

    session_destroy();
	header("Location: ../vistas/v_principal.php");
	?>