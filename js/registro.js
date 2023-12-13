$(document).ready(function () {
    $("#btn_registrar").click(function () {
        // Obtener datos del formulario
        var usuario = $("#usuario_registro").val();
        var nombre = $("#nombre").val();
        var apellidos = $("#apellidos").val();
        var correo = $("#correo").val();
        var contrasena = $("#contrasena").val();
        var confirmarContrasena = $("#confirmar_contrasena").val();
        var telefono = $("#telefono").val();
        
        // Realizar la llamada AJAX
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
    
                myModal.hide();
                location.reload();
            },
            error: function (r) {
                ActualizacionFallida(r)
            }
    
        })
    });



    function ActualizacionExitosa (TextoJSON) {
        $("#pnlInfo").dialog();
        $("#blInfo").html('<p>' + TextoJSON + '</p>');
    }
    
    function ActualizacionFallida (TextoJSON) {
        $("#pnlMensaje").dialog();
        $("#blMensajes").html('<p>Ocurrio un error en el servidor. </p>' + TextoJSON.responseText);
    }
});