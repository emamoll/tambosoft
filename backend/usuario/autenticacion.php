<?php

require '../services/conexion.php';

class Autenticacion
{
    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
    }

    public function verificarUsuario($username, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $password_hash, $rol_id);
            $stmt->fetch();

            if (password_verify($password, $password_hash)) {
                return array('exito' => true, 'rol_id' => $rol_id);
            } else {
                return array('exito' => false, 'mensaje' => 'Contraseña incrrecta');
            }
        } else {
            return array('exito' => false, 'mensaje' => 'Usuario no encontrado');
        }
    }

    public function autenticar($username, $password)
    {
        $resultado = $this->verificarUsuario($username, $password);
        if ($resultado['exito']) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['rol_id'] = $resultado['rol_id'];

            if($resultado['rol_id'] == 1){
                header("Location: ../../frontend/usuario/admin.php");
            }elseif($resultado['rol_id'] == 2){
                header("Location: ../../frontend/usuario/usuario.php");
            }else{
                echo "Rol no valido";
            }
        }
        else {
            echo $resultado['mensaje'];
            header("Location: ../../frontend/index.php?error=1");
        }
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $autenticacion = new Autenticacion();
    $autenticacion->autenticar($_POST['username'], $_POST['password']);
}
