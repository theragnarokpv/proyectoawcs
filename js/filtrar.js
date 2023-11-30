
$(document).ready(function () {
    // Al hacer clic en el botón "Buscar" del modal
    $("#buscarProductos").click(function () {
        // Obtener los valores del formulario
        var minPrice = $("#filtrar_precio_minimo").val();
        var maxPrice = $("#filtrar_precio_maximo").val();
        var description = $("#descripcion_producto").val();

        // Realizar la solicitud AJAX al servidor
        $.ajax({
            type: "POST",
            url: "include/functions/filtrarProductos.php",
            data: {
                minPrice: minPrice,
                maxPrice: maxPrice,
                description: description
            },
            success: function (response) {
                // Actualizar el contenido de la página con los resultados filtrados
                $(".row").html(response);

                // Cerrar el modal
                $("#filtrarproductos").modal("hide");
            },
            error: function () {
                alert("Error al filtrar productos.");
            }
        });
    });
});