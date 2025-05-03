<?php

require_once __DIR__ . '../../servicios/databaseFactory.php';
require_once __DIR__ . '../../modelos/usuario/usuarioTabla.php';
require_once __DIR__ . '../../modelos/usuario/usuario.php';

class UsuarioDAO
{
  private $db;
  private $crearTabla;

  public function __construct()
  {
    $this->db = DatabaseFactory::createDatabaseConnection('mysql');
    $this->crearTabla = new UsuarioCrearTabla($this->db);
    $this->crearTabla->crearTabla();
  }

  public function crearUsuario(Usuario $usuario)
  {
    $conn = $this->db->connect();
    $existeUsername = $this->getUsuarioByUsername($usuario->getUsername());
    $existeEmail = $this->getUsuarioByEmail($usuario->getEmail());

    if ($existeUsername || $existeEmail) {
      $conn->close();

      return false;
    }

    $sql = "INSERT INTO usuarios (username, email, password, rol_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $usuario->getUsername(), $usuario->getEmail(), password_hash($usuario->getPassword(), PASSWORD_DEFAULT), $usuario->getRol_id());
    $stmt->execute();
    $conn->close();

    if ($stmt->affected_rows > 0) {
      return true;
    } else {
      throw new Exception('Error al crear el usuario');
    }
  }

  public function getUsuarioByUsername($username)
  {
    $conn = $this->db->connect();
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql);
    $usuario = null;

    if ($row = $result->fetch_assoc()) {
      $usuario = new Usuario($row['id'], $row['username'], $row['email'], $row['password'], $row['rol_id']);
    }

    $conn->close();

    return $usuario;
  }

  public function getUsuarioByEmail($email)
  {
    $conn = $this->db->connect();
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);
    $usuario = null;

    if ($row = $result->fetch_assoc()) {
      $usuario = new Usuario($row['id'], $row['username'], $row['email'], $row['password'], $row['rol_id']);
    }

    $conn->close();

    return $usuario;
  }

  public function cerrarSesion(){
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../../../index.php');
  }
}
