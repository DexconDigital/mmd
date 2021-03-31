/* global app */
var usuarioModelo = {
    listaUsuarios: [],
    pos: -1
};
var gestionUsuario = {
    constructor: function () {
        $('#frm').on('submit', gestionUsuario.guardarRespuesta);
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
        var modal = $('#prgModal');
        cuerpo.empty();
        titulo.empty();
        (respuesta.datos != "") ? modal.modal('show') : "";

        var datos = respuesta.datos;
        usuarioModelo.listaUsuarios = datos;
        for (var i = 0; i < datos.length; i++) {
            var registro = datos[i];
            var preguntas = registro.preguntas;
            titulo.text(registro.tabla + " - " + registro.contenido);
            var reg = preguntas.split("|");

            for (var p = 0; p < reg.length; p++) {
                var pos = reg[p];
                var fila = '<div class="row">' +
                    '<div class="col-lg-11 col-sm-10 col-9">' +
                    '<span>' + pos + '</span>' +
                    '</div>' +
                    '<div class="col-lg-1 col-sm-2 col-3">' +
                    '<input type="number" class="form-control" name="pos" min="1" max="5" required autocomplete="off"/>' +
                    '</div>' +
                    '</div>' +
                    '<hr class="bg-light ">';
                cuerpo.append(fila);
            }
        }
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
        app.ajax('../controlador/GestionUsuarioControlador.php?opcion=guardar_respuesta', data, gestionUsuario.respuestaGuardarPregunta);
    },
    respuestaGuardarPregunta: function (respuesta) {
        swal({
            title: "perfecto",
            text: respuesta.mensaje,
            type: "success"
        });
    }
};
gestionUsuario.constructor();
