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
                mensaje: 'Debe ingresar la fecha diligencia'
            });
            return;
        }
        if (razon_social == '') {
            app.mensaje({
                codigo: -1,
                mensaje: 'Debe ingresar la razon social'
            });
            return;
        }

        if (nit == '') {
            app.mensaje({
                codigo: -1,
                mensaje: 'Debe ingresar el NIT'
            });
            return;
        }

        Swal.fire({
            icon: 'warning',
            title: "Ingrese la clave de seguridad",
            html: '<input type="password" id="clave" class="form-control">',
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#dc3545",
            confirmButtonColor: "#71c904",
            confirmButtonText: "Confirmar"
        }).then(function (result) {
            if (result.isConfirmed) {
                var clave = $('#clave').val();
                var data = {
                    'fecha_diligencia': fecha_diligencia,
                    'razon_social': razon_social,
                    'nit': nit,
                    'clave': clave,
                    'opcion': 'iniciarSesion'
                };
                app.ajax('../controlador/GestionUsuarioControlador.php?opcion=iniciarSesion', data, inicioSesion.repuestaInicio);
            }
        })
    },
    repuestaInicio: function (respuesta) {
        console.log(respuesta);
        if (respuesta.codigo < 0) {
            app.mensaje(respuesta);
            return;
        } else if (respuesta.codigo == 2) {
            Swal.fire({
                title: "Creando usuario...",
                text: "Espera un momento",
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            setTimeout(() => {
                location.href = "menu.php";
            }, 4000);
        } else if (respuesta.codigo == 3) {
            Swal.fire({
                icon: 'error',
                title: "Error",
                confirmButtonText: 'Confirmar',
                confirmButtonColor: "#dc3545",
                text: "Clave incorrecta",
            });
        } else {
            location.href = "menu.php";
        }
    }
};
inicioSesion.constructor();
