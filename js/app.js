// DATATABLES
$(document).ready(function () {
    // Cargar los contactos cuando se carga la página
    getContacts();

    // Añadimos el evento de guardar en contacto cuando se pulsa el botón del modal
    $("#send").click(function () {
        sendData();
    });

    // Evento que se ejecuta siempre que se abra el modal y nos pone el cursor del teclado en el primer input del modal
    $('#exampleModalCenter').on('shown.bs.modal', function () {
        $('#name').trigger('focus')
    })

    // Cada vez que cerramos el modal vaciamos el contenido de los inputs
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        $(".form-control").val("");
    });
});


// FUNCION OBTENER E IMPRIMIR LOS CONTACTOS
function getContacts() {
    // Ocultar la tabla y mostramos el "loading"
    $("#data").hide();
    $("#loading").show();

    // Realizar la petición AJAX a nuestro "endpoint"
    $.getJSON("/agenda/api/show.php", function (data) {
        // Una vez realizada la petición se ejecuta lo que hay aqui dentro

        // Crear el HTML de la tabla en un string y lo imprimimos en "#data"
        let table = createTable(data);
        $("#data").html(table);

        // Aplicamos la función "dataTable" al HTML introducido en la página 
        $('#table_id').DataTable();

        // Ocultamos el "loading" y mostramos los datos una vez esten todos procesados e imprimidos
        $("#data").show();
        $("#loading").hide();
    });
}

function createTable(data) {
    // Crear cabecera de la tabla 

    var html = '<table id="table_id" class="display"> ' +
        '<thead>' +
        '<tr>' +
        ' <th>Nombre del contacto</th>' +
        ' <th>Correo electrónico</th>' +
        ' <th>Móvil</th>' +
        ' <th>Opciones</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';

    // Añadimos una a una todas las columnas obtenidas de la BD 
    data.forEach(function (contac) {
        html += '<tr>' +
            ' <td>' + contac.name + '</td>' +
            ' <td>' + contac.email + '</td>' +
            ' <td>' + contac.phone + '</td>' +
            ' <td>' +
            '     <button class="btn btn-success" onclick="edit(' + contac.id + ')"><i class="fa fa-pencil" aria-hidden="true"></i></button>' +
            '     <button class="btn btn-danger" onclick="remove(' + contac.id + ')"><i class="fa fa-trash-o" aria-hidden="true"></i> </button>' +
            ' </td>' +
            ' </tr>';
    });

    // Incluir el final de la tabla
    html += ' </tbody >' +
        '</table >';

    // Devolver el string con el HTML de la tabla
    return html;
}

function sendData() {
    // Crear JSON con la estructura de los datos a guardar
    contac = {
        name: $("#name").val(),
        email: $("#email").val(),
        phone: $("#phone").val(),
        id: $("#id").val()
    };

    // Enviar la petición con los datos del nuevo registro
    $.post("/agenda/api/create.php", contac, function (data) {
        // Volver a cargar los contactos para que vengan actualizados con el último guardado
        getContacts();
        // Ocultar el modal una vez se ha guardado
        $('#exampleModalCenter').modal('hide');


    });
}



function remove(id) {
    $.post("/agenda/api/delete.php", {
        id: id
    }, function (data) {
        getContacts();
    });
}


function edit(id) {
    $.getJSON("/agenda/api/show.php?id=" + id, function (data) {
        $("#name").val(data.name);
        $("#email").val(data.email);
        $("#phone").val(data.phone);
        $("#id").val(data.id);
        $("#add").click();
    });
}