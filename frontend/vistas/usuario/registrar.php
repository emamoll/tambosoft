<?php

require_once __DIR__ . '../../../../backend/DAOS/usuarioDAO.php';
require_once __DIR__ . '../../../../backend/modelos/usuario/usuario.php';

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
  $usuarioDao = new UsuarioDAO();
  $usuario = new Usuario(null, $_POST['username'], $_POST['email'], $_POST['password'], 2);
  if ($usuarioDao->crearUsuario($usuario)) {
    header('Location: ../../../index.php');
  } else {
    $error = 'Error al registrar el usuario';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tambosoft: Registrar usuario</title>
  <link rel="stylesheet" href="../../css/estilos.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="wrapper">
    <div class="title">Registrar usuario</div>
    <form action="registrar.php" method="POST">
      <div class="field">
        <input type="text" id="username" name="username" required>
        <label for="username">Nombre de usuario</label>
      </div>
      <div class="field">
        <input type="text" id="email" name="email" required>
        <label for="email">Email</label>
      </div>
      <div class="field">
        <input type="password" id="password" name="password" required>
        <label for="password">Contraseña</label>
      </div>
      <div class="field">
        <input type="submit" value="Registrar">
      </div>
      <?php if (isset($error)) echo "<p style='color: red'>$error</p>"; ?>
      <div class="signup-link">
        <a href="../index.php">Iniciar sesión</a>
      </div>
    </form>
  </div>
</body>

</html>