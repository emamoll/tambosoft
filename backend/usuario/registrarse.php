<?php

require_once '../controladores/usuario.php';

class Registrar
{
  public function registrarUsuario()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $rol_id = 2;

      $usuario = new Usuario();

      $usuario->crearUsuario($username, $password, $rol_id);
      echo "<script>
                alert('Usuario registrado correctamente');
                window.location.href = '../../frontend/index.php';
              </script>";
    } else {
      echo "<script>
            alert('Error al registrar el usuario:');
            window.location.href = '../../frontend/usuario/usuario.php';
          </script>";
      exit;
    }
  }
}

$registro = new Registrar();
$registro->registrarUsuario();



// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   $username = $_POST['username'];
//   $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
//   $rol_id = 2;

//   try {
//     $conexion = new Conexion();
//     $pdo = $conexion->conectar();

//     $sql = "INSERT INTO usuarios (username, password, rol_id) VALUES (:username, :password, :rol_id)";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([
//       'username' => $username,
//       'password' => $password,
//       'rol_id' => $rol_id
//     ]);

//     echo "<script>
//             alert('Usuario registrado correctamente');
//             window.location.href = '../../frontend/index.php';
//           </script>";
          
//   } catch (\Throwable $th) {
//     echo "<script>
//             alert('Error al registrar el usuario: " . addslashes($th->getMessage()) . "');
//             window.location.href = '../../frontend/usuario/usuario.php';
//           </script>";
//   }
// }
