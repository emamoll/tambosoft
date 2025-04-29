<?php

class Logout
{
  public function cerrarSesion()
  {
    session_start();
    session_unset();
    session_destroy();
    echo "<script>
            alert('Debes iniciar sesion y validar tus credenciales');
          </script>";
    header('Refresh: 0; url=../../frontend/index.php');
    exit;
  }
}

$logout = new Logout();
$logout->cerrarSesion();
