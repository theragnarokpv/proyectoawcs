function actualizarCantidad(input) {
    var codigo = input.getAttribute('data-codigo');
    var nuevaCantidad = input.value;

    $.ajax({
        type: 'POST',
        url: 'include/functions/actualizarCantidad.php',
        data: {
            codigo: codigo,
            nuevaCantidad: nuevaCantidad
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                console.log('Cantidad actualizada correctamente. Nueva cantidad:', response.newQuantity);
                actualizarCantidadEnInterfaz(response.newQuantity, codigo);
                actualizarTotal(response.nuevoTotal); // Nueva línea para actualizar el total
            } else {
                console.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', status, error);
        }
    });
}

function actualizarCantidadEnInterfaz(nuevaCantidad, codigo) {
    var cantidadInput = document.querySelector('.cantidad-input[data-codigo="' + codigo + '"]');
    if (cantidadInput) {
        cantidadInput.value = nuevaCantidad;
    }
}

function actualizarTotal(nuevoTotal) {
    document.getElementById('total').innerText = nuevoTotal;
    location.reload();
}