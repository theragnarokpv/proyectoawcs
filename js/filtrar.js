
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
window.addEventListener('DOMContentLoaded', () => {
    const btnMas = document.getElementById('boton_buscar');
    const header = document.querySelector('header');

    function moveButton() {
        if (window.innerWidth <= 768) { // Cambia el tamaño según tus necesidades
            header.appendChild(btnMas);
        } else {
            // Si el tamaño de la pantalla es mayor, devolver el botón a su posición original
            document.body.appendChild(btnMas);
        }
    }

    // Ejecutar al cargar la página y al cambiar el tamaño de la ventana
    moveButton();
    window.addEventListener('resize', moveButton);
});
