/*MODAL AGREGAR CATEGORIA*/
var ModalAgregarCat = new bootstrap.Modal(document.getElementById('agregarcategoria'));



// Evento que se dispara al abrir el modal
ModalAgregarCat._element.addEventListener('show.bs.modal', function(event) {

    $('#agregar_imagen').change(function () {
        mostrarVistaPrevia(this);
    });

});

function mostrarVistaPrevia(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#mostrar_imagen').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// Función para guardar cambios (puedes ajustarla según tus necesidades)
function guardarCategoria() {
    // Obtener datos del formulario
    var descripcion = document.getElementById('agregar_descripcion').value;
    var imagen = document.getElementById('agregar_imagen').files[0];

    mostrarVistaPrevia(imagen);

    var formData = new FormData();
    formData.append('descripcion', descripcion);

    if (imagen) {
        formData.append('ruta_imagen', imagen);
    }


    $.ajax({
        url: 'include/functions/categoria_agregar.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (r) {
            ActualizacionExitosa(r);

            ModalAgregarCat.hide();
            location.reload();
        },
        error: function (r) {
            ActualizacionFallida(r)
        }

    })

}


/*MODAL PARA MODIFICAR LA CATEGORIA*/


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
    document.getElementById('mostrar_modif_imagen').src = imagen;

    $('#modif_imagen').change(function () {
        mostrarVistaPreviaModif(this);
    });
});

function mostrarVistaPreviaModif(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#mostrar_modif_imagen').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// Función para guardar cambios (puedes ajustarla según tus necesidades)
function guardarCambios() {
    // Obtener datos del formulario
    var categoria = document.getElementById('modif_id_categoria').value;
    var descripcion = document.getElementById('modif_descripcion').value;

    var imagenInput = document.getElementById('modif_imagen');
    var imagen = imagenInput.files[0];

    mostrarVistaPreviaModif(imagenInput);

    var formData = new FormData();
    formData.append('id_categoria', categoria);
    formData.append('descripcion', descripcion);

    if (imagen) {
        formData.append('ruta_imagen', imagen, imagen.name);
    }

    try {
        $.ajax({
            url: 'include/functions/categoria_actualizar.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
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