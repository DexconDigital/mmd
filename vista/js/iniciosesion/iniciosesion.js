var inicioSesion = {
    constructor: function () {
        $('#frm').on('submit', inicioSesion.validarinicio);
    },
    validarinicio: function (e) {
        e.preventDefault();
        var formulario = $('#frm');
        var fecha_diligencia = formulario.find('#fecha_diligencia').val();
        var razon_social = formulario.find('#razon_social').val();
        var nit = formulario.find('#nit').val();

        if (fecha_diligencia == '') {
            app.mensaje({
                codigo: -1,
                mensaje: 'debe ingresar la fecha diligencia'
            });
            return;
        }
        if (razon_social == '') {
            app.mensaje({
                codigo: -1,
                mensaje: 'debe ingresar la razon social'
            });
            return;
        }

        if (nit == '') {
            app.mensaje({
                codigo: -1,
                mensaje: 'debe ingresar el NIT'
            });
            return;
        }

        var data = {
            'fecha_diligencia': fecha_diligencia,
            'razon_social': razon_social,
            'nit': nit,
            'opcion': 'iniciarSesion'
        };
        app.ajax('../controlador/GestionUsuarioControlador.php?opcion=iniciarSesion', data, inicioSesion.repuestaInicio);
    },
    repuestaInicio: function (respuesta) {
        if (respuesta.codigo < 0) {
            app.mensaje(respuesta);
            return;
        } else {
            location.href = "menu.php";
        }
    }
};
inicioSesion.constructor();
