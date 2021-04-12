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
            var texto_color = (registro.color == "lila") ? "light" : "dark";
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
                swal({
                    title: "Error",
                    confirmButtonText: 'Confirmar',
                    confirmButtonClass: "btn-danger",
                    text: "Debe llenar todos los campos",
                    type: "error"
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
                swal({
                    title: "Error",
                    confirmButtonText: 'Confirmar',
                    confirmButtonClass: "btn-danger",
                    text: "Debe llenar todos los campos",
                    type: "error"
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
            swal({
                title: "Perfecto",
                confirmButtonText: 'Confirmar',
                confirmButtonClass: "btn-verde text-dark shadow-none",
                text: respuesta.mensaje,
                type: "success"
            });
            gestionUsuario.consultatrespuestas();
        } else {
            swal({
                title: "Error",
                confirmButtonText: 'Confirmar',
                confirmButtonClass: "btn-danger",
                type: "error"
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
                    $(this).removeClass("text-light").addClass("bg-white text-dark");
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
            var campos = '<tr>' +
                '<th scope="row">' + key + '</th>' +
                '<td class="text-center">' + value + '%</td>' +
                '<td class="text-center">' + estandar + '%</td>' +
                '<td class="text-center">' + Number(resul_dim).toFixed(2) + '%</td>' +
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
                    fontSize: 15
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
            var cadena_info = [];
            var cadena_total = [];
            var cadena_estandar = [];

            for (var i = 0; i < datos.length; i++) {
                var data = datos[i];
                var tabla = data.tabla;
                
                if (tabla_get == data.tabla) {
                    var tab = $(".tabla_" + tabla_get);
                    var total_tabla = $(".total_tabla_" + tabla_get);
                    var total_estandar = $(".total_estandar_" + tabla_get);
                    var total_desviación = $(".total_desviación_" + tabla_get);
                    
                    var total = data.total;
                    var campos_tabla = '<tr>' +
                        '<th class="first-uppercase"><span>' + data.contenido + '</span></th>' +
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
                    cadena_info.push(data.contenido);
                    cadena_total.push(data.result_2);
                    cadena_estandar.push(data.estandar);
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
            var title_color = (value.color == "lila") ? "light" : "dark";

            var color_cabecera = "red";
            var text_cabecera = "light";

            if (value.total >= 25.1) {
                color_cabecera = "dark-yellow";
                text_cabecera = "light";
            }
            if (value.total >= 50.1) {
                color_cabecera = "yellow";
                text_cabecera = "dark";
            }
            if (value.total >= 75.1) {
                color_cabecera = "dark-green";
                text_cabecera = "dark";
            }

            var mapa = '<div class="col-12 col-xl-6 w-auto text-center text-dark" style="max-width:none;">' +
                '<div class="bg-' + value.color + ' text-' + title_color + '  border border-secondary font-weight-bold"><h5 class="mb-0 text-capitalize">' + key + '</h5></div>' +
                '<div class="bg-' + color_cabecera + ' text-' + text_cabecera + ' border border-secondary font-weight-bold">' + value.total + '%</div>' +
                '<div class="row no-gutters flex-nowrap">';

            for (var i = 0; i < datos.length; i++) {

                var data_map = datos[i];
                var constante = data_map.constante;

                if (key == data_map.tabla) {
                    var text_color = (data_map.color == "lila") ? "light" : "dark";

                    var color_contenido = "red";
                    var text_contenido = "light";

                    //cliente colores "compromiso con el cliente"
                    if (data_map.contenido == "compromiso con el cliente" ||
                        data_map.contenido == "Gestión estratégica" ||
                        data_map.contenido == "Procesos inteligentes y adaptables" ||
                        data_map.contenido == "Gestión del talento & Diseño organizacional") {
                        if (parseFloat(data_map.result_2) >= 7.51) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 15.1) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 22.51) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }

                    //cliente colores "experiencia del cliente"
                    if (data_map.contenido == "experiencia del cliente") {
                        if (parseFloat(data_map.result_2) >= 8.76) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 17.51) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 26.26) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }

                    //cliente colores "conocimiento del cliente y comportamiento"
                    if (data_map.contenido == "conocimiento del cliente y comportamiento" ||
                        data_map.contenido == "Aplicaciones" ||
                        data_map.contenido == "Estándares y automatización de procesos" ||
                        data_map.contenido == "Cultura") {
                        if (parseFloat(data_map.result_2) >= 5.1) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 10.1) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 15.1) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }

                    //cliente colores "Confianza y percepción del cliente"
                    if (data_map.contenido == "Confianza y percepción del cliente" ||
                        data_map.contenido == "Gestión de la marca" ||
                        data_map.contenido == "Portafolio, ideación e innovación" ||
                        data_map.contenido == "Gestión de partes interesadas" ||
                        data_map.contenido == "Seguridad" ||
                        data_map.contenido == "Arquitectura tecnológica" ||
                        data_map.contenido == "Gestión ágil del cambio" ||
                        data_map.contenido == "Analíticas e información en tiempo real") {
                        if (parseFloat(data_map.result_2) >= 3.76) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 7.51) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 11.26) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }

                    //Estrategia colores "Gestión de ecosistemas"
                    if (data_map.contenido == "Gestión de ecosistemas" ||
                        data_map.contenido == "Políticas de entregas" ||
                        data_map.contenido == "Liderazgo & Gobierno" ||
                        data_map.contenido == "Habilitación de la fuerza laboral") {
                        if (parseFloat(data_map.result_2) >= 1.26) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 2.51) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 3.76) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }

                    //Estrategia colores "Gestión de ecosistemas"
                    if (data_map.contenido == "Finanzas e inversiones, cartera" ||
                        data_map.contenido == "Clientes & mercados" ||
                        data_map.contenido == "Cosas conectadas" ||
                        data_map.contenido == "Red" ||
                        data_map.contenido == "Gestión automatizada de recursos" ||
                        data_map.contenido == "Gestión de servicios integrados") {
                        if (parseFloat(data_map.result_2) >= 2.51) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 5.1) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 7.51) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }

                    //Estrategia colores "Gestión de ecosistemas"
                    if (data_map.contenido == "Finanzas e inversiones, cartera" || data_map.contenido == "Clientes & mercados") {
                        if (parseFloat(data_map.result_2) >= 2.51) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 5.1) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 7.51) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }

                    //Estrategia colores "Analiticas & datos"
                    if (data_map.contenido == "Analiticas & datos") {
                        if (parseFloat(data_map.result_2) >= 6.26) {
                            color_contenido = "dark-yellow";
                            text_contenido = "light";
                        }
                        if (parseFloat(data_map.result_2) >= 12.51) {
                            color_contenido = "yellow";
                            text_contenido = "dark";
                        }
                        if (parseFloat(data_map.result_2) >= 18.76) {
                            color_contenido = "dark-green";
                            text_contenido = "dark";
                        }
                    }


                    mapa += '<div class="col">' +
                        '<div class="bg-' + data_map.color + ' text-' + text_color + ' border border-secondary p-1 align-middle d-flex align-items-center justify-content-center first-uppercase" style="height: 5em;"><span>' + data_map.contenido + '</span></div>' +
                        '<div class="bg-' + color_contenido + ' text-' + text_contenido + ' border border-secondary">' + data_map.result_2 + '%</div>';

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
                            text_pie = "dark";
                        }
                        if (const_total >= 75.1) {
                            color_pie = "dark-green";
                            text_pie = "dark";
                        }

                        mapa += '<div class="bg-light border border-secondary p-2 d-flex align-items-center" style="height: 20em;min-width:16.2em;">' + prg + '</div>' +
                            '<div class="bg-' + color_pie + ' text-' + text_pie + ' border border-secondary"> ' + const_total + '%</div>';
                    }
                    mapa += '</div>';
                }
            }
            mapa += '</div>' +
                '</div>';
            mapa_calor.append(mapa);
            
        });
        pdf.click(gestionUsuario.generarPDF);
    },
    generarPDF: function (e) {
        var data = {};
        gestionUsuario.consultatgraficas;
        var Canvas = document.getElementById("clientes_grafica");
        console.log(Canvas.toDataURL()); 
    },
};
gestionUsuario.constructor();
