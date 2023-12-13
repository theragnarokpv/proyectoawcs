$(document).ready(function () {
    $("#btn_registrar").click(function () {
        var usuario = $("#usuario_registro").val();
        var nombre = $("#nombre").val();
        var apellidos = $("#apellidos").val();
        var correo = $("#correo").val();
        var contrasena = $("#contrasena").val();
        var confirmarContrasena = $("#confirmar_contrasena").val();
        var telefono = $("#telefono").val();
        

        $.ajax({
            type: "POST",
            url: "include/functions/insertarUsuario.php",
            data: {
                usuario: usuario,
                nombre: nombre,
                apellidos: apellidos,
                correo: correo,
                contrasena: contrasena,
                confirmarContrasena: confirmarContrasena,
                telefono: telefono
            },
            success: function (r) {
                ActualizacionExitosa(r);
            },
            error: function (r) {
                ActualizacionFallida(r)
            }
    
        })
    });



    function ActualizacionExitosa(response) {
        $("#pnlInfo").dialog();
        $("#blInfo").html('<p>' + response.message + '</p>');
        window.location.href = 'inicioSesion.php';
    }
    
    function ActualizacionFallida(response) {
        $("#pnlMensaje").dialog();
        $("#blMensajes").html('<p>Ocurrió un error en el servidor. </p>' + response.error);
    }
});