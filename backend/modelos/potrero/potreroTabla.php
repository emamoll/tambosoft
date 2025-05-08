<?php

require_once __DIR__ . '../../../servicios/databaseFactory.php';
require_once __DIR__ . '../../../servicios/databaseConnectionInterface.php';

class PotreroCrearTabla{
  private $db;

  public function crearTablaPotrero(){
    $this->db = DatabaseFactory::createDatabaseConnection('mysql');
    $conn = $this->db->connect();
    $sql = "CREATE TABLE IF NOT EXISTS potreros (
              id INT PRIMARY KEY AUTO_INCREMENT,
              nombre VARCHAR(255) NOT NULL UNIQUE,
              superficie VARCHAR(255) NOT NULL,
              pastura VARCHAR(255) NOT NULL,
              campo_id INT NOT NULL,
              FOREIGN KEY (campo_id) REFERENCES campos(id))";
    $conn->query($sql);
    $conn->close();
  }
}