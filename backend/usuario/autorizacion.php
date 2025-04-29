<?php

class Autorizacion
{
  public function verificarSesion()
  {
    session_start();
    if (!isset($_SESSION['username'])) {
      echo "<script>
              alert('Debes iniciar sesion y validar tus credenciales');
            </script>";
      echo "<script>
              location.assign('../../frontend/index.php');
            </script>";
      exit();
    }
  }

  public function verificarRol($rol_id)
  {
    if ($_SESSION['rol_id'] != $rol_id) {
      echo "<script>
              alert('No tiene autrizacion para acceder aquis');
            </script>";
      echo "<script>
              location.assign('../../frontend/index.php');
            </script>";
      exit();
    }
  }

  public function validarSesion($rol_id)
  {
    $this->verificarSesion();
    $this->verificarRol($rol_id);
  }
}
