var ModalAgregar = new bootstrap.Modal(document.getElementById('agregarusuario'));


function guardarUsuario() {
    // Obtener datos del formulario
    var username = document.getElementById('agregar_username').value;
    var contra = document.getElementById('agregar_contra').value;
    var correo = document.getElementById('agregar_correo').value;

    var datos = {
        username: username,
        password: contra,
        correo: correo,
    };

    try {
        $.ajax({
            url: 'include/functions/usuario_agregar.php',
            method: 'POST',
            data: datos,
            dataType: 'json',
            success: function (r) {
                ActualizacionExitosa(r);

                ModalAgregar.hide();
                location.reload();
            },
            error: function (r) {
                ActualizacionFallida(r)
            }
    
        });
        
    } catch (error) {
        alert (error);
    }
}




var myModal = new bootstrap.Modal(document.getElementById('modificarusuario'));

// Evento que se dispara al abrir el modal
myModal._element.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Botón que activó el modal

    // Obtener datos de los atributos data-*
    var id_usuario = button.getAttribute('data-id');
    var id_rol = button.getAttribute('data-id-rol');
    var username = button.getAttribute('data-username');
    var password = button.getAttribute('data-password');
    var nombre = button.getAttribute('data-nombre');
    var apellidos = button.getAttribute('data-apellidos');
    var correo = button.getAttribute('data-correo');
    var telefono = button.getAttribute('data-telefono');
    var imagen = button.getAttribute('data-imagen');

    // Llenar los inputs del formulario con los datos
    document.getElementById('modif_id_usuario').value = id_usuario;
    document.getElementById('modif_id_rol').value = id_rol;
    document.getElementById('modif_username').value = username;
    document.getElementById('modif_contra').value = password;
    document.getElementById('modif_nombre').value = nombre;
    document.getElementById('modif_apellidos').value = apellidos;
    document.getElementById('modif_correo').value = correo;
    document.getElementById('modif_telefono').value = telefono;
    document.getElementById('modif_imagen').src = imagen;

    // Llenar el select de categorías

    console.log('Antes de la solicitud AJAX');
    $.ajax({
        url: 'include/functions/obtener_roles.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            // Almacenar la categoría actual
            var rolActual = $('#modif_id_rol').val();

            $('#modif_rol').empty();
            console.log('Datos obtenidos con éxito:', data);
            $.each(data, function (index, value) {
                var option = $('<option>').val(value.id_rol).text(value.nombre);
                $('#modif_rol').append(option);
            });

            $('#modif_rol').val(rolActual);
            // Resto del código
        },
        error: function (error) {
            console.error('Error al obtener roles:', error);
        }
    });
});

// Función para guardar cambios (puedes ajustarla según tus necesidades)
function modificarUsuario() {
    // Obtener datos del formulario

    var id_usuario = document.getElementById('modif_id_usuario').value;
    var id_rol = document.getElementById('modif_id_rol').value;
    var username = document.getElementById('modif_username').value;
    var password = document.getElementById('modif_contra').value;
    var nombre = document.getElementById('modif_nombre').value;
    var apellidos = document.getElementById('modif_apellidos').value ;
    var correo = document.getElementById('modif_correo').value;
    var telefono = document.getElementById('modif_telefono').value;
    //var imagen = document.getElementById('agregar_imagen').value;

    var datos = {
        id_usuario: id_usuario,
        id_rol: id_rol,
        username: username,
        password: password,
        nombre: nombre,
        apellidos: apellidos,
        correo: correo,
        telefono: telefono,
    };

    try {
        $.ajax({
            url: 'include/functions/usuario_actualizar.php',
            method: 'POST',
            data: datos,
            dataType: 'json',
            success: function (r) {
                ActualizacionExitosa(r);

                myModal.hide();
                location.reload();
            },
            error: function (r) {
                ActualizacionFallida(r)
            }
    
        })
        
    } catch (error) {
        alert (err);
    }
}


function ActualizacionExitosa (TextoJSON) {
    $("#pnlInfo").dialog();
    $("#blInfo").html('<p>' + TextoJSON + '</p>');
}

function ActualizacionFallida (TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#blMensajes").html('<p>Ocurrio un error en el servidor. </p>' + TextoJSON.responseText);
}
