<?php

require_once __DIR__ . '../../servicios/databaseFactory.php';
require_once __DIR__ . '../../modelos/usuario/usuarioTabla.php';
require_once __DIR__ . '../../modelos/usuario/usuarioModelo.php';

class UsuarioDAO
{
  private $db;
  private $conn;
  private $crearTabla;

  public function __construct()
  {
    $this->db = DatabaseFactory::createDatabaseConnection('mysql');
    $this->crearTabla = new UsuarioCrearTabla($this->db);
    $this->crearTabla->crearTablaRoles();
    $this->crearTabla->crearTablaUsuarios();
    $this->conn = $this->db->connect();
  }

  public function getAllUsuarios()
  {
    $sql = "SELECT * FROM usuarios";
    $result = $this->conn->query($sql);

    if (!$result) {
      die("Error en la consulta: " . $this->conn->error);
    }

    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
      $usuarios[] = new Usuario($row['id'], $row['username'], $row['email'], $row['password'], $row['rol_id'], $row['token']);
    }

    return $usuarios;
  }

  public function getUsuarioById($id)
  {
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows() === 0) {
      return null;
    }

    $stmt->bind_result($id, $username, $email, $password, $rol_id, $token);
    $stmt->fetch();

    return new Usuario($id, $username, $email, $password, $rol_id, $token);
  }

  public function getUsuarioByUsername($username)
  {
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows() === 0) {
      return null;
    }

    $stmt->bind_result($id, $username, $email, $password, $rol_id, $token);
    $stmt->fetch();

    return new Usuario($id, $username, $email, $password, $rol_id, $token);
  }

  public function getUsuarioByEmail($email)
  {
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows() === 0) {
      return null;
    }

    $stmt->bind_result($id, $username, $email, $password, $rol_id, $token);
    $stmt->fetch();

    return new Usuario($id, $username, $email, $password, $rol_id, $token);
  }

  public function getUsuarioPorToken($token)
  {
    $sql = "SELECT id, username, email, password, rol_id, token FROM usuarios WHERE token = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) return null;

    $stmt->bind_result($id, $username, $email, $password, $rol_id, $token);
    $stmt->fetch();

    return new Usuario($id, $username, $email, $password, $rol_id, $token);
  }

  public function insertarRoles()
  {
    $sql = "INSERT INTO roles (nombre) VALUES (?)";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
      echo "Error en la consulta";
      echo $this->conn->error;
      exit;
    }
    $rol1 = 'Administrador';
    $rol2 = 'Usuario';
    $stmt->bind_param("s", $rol1);
    $stmt->execute();
    $stmt->bind_param("s", $rol2);
    $stmt->execute();
    $this->conn->close();
  }

  public function verificarRoles()
  {
    $sql = "SELECT COUNT(*) as count FROM roles WHERE nombre IN ('Administrador', 'Usuario')";
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['count'] < 2) {
      $this->insertarRoles();
    }
  }

  public function registrarUsuario(Usuario $u)
  {
    $sql = "INSERT INTO usuarios (username, email, password, rol_id, token) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $us = $u->getUsername();
    $e = $u->getEmail();
    $p = $u->getPassword();
    $r = $u->getRol_id();
    $t = $u->getToken();
    $stmt->bind_param("sssis", $us, $e, $p, $r, $t);

    return $stmt->execute();
  }

  public function loginUsuario($username, $password)
  {
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($password, $usuario['password'])) {
      $token = bin2hex(random_bytes(32));
      $this->actualizarToken($usuario['id'], $token);
      return ['usuario' => $usuario, 'token' => $token];
    }

    return null;
  }

  public function actualizarToken($id, $token)
  {
    $sql = "UPDATE usuarios SET token = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("si", $token, $id);
    $stmt->execute();
  }
}
