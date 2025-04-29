<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambosoft: Iniciar sesión</title>
  <link rel="stylesheet" href="../frontend/css/estilos.css" />
</head>

<body>
  <div class="contenido row justify-content-center divCentral">
    <div class="row w-75 contenedor">
      <img src="img/logo.png" alt="Icono Tambosoft" id="logo">
    </div>
    <div class="wrapper">
      <div class="title">Inicia sesion</div>
      <form action="../backend/usuario/autenticacion.php" method="POST">
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
        if (isset($_GET['error']) && $_GET['error'] == 1) {
          echo "<p style='color:red'> Usuario y/o contraseña incorrectos </p>";
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