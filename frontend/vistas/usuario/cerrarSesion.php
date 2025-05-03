<?php

require_once __DIR__ . '../../../../backend/DAOS/usuarioDAO.php';
require_once __DIR__ . '../../../../backend/servicios/databaseFactory.php';

$db = DatabaseFactory::createDatabaseConnection('mysql');
$usuarioDao = new UsuarioDAO();
$usuarioDao->cerrarSesion();

?>