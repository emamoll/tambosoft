<?php

require_once '../services/env.php';

class Conexion
{
  private $host;
  private $dbname;
  private $username;
  private $password;

  public function __construct()
  {
    $env = new Env();
    $this->host = $env->get('DB_HOST');
    $this->username = $env->get('DB_USERNAME');
    $this->password = $env->get('DB_PASSWORD');
    $this->dbname = $env->get('DB_NAME');
  }

  public function conectar()
  {
    try {
      $conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
      if ($conn->connect_error) {
        die("Error en la conexion: " . $conn->connect_error);
      } else {
        return $conn;
      }
    } catch (\Throwable $th) {
      echo "Error en la conexion" . $th->getMessage();
      exit;
    }
  }
}
