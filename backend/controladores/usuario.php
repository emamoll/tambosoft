<?php

require_once '../modelos/usuario/usuario.modelo.php';

class Usuario
{
  private $modeloUsuario;

  public function __construct()
  {
    $this->modeloUsuario = new UsuarioModelo();

    if (!$this->modeloUsuario->ExisteTabla()) {
      $this->modeloUsuario->crearTabla();
    }
  }

  public function crearUsuario($username, $password, $rol_id)
  {
    $conn = $this->modeloUsuario->db->conectar();
    $sql = " INSERT INTO " . $this->modeloUsuario->getNombreTabla() . "(username, password, rol_id) VALUES (?, ?, ?)  ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $password, $rol_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  }
}
