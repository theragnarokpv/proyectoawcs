$(document).ready(function () {
    $('modif_imagen_perfil').change(function () {
        mostrarVistaPreviaModif(this);
    });

    function mostrarVistaPreviaModif(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function (e) {
                $('#usuario_imagen').attr('src', e.target.result);
            };
    
            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#btn_confirmar").click(function () {



        var usuario = $("#input-usuario").val();
        var nombre = $("#input-nombre").val();
        var apellidos = $("#input-apellidos").val();
        var correo = $("#input-correo").val();
        var anteiorContra = $("#input-viejacontra")
        var contrasena = $("#input-nuevacontra").val();
        var confirmarContrasena = $("#input-nueva_contra").val();
        var telefono = $("#input-telefono").val();

        var imagenInput = document.getElementById('modif_imagen_perfil');
        var imagen = imagenInput.files[0];

        mostrarVistaPreviaModif(imagenInput);

        // Realizar la llamada AJAX
        $.ajax({
            type: "POST",
            url: "include/functions/editarUsuario.php",
            data: {
                usuario: usuario,
                nombre: nombre,
                apellidos: apellidos,
                correo: correo,
                contrasena: contrasena,
                confirmarContrasena: confirmarContrasena,
                telefono: telefono
            },
            success: function (response) {

            }
        });
    });
});