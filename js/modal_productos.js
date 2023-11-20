var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

// Evento que se dispara al abrir el modal
myModal._element.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Botón que activó el modal

    // Obtener datos de los atributos data-*
    var id_producto = button.getAttribute('data-id');
    var id_categoria = button.getAttribute('data-id-categoria');
    var categoria = button.getAttribute('data-categoria');
    var descripcion = button.getAttribute('data-descripcion');
    var detalle = button.getAttribute('data-detalle');
    var precio = button.getAttribute('data-precio');
    var existencias = button.getAttribute('data-existencias');
    var imagen = button.getAttribute('data-imagen');

    // Llenar los inputs del formulario con los datos
    document.getElementById('id_producto').value = id_producto;
    document.getElementById('id_categoria').value = id_categoria;
    document.getElementById('descripcion').value = descripcion;
    document.getElementById('detalle').value = detalle;
    document.getElementById('precio').value = precio;
    document.getElementById('existencias').value = existencias;
    document.getElementById('imagen').src = imagen;

    // Llenar el select de categorías

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
            // Resto del código
        },
        error: function (error) {
            console.error('Error al obtener categorías:', error);
        }
    });
});

// Función para guardar cambios (puedes ajustarla según tus necesidades)
function guardarCambios() {
    // Obtener datos del formulario
    var id_producto = document.getElementById('id_producto').value;
    var descripcion = document.getElementById('descripcion').value;

    // Hacer lo que necesites con los datos (por ejemplo, enviarlos al servidor)
    // ...

    // Cerrar el modal después de guardar cambios
    myModal.hide();
}