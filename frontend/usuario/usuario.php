<?php

require_once '../../backend/usuario/autorizacion.php';

$autorizacion = new Autorizacion();
$autorizacion->validarSesion(2);

?>

<script>
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.href = '../../backend/usuario/logout.php';
        }
    };
</script>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tambosoft: Home</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
</head>

<body>
    <div class="sidebar">
        <h2>Rol: <?php echo $_SESSION['rol_id']; ?></h2>
        <h3>Bienvenido <?php echo $_SESSION['username']; ?></h3>
        <a href="../../backend/usuario/cerrarSesion.php">Cerrar sesión</a>
    </div>
</body>

</html>