<?php

require_once __DIR__ . '../../../servicios/databaseFactory.php';
require_once __DIR__ . '../../../servicios/databaseConnectionInterface.php';

class UsuarioCrearTabla
{
  private $db;

  public function crearTabla()
  {
    $this->db = DatabaseFactory::createDatabaseConnection('mysql');
    $conn = $this->db->connect();
    $sql = "CREATE TABLE IF NOT EXISTS  usuarios (
              id INT PRIMARY KEY AUTO_INCREMENT, 
              username VARCHAR(255) NOT NULL, 
              email VARCHAR(255) NOT NULL, 
              password VARCHAR(255) NOT NULL,
              rol_id INT NOT NULL,
              FOREIGN KEY (rol_id) REFERENCES roles(id))";

    $conn->query($sql);
    $conn->close();
  }
}
