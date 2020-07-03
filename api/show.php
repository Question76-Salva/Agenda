<?php

include 'includes/connect.php';

if(isset($_GET["id"])){  
    /*
        En el caso de que pidamos UN CONTACTO en concreto
    */ 

    // Consulata para obtener el contacto a través del "id"
    $SQL_READ = "SELECT * FROM contactos WHERE id=".$_GET["id"].";";

    // Ejecutar la consulta
    $result = mysqli_query($conn,$SQL_READ);

    // Cargar en "$row" la primera y única columna que trae la consulta
    $row = $result->fetch_assoc();

    // Parsear la variable "$row" a JSON y la mostramos
    echo json_encode($row);

}else{
    /*
        En el caso de que pidamos la LISTA COMPLETA de contactos
    */ 

    // Consulata para OBTENER LA LISTA COMPLETA ORDENADA POR "nombre"
    $SQL_READ = "SELECT * FROM contactos ORDER BY name ASC;";

    // Ejecutar la consulta
    $result = mysqli_query($conn,$SQL_READ);

    // Crear un array vacio para guardar TODOS LOS CONTACTOS antes de parsearlos
    $dbdata = array();

    // Recorrer la consulta que devuelve la BD y añadimos cada fila al array creado
    while ( $row = $result->fetch_assoc()) {
        $dbdata[]=$row;
    }

    // Parsear el array a JSON y la mostramos
    echo json_encode($dbdata);
}

include 'includes/disconnect.php';
?>