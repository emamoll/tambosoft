<?php

require_once __DIR__ . '../../DAOS/usuarioDAO.php';

class UsuarioController
{
  private $usuarioDao;

  public function __construct()
  {
    $this->usuarioDao = new UsuarioDAO();
  }

  public function registrarUsuario($username, $email, $password, $rol_id, $token)
  {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $existeUsername = $this->usuarioDao->getUsuarioByUsername($username);
    $existeEmail = $this->usuarioDao->getUsuarioByEmail($email);

    if (!$existeUsername || !$existeEmail) {
      $this->usuarioDao->verificarRoles();
      $usuario = new Usuario(null, $username, $email, $hash, $rol_id, $token);
      return $this->usuarioDao->registrarUsuario($usuario);
    }

    return null;
  }

  public function loginUsuario($username, $password)
  {
    $usuario = $this->usuarioDao->getUsuarioByUsername($username);

    if ($usuario && password_verify($password, $usuario->getPassword())) {
      // Generar token
      $token = bin2hex(random_bytes(32));
      $usuario->setToken($token);

      // Guardar token en base de datos
      $this->usuarioDao->actualizarToken($usuario->getId(), $token);

      // Guardar token en la sesión
      $_SESSION['token'] = $token;

      return $usuario;
    }

    return null;
  }

  public function getUsuarioPorToken($token)
  {
    return $this->usuarioDao->getUsuarioPorToken($token);
  }
}
