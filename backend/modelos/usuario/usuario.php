<?php

class Usuario
{
  private $id;
  private $username;
  private $email;
  private $password;
  private $rol_id;

  public function __construct($id = null, $username = null, $email = null, $password = null, $rol_id = null)
  {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->rol_id = $rol_id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getRol_id()
  {
    return $this->rol_id;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function setRol_id($rol_id)
  {
    $this->rol_id = $rol_id;
  }
}
