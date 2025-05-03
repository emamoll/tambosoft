<?php

session_start();
require_once __DIR__ . '../backend/DAOS/usuarioDAO.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
  $usuarioDao = new UsuarioDAO();
  $usuario = $usuarioDao->getUsuarioByUsername($_POST['username']);
  if ($usuario && password_verify($_POST['password'], $usuario->getPassword())) {
    $_SESSION['username'] = $usuario->getUsername();
    $_SESSION['rol_id'] = $usuario->getRol_id();
    if($usuario->getRol_id() == 1){
      header('Location: frontend/vistas/usuario/adminHome.php');
    }elseif($usuario->getRol_id() == 2){
      header('Location: frontend/vistas/usuario/usuarioHome.php');
    }else{
      echo ("Usted no esta autorizado");
    }
  } else {
    $error = "Usuario y/o contraseña incorrectos";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambosoft: Iniciar sesión</title>
  <link rel="icon" href="frontend/img/logo2.png" type="image/png">
  <link rel="stylesheet" href="frontend/css/estilos.css" />
</head>

<body>
  <div class="contenido row justify-content-center">
    <div class="row w-75 contenedor">
      <img src="frontend/img/logo2.png" alt="Icono Tambosoft" id="logo">
    </div>
    <div class="wrapper divCentral">
      <div class="title">Inicia sesion</div>
      <form action="index.php" method="POST">
        <div class="field">
          <input type="text" required name="username" id="username">
          <label>Usuario</label>
        </div>
        <div class="field">
          <input type="password" required name="password" autocomplete="off" id="password">
          <label>Contraseña</label>
        </div>
        <!-- <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Recordar</label>
                </div>
                <div class="pass-link"><a href="#">Olvide mi contraseña</a></div>
            </div> -->
        <br>
        <?php
        if (isset($error)) {
          echo "<p style='color:red'> $error </p>";
        }
        ?>
        <div class="field">
          <input type="submit" value="Iniciar sesión">
        </div>
      </form>
    </div>
  </div>
</body>

</html>