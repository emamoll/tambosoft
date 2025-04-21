<?php

$servername = "localhost";
$username = "root";
$password = "1234";
$basededatos = "gestion";
$tabla = "consumo";

// Crear la conexión con servidor
$conn = mysqli_connect($servername, $username, $password);
if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}


//crear base de datos en caso de no existir
$crearBase = "CREATE DATABASE IF NOT EXISTS gestion";
mysqli_query($conn, $crearBase);

//coneccion de base del servidor
$conne = mysqli_connect($servername, $username, $password, $basededatos);


//crear tabla en caso de no existir
$crearTabla = "CREATE TABLE IF NOT EXISTS $tabla(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    alimento VARCHAR(50) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    cantidad INT(50)NOT NULL
    )";

if (mysqli_query($conne, $crearTabla) != true) {
    echo "Error al crear la tabla: " . mysqli_error($conne);
}

?>