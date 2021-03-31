/* global app */
var usuarioModelo = {
    listaUsuarios: [],
    pos: -1
};
var gestionUsuario = {
    constructor: function () {
        gestionUsuario.consultatrespuestas();
        $('.modelo').click(function () {
            var data = {};
            data.tabla = $(this).attr("data-tabla");
            data.contenido = $(this).text();
            app.ajax('../controlador/GestionUsuarioControlador.php?opcion=consultar_preguntas', data, gestionUsuario.repuestaConsultarPreg);
        });
    },
    repuestaConsultarPreg: function (respuesta) {
        var cuerpo = $('#contenido_preguntas');
        var titulo = $("#exampleModalLabel1");
        cuerpo.empty();
        titulo.empty();

        var modal = $('#prgModal');
        (respuesta.datos != "") ? modal.modal('show'): "";

        var datos = respuesta.datos;
        usuarioModelo.listaUsuarios = datos;
        for (var i = 0; i < datos.length; i++) {
            var registro = datos[i];
            var preguntas = registro.preguntas;
            var respuestas = registro.respuestas;
            var button = $('#accion_btn');

            titulo.text(registro.tabla + " - " + registro.contenido);

            if (registro.id_usuario == registro.usuario) {
                var btn = '<button class="btn btn-aqua text-dark modificar" href="#!">Guardar Puntaje</button>';
            } else {
                var btn = '<button class="btn btn-aqua text-dark grabar" href="#!">Guardar Puntaje</button>';
            }
            button.html(btn);

            var reg = preguntas.split("|");
            for (var p = 0; p < reg.length; p++) {
                var pos = reg[p];
                var fila = '<div class="row">' +
                    '<div class="col-lg-11 col-sm-10 col-9">' +
                    '<span>' + pos + '</span>' +
                    '</div>' +
                    '<div class="col-lg-1 col-sm-2 col-3">';

                if (registro.id_usuario == registro.usuario) {
                    fila += '<input type="number" class="form-control unoalcinco" min="1" name="pos" value="' + registro.respta[p] + '" required autocomplete="off"/>';

                } else {
                    fila += '<input type="number" class="form-control unoalcinco" min="1" name="pos" required autocomplete="off"/>';
                }

                fila += '</div>' +
                    '</div>' +
                    '<hr class="bg-light ">';
                cuerpo.append(fila);
            }
        }
        $('.unoalcinco').on('input', function () {
            var value = $(this).val();
            if ((value !== '') && (value.indexOf('.') === -1)) {
                $(this).val(Math.max(Math.min(value, 5), -5));
            }
        });
        $('.grabar').on('click', gestionUsuario.guardarRespuesta);
        $('.modificar').on('click', gestionUsuario.modificarRespuesta);
    },
    guardarRespuesta: function (e) {
        e.preventDefault();
        var formulario = $('#frm');
        var dat = formulario.serialize();
        var res = dat.split("&pos=").join("|");
        var respuestas = res.replace("pos=", "");

        var data = {
            'id_pregunta': usuarioModelo.listaUsuarios[0].id_pregunta,
            'respuestas': respuestas,
            'opcion': 'guardar_respuesta'
        };
        app.ajax('../controlador/GestionUsuarioControlador.php?opcion=guardar_respuesta', data, gestionUsuario.respuestaPregunta);
    },
    modificarRespuesta: function (e) {
        e.preventDefault();
        var formulario = $('#frm');
        var dat = formulario.serialize();
        var res = dat.split("&pos=").join("|");
        var respuestas = res.replace("pos=", "");

        var data = {
            'id_respuestas': usuarioModelo.listaUsuarios[0].id_respuestas,
            'respuestas': respuestas,
            'opcion': 'modificar_respuesta'
        };
        app.ajax('../controlador/GestionUsuarioControlador.php?opcion=modificar_respuesta', data, gestionUsuario.respuestaPregunta);
    },
    respuestaPregunta: function (respuesta) {
        if (respuesta.codigo = 1) {
            $('#prgModal').modal('hide');
            swal({
                title: "perfecto",
                text: respuesta.mensaje,
                type: "success"
            });
        } else {
            swal({
                title: "Error",
                type: "error"
            });
        }
    },
    consultatrespuestas: function (e) {
        var data = {};
        app.ajax('../controlador/GestionUsuarioControlador.php?opcion=consultar_datos', data, gestionUsuario.respuestaConsultatpreguntas);
    },
    respuestaConsultatpreguntas: function (respuesta) {
        console.log(respuesta);
    }
};
gestionUsuario.constructor();
