<?php

require_once '../services/conexion.php';

class UsuarioModelo
{
  public $db;

  public function __construct()
  {
    $this->db = new Conexion();
  }

  public function getNombreTabla()
  {
    return 'usuarios';
  }

  public function getEsquemaTabla()
  {
    return "  id INT PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                rol_id INT NOT NULL,
                FOREIGN KEY (rol_id) REFERENCES roles(id)";
  }

  public function ExisteTabla()
  {
    $conn = $this->db->conectar();
    $sql = "SHOW TABLES LIKE '" . $this->getNombreTabla() . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $result->free();
      $conn->close();
      return true;
    } else {
      $conn->close();
      return false;
    }
  }

  public function crearTabla()
  {
    $conn = $this->db->conectar();
    $sql = "CREATE TABLE IF NOT EXISTS" . $this->getNombreTabla() . " ( " . $this->getEsquemaTabla() . " )";
    $conn->query($sql);
    $conn->close();
  }
}
