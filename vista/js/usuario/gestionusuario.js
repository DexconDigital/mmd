/* global app */
var usuarioModelo = {
    listaUsuarios: [],
    pos: -1
};
var gestionUsuario = {
    constructor: function () {
        var results = $('#results');
        var modelo = $('.modelo');

        gestionUsuario.consultatrespuestas();
        results.click(gestionUsuario.consultatgraficas);

        modelo.click(function () {
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

            //color de los botones segun la tabla
            var texto_color = (registro.color == "lila") ? "light" : "negro";
            if (registro.id_usuario == registro.usuario) {
                var btn = '<button class="btn btn-' + registro.color + ' text-' + texto_color + ' modificar" href="#!">Guardar Puntaje</button>';
            } else {
                var btn = '<button class="btn btn-' + registro.color + ' text-' + texto_color + ' grabar" href="#!">Guardar Puntaje</button>';
            }

            var reg = preguntas.split("|");
            for (var p = 0; p < reg.length; p++) {
                var pos = reg[p];
                var fila = '<div class="row">' +
                    '<div class="col-lg-11 col-sm-10 col-9">' +
                    '<span>' + pos + '</span>' +
                    '</div>' +
                    '<div class="col-lg-1 col-sm-2 col-3">';

                if (registro.id_usuario == registro.usuario) {
                    fila += '<input type="number" class="form-control text-center unoalcinco" min="1" name="pos" value="' + registro.respta[p] + '" required autocomplete="off"/>';

                } else {
                    fila += '<input type="number" class="form-control text-center unoalcinco" min="1" name="pos" required autocomplete="off"/>';
                }

                fila += '</div>' +
                    '</div>' +
                    '<hr class="bg-light ">';
                cuerpo.append(fila);
            }
            button.html(btn);
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
        var campos = $('.unoalcinco');
        var dat = formulario.serialize();
        var res = dat.split("&pos=").join("|");
        var respuestas = res.replace("pos=", "");
        //valida si todos los campos estan llenos
        var respuesta = "true";
        campos.each(function () {
            if ($(this).val() == '') {
                respuesta = "false";
                Swal.fire({
                    icon: 'error',
                    title: "Error",
                    confirmButtonText: 'Confirmar',
                    confirmButtonClass: "btn-danger",
                    text: "Debe llenar todos los campos"
                });
            }
        });

        if (respuesta == "true") {
            var data = {
                'id_pregunta': usuarioModelo.listaUsuarios[0].id_pregunta,
                'respuestas': respuestas,
                'opcion': 'guardar_respuesta'
            };
            app.ajax('../controlador/GestionUsuarioControlador.php?opcion=guardar_respuesta', data, gestionUsuario.respuestaPregunta);
        }
    },
    modificarRespuesta: function (e) {
        e.preventDefault();
        var formulario = $('#frm');
        var campos = $('.unoalcinco');
        var dat = formulario.serialize();
        var res = dat.split("&pos=").join("|");
        var respuestas = res.replace("pos=", "");
        //valida si todos los campos estan llenos
        var respuesta = "true";
        campos.each(function () {
            if ($(this).val() == '') {
                respuesta = "false";
                Swal.fire({
                    icon: 'error',
                    title: "Error",
                    confirmButtonText: 'Confirmar',
                    confirmButtonColor: "#dc3545",
                    text: "Debe llenar todos los campos",
                });
            }
        });

        if (respuesta == "true") {
            var data = {
                'id_respuestas': usuarioModelo.listaUsuarios[0].id_respuestas,
                'respuestas': respuestas,
                'opcion': 'modificar_respuesta'
            };
            app.ajax('../controlador/GestionUsuarioControlador.php?opcion=modificar_respuesta', data, gestionUsuario.respuestaPregunta);
        }
    },
    respuestaPregunta: function (respuesta) {
        if (respuesta.codigo = 1) {
            $('#prgModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: "Perfecto",
                confirmButtonText: 'Confirmar',
                confirmButtonColor: '#71c904',
                text: respuesta.mensaje,
            });
            gestionUsuario.consultatrespuestas();
        } else {
            Swal.fire({
                icon: 'error',
                title: "Error",
                confirmButtonText: 'Confirmar',
                confirmButtonColor: "#dc3545",
            });
        }
    },
    consultatrespuestas: function (e) {
        var data = {};
        app.ajax('../controlador/GestionUsuarioControlador.php?opcion=consultar_datos', data, gestionUsuario.respuestaConsultatpreguntas);
    },
    respuestaConsultatpreguntas: function (respuesta) {
        var datos = respuesta.datos;
        var results = $('#results');
        (datos.length == "28") ? results.show(): results.hide();
        var razon_social = respuesta.razon.razon_social;
        var razon = $("#razon_menu");
        //Validación de botones
        razon.html(razon_social);
        for (var i = 0; i < datos.length; i++) {
            var modelo = $('.modelo');
            var data = datos[i];
            modelo.each(function () {
                if (data.tabla == $(this).attr("data-tabla") && data.contenido == $(this).text() || data.contenido == $(this).text().toLowerCase()) {
                    $(this).removeClass("text-light").addClass("bg-white text-negro");
                }
            })
        }
    },
    consultatgraficas: function (e) {
        var data = {};
        $('#resultModal').modal('show');
        app.ajax('../controlador/GestionUsuarioControlador.php?opcion=consultar_datos', data, gestionUsuario.respuestaConsultatgraficas);
    },
    respuestaConsultatgraficas: function (respuesta) {
        var datos = respuesta.datos;
        
        //Arreglos de graficas dimensión
        var dimension = $("#dimension");
        var rs_dm = respuesta.resultados_dimension;
        var resultset = respuesta.resultados;
        var pdf = $("#pdf");

        dimension.empty();
        $.each(rs_dm, function (key, value) {
            var estandar = "0";
            switch (key) {
                case "Clientes":
                    estandar = "20";
                    break;
                case "Estrategia":
                    estandar = "30";
                    break;
                case "Tecnología":
                    estandar = "15";
                    break;
                case "Operaciones":
                    estandar = "25";
                    break;
                case "Cultura":
                    estandar = "10";
                    break;
                case "Total":
                    estandar = "100";
                    break;
            }

            var resul_dim = ((value - estandar) / estandar) * 100;
            var text_bold = (key == 'Total') ? 'font-weight-bold' : '';

            var campos = '<tr>' +
                '<th class="text-left" scope="row">' + key + '</th>' +
                '<td class="text-center ' + text_bold + '">' + value + '%</td>' +
                '<td class="text-center ' + text_bold + '">' + estandar + '%</td>' +
                '<td class="text-center ' + text_bold + '">' + Number(resul_dim).toFixed(2) + '%</td>' +
                '</tr>';
            dimension.append(campos);
        });

        //Graficas dimensión
        var Canvas = document.getElementById("dimension_grafica");

        var marksData = {
            labels: ["Clientes", "Estrategia", "Tecnología", "Operaciones", "Cultura"],
            datasets: [{
                label: "Resultado",
                data: [rs_dm.Clientes, rs_dm.Estrategia, rs_dm.Tecnología, rs_dm.Operaciones, rs_dm.Cultura],
                borderColor: "#86F200",
                backgroundColor: "rgba(255,255,255,0)"
                }, {
                label: "Estandar",
                data: [20, 30, 15, 25, 10],
                borderColor: "#34F0FF",
                backgroundColor: "rgba(255,255,255,0)"
                }]
        };


        var options = {
            responsive: true,
            maintainAspectRatio: false,
            scale: {
                gridLines: {
                    color: '#D4D4D4'
                },
                pointLabels: {
                    fontSize: 16
                }
            },
            events: false,
        };


        var radarChart = new Chart(Canvas, {
            type: 'radar',
            data: marksData,
            options: options
        });
        //Fin  graficas dimensión

        //Arreglos de graficas 
        $.each(resultset, function (key, value) {
            var tabla_get = key;
            var tab = $(".tabla_" + tabla_get);
            var total_tabla = $(".total_tabla_" + tabla_get);
            var total_estandar = $(".total_estandar_" + tabla_get);
            var total_desviación = $(".total_desviación_" + tabla_get);

            tab.empty();
            total_tabla.empty();
            total_estandar.empty();
            total_desviación.empty();

            var cadena_info = [];
            var cadena_total = [];
            var cadena_estandar = [];

            var numb = 1;
            for (var i = 0; i < datos.length; i++) {
                var data = datos[i];
                var tabla = data.tabla;

                if (tabla_get == data.tabla) {
                    var abreviado = "";

                    switch (data.tabla) {
                        case "clientes":
                            abreviado = "CL";
                            break;
                        case "estrategia":
                            abreviado = "ET";
                            break;
                        case "tecnología":
                            abreviado = "TC";
                            break;
                        case "operaciones":
                            abreviado = "OP";
                            break;
                        case "cultura":
                            abreviado = "OC";
                            break;
                    }

                    var total = data.total;
                    var campos_tabla = '<tr>' +
                        '<th class="text-left"> ' + abreviado + numb + " - " + ' <label class="first-uppercase"><span>' + data.contenido + '</span></label></th>' +
                        '<td class="text-center">' + data.result_2 + '%</td>' +
                        '<td class="text-center">' + data.estandar + '%</td>' +
                        '<td class="text-center">' + data.desviacion + '%</td>' +
                        '</tr>';

                    var tot_desv = (((total - 100) / 100) * 100);
                    tab.append(campos_tabla);
                    total_tabla.html(total + "%");
                    total_estandar.html("100%");
                    total_desviación.html(Number(tot_desv).toFixed(2) + "%");
                    //Graficas dimensión
                    cadena_info.push(abreviado + numb);
                    cadena_total.push(data.result_2);
                    cadena_estandar.push(data.estandar);
                    numb++;
                }
            }

            var Canvas = document.getElementById(tabla_get + "_grafica");
            var Data = {
                labels: cadena_info,
                datasets: [{
                    label: "Resultado",
                    data: cadena_total,
                    borderColor: "#86F200",
                    backgroundColor: "rgba(255,255,255,0)"
                    }, {
                    label: "Estandar",
                    data: cadena_estandar,
                    borderColor: "#34F0FF",
                    backgroundColor: "rgba(255,255,255,0)"
                    }]
            };
            var radarChart = new Chart(Canvas, {
                type: 'radar',
                data: Data,
                options: options
            });
        });


        //mapa de calor
        var mapa_calor = $("#tabla_mapa");
        mapa_calor.empty();

        $.each(resultset, function (key, value) {
            var title_color = (value.color == "lila") ? "light" : "negro";

            var color_cabecera = "red";
            var text_cabecera = "light";

            if (value.total >= 25.1) {
                color_cabecera = "dark-yellow";
                text_cabecera = "light";
            }
            if (value.total >= 50.1) {
                color_cabecera = "yellow";
                text_cabecera = "negro";
            }
            if (value.total >= 75.1) {
                color_cabecera = "dark-green";
                text_cabecera = "negro";
            }

            var mapa = '<div class="col-12 col-xl-6 w-auto text-center text-negro" style="max-width:none;">' +
                '<div class="bg-' + value.color + ' text-' + title_color + '  border border-secondary font-weight-bold"><h5 class="mb-0 text-capitalize">' + key + '</h5></div>' +
                '<div class="bg-' + color_cabecera + ' text-' + text_cabecera + ' border border-secondary font-weight-bold">' + value.total + '%</div>' +
                '<div class="row no-gutters flex-nowrap">';

            for (var i = 0; i < datos.length; i++) {

                var data_map = datos[i];
                var constante = data_map.constante;

                if (key == data_map.tabla) {
                    var text_color = (data_map.color == "lila") ? "light" : "negro";

                    mapa += '<div class="col">' +
                        '<div class="bg-' + data_map.color + ' text-' + text_color + ' border border-secondary p-1 align-middle d-flex align-items-center justify-content-center first-uppercase" style="height: 5em;"><span>' + data_map.contenido + '</span></div>' +
                        '<div class="bg-' + data_map.color_contenido + ' text-' + data_map.text_contenido + ' border border-secondary font-weight-bold">' + data_map.result_2 + '%</div>';

                    var pregunt = data_map.preguntas.split("|");
                    for (var pre = 0; pre < pregunt.length; pre++) {
                        var prg = pregunt[pre];
                        var const_total = (data_map.rsp[pre] * constante);
                        var color_pie = "red";
                        var text_pie = "light";

                        //Colores segun el total en el pie
                        if (const_total >= 25.1) {
                            color_pie = "dark-yellow";
                            text_pie = "light";
                        }
                        if (const_total >= 50.1) {
                            color_pie = "yellow";
                            text_pie = "negro";
                        }
                        if (const_total >= 75.1) {
                            color_pie = "dark-green";
                            text_pie = "negro";
                        }

                        mapa += '<div class="bg-light border border-secondary p-2 d-flex align-items-center" style="height: 20em;min-width:16.2em;">' + prg + '</div>' +
                            '<div class="bg-' + color_pie + ' text-' + text_pie + ' border border-secondary font-weight-bold"> ' + const_total + '%</div>';
                    }
                    mapa += '</div>';
                }
            }
            mapa += '</div>' +
                '</div>';
            mapa_calor.append(mapa);

        });
        pdf.click(function (e) {
            e.stopPropagation();
            pdf.addClass("disabled");
            var data = {
                'respuesta': respuesta,
                'opcion': 'generarPDF'
            };
            app.ajax('../controlador/GestionUsuarioControlador.php?opcion=generarPDF', data, gestionUsuario.respuestaGenerarPDF);
            Swal.fire({
                title: "Generando reporte...",
                text: "Espera un momento",
                showConfirmButton: false,
                allowOutsideClick: false,
            });
        });
    },
    respuestaGenerarPDF: function (respuesta) {

        var pdf = $("#pdf");
        pdf.removeClass("disabled");
        var pdfResult = respuesta.PDF;
        var nombre = respuesta.nombre
        
        Swal.fire({
            icon: 'success',
            title: "Perfecto",
            confirmButtonText: 'Confirmar',
            confirmButtonColor: '#71c904',
            html: 'Para descargar el <b>PDF</b>, ' +
                '<a href="' + pdfResult + '" download="MapaCalor_' + nombre + '">Click aquí</a>'
        })
    }
};
gestionUsuario.constructor();
