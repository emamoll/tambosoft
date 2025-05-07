<?php

require_once __DIR__ . '../../../../backend/controladores/usuarioController.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $rol_id = 1; // 1 para admin, 2 para usuario

  if (!empty($username) && !empty($email) && !empty($password)) {
    $token = bin2hex(random_bytes(32));
    $controller = new UsuarioController();
    $registrado = $controller->registrarUsuario($username, $email, $password, $rol_id, $token);

    if ($registrado) {
      $mensaje = "Registro exitoso";
      header('Location: ../../../index.php');
    } else {
      $mensaje = "El usuario o el correo ya están registrados.";
    }
  } else {
    $mensaje = "Todos los campos son obligatorios.";
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
    <form method="POST">
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
        <button type="submit" class="botonIniciar">Registrarse</button>
      </div>
      <div class="signup-link">
        <a href="../index.php">Iniciar sesión</a>
      </div>
      <?php if (!empty($mensaje)) echo "<p>$mensaje</p>"; ?>
    </form>
  </div>
</body>

</html>