<?php

/* La conexión a la Base de Datos simpere debe de estar en un archivo independiente 

    mysqli_connect -> Instrucción que nos permite conectarnos a la Base de Datos mediante PHP

*/

/* $conn -> Variable que contiene la instrucción para conectar con la BD, la variable debe contener 4 parámetros: 

    1º Dirección del servidor donde está alojada nuestra Base de Datos "localhost" (Si tienes un hosting seria apuntando a tu dominio "tuweb.com")
    2º Usuario "root" (que en este caso es el que trae por defecto)
    3º Contraseña de acceso a PHPMyAdmin (En este caso al ser Servidor Local XAMPP no tengo contraseña), así que la dejo vacia
    4º Nombre de la Base de Datos

*/
/*

    ===================================
    === CONEXIÓN A LA BASE DE DATOS ===
    ===================================

*/

// Variables para la conexión

$host = "localhost";
$user = "root";
$clave = "";
$bd = "agenda";

// Realizar la conexión

$conn = mysqli_connect($host,$user,$clave,$bd);



?>
 