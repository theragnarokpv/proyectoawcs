var ModalAgregar = new bootstrap.Modal(document.getElementById('agregarproducto'));

ModalAgregar._element.addEventListener('show.bs.modal', function(event) {
    console.log('Antes de la solicitud AJAX');
    $.ajax({
        url: 'include/functions/obtener_categorias.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {

            $('#agregar_categoria').empty();
            console.log('Datos obtenidos con éxito:', data);
            $.each(data, function (index, value) {
                var opcionAgregar = $('<option>').val(value.id_categoria).text(value.descripcion);
                $('#agregar_categoria').append(opcionAgregar);
            });
        },
        error: function (error) {
            console.error('Error al obtener categorías:', error);
        }
    });


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

function guardarProducto() {
    // Obtener datos del formulario
    var categoria = document.getElementById('agregar_categoria').value;
    var descripcion = document.getElementById('agregar_descripcion').value;
    var detalle = document.getElementById('agregar_detalle').value;
    var precio = document.getElementById('agregar_precio').value;
    var existencias = document.getElementById('agregar_existencias').value;
    var imagen = document.getElementById('agregar_imagen').files[0];


    mostrarVistaPrevia(imagen);

    var formData = new FormData();
    formData.append('id_categoria', categoria);
    formData.append('descripcion', descripcion);
    formData.append('detalle', detalle);
    formData.append('precio', precio);
    formData.append('existencias', existencias);

    if (imagen) {
        formData.append('ruta_imagen', imagen);
    }

    $.ajax({
        url: 'include/functions/producto_agregar.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (r) {
            ActualizacionExitosa(r);
            ModalAgregar.hide();
            location.reload();
        },
        error: function (xhr, status, error) {
            ActualizacionFallida(xhr.responseText)
        }
    });
}







var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

myModal._element.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; 


    var id_producto = button.getAttribute('data-id');
    var id_categoria = button.getAttribute('data-id-categoria');
    var categoria = button.getAttribute('data-categoria');
    var descripcion = button.getAttribute('data-descripcion');
    var detalle = button.getAttribute('data-detalle');
    var precio = button.getAttribute('data-precio');
    var existencias = button.getAttribute('data-existencias');
    var imagen = button.getAttribute('data-imagen');


    document.getElementById('id_producto').value = id_producto;
    document.getElementById('id_categoria').value = id_categoria;
    document.getElementById('descripcion').value = descripcion;
    document.getElementById('detalle').value = detalle;
    document.getElementById('precio').value = precio;
    document.getElementById('existencias').value = existencias;
    document.getElementById('mostrar_modif_imagen').src = imagen;

    console.log('Antes de la solicitud AJAX');
    $.ajax({
        url: 'include/functions/obtener_categorias.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            // Almacenar la categoría actual
            var categoriaActual = $('#id_categoria').val();

            $('#categoria').empty();
            console.log('Datos obtenidos con éxito:', data);
            $.each(data, function (index, value) {
                var option = $('<option>').val(value.id_categoria).text(value.descripcion);
                $('#categoria').append(option);
            });

            $('#categoria').val(categoriaActual);
        },
        error: function (error) {
            console.error('Error al obtener categorías:', error);
        }
    });

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

function guardarCambios() {
    /*Obtiene datos del formulario*/
    var id_producto = document.getElementById('id_producto').value;
    var categoria = document.getElementById('id_categoria').value;
    var descripcion = document.getElementById('descripcion').value;
    var detalle = document.getElementById('detalle').value;
    var precio = document.getElementById('precio').value;
    var existencias = document.getElementById('existencias').value;
    var imagenInput = document.getElementById('modif_imagen');
    var imagen = imagenInput.files[0];

    /*Con esta funcion se puede ver una vista previa*/
    mostrarVistaPreviaModif(imagenInput);

    // Crear un objeto FormData
    var formData = new FormData();
    formData.append('id_producto', id_producto);
    formData.append('id_categoria', categoria);
    formData.append('descripcion', descripcion);
    formData.append('detalle', detalle);
    formData.append('precio', precio);
    formData.append('existencias', existencias);

    if (imagen) {
        formData.append('ruta_imagen', imagen, imagen.name);
    }

    $.ajax({
        url: 'include/functions/producto_actualizar.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,  
        dataType: 'json',
        success: function (r) {
            ActualizacionExitosa(r);
            myModal.hide();
            location.reload();
        },
        error: function (r) {
            ActualizacionFallida(r);
        }
    });
}

function ActualizacionExitosa (TextoJSON) {
    $("#pnlInfo").dialog();
    $("#blInfo").html('<p>' + TextoJSON + '</p>');
}

function ActualizacionFallida (TextoJSON) {
    $("#pnlMensaje").dialog();
    $("#blMensajes").html('<p>Ocurrio un error en el servidor. </p>' + TextoJSON.responseText);
}
