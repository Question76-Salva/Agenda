<?php

include 'includes/connect.php';

// INSERTAR UN NUEVO REGISTRO EN LA BD
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['email'])){
    if($_POST['id'] == ""){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // CREAR LA CONSULTA
        $SQL_CREATE = "INSERT INTO contactos(name, email, phone) VALUES ('$name', '$email', '$phone')";

        // EJECUTAR CONSULTA
        mysqli_query($conn,$SQL_CREATE);

        // MOSTRAR MENSAJE EN CASO DE QUE TODO ESTÉ CORRECTO
        $result = array(
            "success" => true,
            "action" => "create"
        );
        echo json_encode($result);
    }else{

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // CREAR LA CONSULTA
        $SQL_CREATE = "UPDATE contactos SET name = '$name', email = '$email', phone = '$phone' WHERE ID = $id";

        echo $SQL_CREATE;
        // EJECUTAR CONSULTA
        mysqli_query($conn,$SQL_CREATE);
       

        $result = array(
            "success" => true,
            "action" => "update"
        );
        echo json_encode($result);
    }
}else{
    // MOSTTRAR MENSAJE DE ERROR SI FALTA ALGUNO DE LOS CAMPOS
    $result = array(
        "success" => false,
        "action" => "create",
        "error" => "Fields empty"
    );
    echo json_encode($result);
}
?>