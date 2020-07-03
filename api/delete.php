<?php

include 'includes/connect.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];    
    $SQL_DELETE = "DELETE FROM contactos WHERE ID = $id";
    $RESULT = mysqli_query($conn,$SQL_DELETE);
    
    $result = array(
        "success" => true,
        "action" => "delete"    
    );
    echo json_encode($result);
}else{
    // MOSTTRAR MENSAJE DE ERROR SI FALTA ALGUNO DE LOS CAMPOS
    $result = array(
        "success" => false,
        "action" => "delete",
        "error" => "Not id to remove"
    );
    echo json_encode($result);
}

?>