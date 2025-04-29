<?php

class CerrarSesion
{
  public function cerrarSesion()
  {
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../../frontend/index.php');
    exit;
  }
}

$cerrarSesion = new CerrarSesion();
$cerrarSesion->cerrarSesion();
