modal_categorias.js

var ModalAgregarCat = new bootstrap.Modal(document.getElementById('agregarcategoria'));

// Evento que se dispara al abrir el modal

// Función para guardar cambios (puedes ajustarla según tus necesidades)
function guardarCategoria() {
    // Obtener datos del formulario
    var descripcion = document.getElementById('modif_descripcion').value;
    var imagen = document.getElementById('modif_imagen').value;

    var datos = {
        descripcion: descripcion,
        imagen: imagen
    };

    try {
        $.ajax({
            url: 'include/functions/categoria_agregar.php',
            method: 'POST',
            data: datos,
            dataType: 'json',
            success: function (r) {
                ActualizacionExitosa(r);

                ModalAgregarCat.hide();
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





var ModalCat = new bootstrap.Modal(document.getElementById('modificarcategoria'));

// Evento que se dispara al abrir el modal
ModalCat._element.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Botón que activó el modal

    // Obtener datos de los atributos data-*
    var id_categoria = button.getAttribute('data-id');
    var descripcion = button.getAttribute('data-descripcion');
    var imagen = button.getAttribute('data-imagen');

    // Llenar los inputs del formulario con los datos
    document.getElementById('modif_id_categoria').value = id_categoria;
    document.getElementById('modif_descripcion').value = descripcion;
    document.getElementById('modif_imagen').src = imagen;
});

// Función para guardar cambios (puedes ajustarla según tus necesidades)
function guardarCambios() {
    // Obtener datos del formulario
    var categoria = document.getElementById('modif_id_categoria').value;
    var descripcion = document.getElementById('modif_descripcion').value;
    var imagen = document.getElementById('modif_imagen').value;

    var datos = {
        id_categoria: categoria,
        descripcion: descripcion,
        imagen: imagen
    };

    try {
        $.ajax({
            url: 'include/functions/categoria_actualizar.php',
            method: 'POST',
            data: datos,
            dataType: 'json',
            success: function (r) {
                ActualizacionExitosa(r);

                ModalCat.hide();
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
