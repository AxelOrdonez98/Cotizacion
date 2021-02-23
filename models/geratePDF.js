$(document).on("click", "#generatePDF", function () {
    var nombreCliente = $("#inputName").val();
    var emailCliente = $("#inputEmail").val();
    var dependenciaCliente = $("#inputDepence").val();
    var obraCliente = $("#inputObra").val();
    var direccionCliente = $("#inputPlace").val();
    var ciudadCliente = $("#inputCity").val();
    var fecha = $("#inputDate").val();

    var subTotal = $("#subTotal").html();
    var iva = $("#iva").html();
    var total = $("#total").html();

    if (!nombreCliente || !emailCliente || !dependenciaCliente || !obraCliente || !direccionCliente || !ciudadCliente || !fecha) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor llene todos los campos'
        })
    }
    else {
        var tablaJson = '"tabla":['
        $(".general").each(function () {
            tablaJson += '{';
            var tdId = $(this).attr("id");
            $("#" + tdId + " > td:not(:last-child)").each(function () {
                var info = $(this).attr("id");
                var valor = $(this).html();
                if (info == "sumaParaTotal") {
                    tablaJson += '"' + info + '":"' + valor + '"';
                }
                else {
                    tablaJson += '"' + info + '":"' + valor + '",';
                }

            });
            tablaJson += '},';
        });
        tablaJson = tablaJson.slice(0, -1);
        tablaJson += ']';
        console.log(tablaJson);
        var pdf = '{"nombreCliente":"' + nombreCliente + '", "emailCliente":"' + emailCliente + '",  "dependenciaCliente":"' + dependenciaCliente + '", "obraCliente":"' + obraCliente + '", "direccionCliente":"' + direccionCliente + '", "ciudadCliente":"' + ciudadCliente + '", "fecha":"' + fecha + '", ' + tablaJson + ', "subtotal":"' + subTotal + '", "iva":"' + iva + '", "total":"' + total + '"  }';
        console.log(JSON.parse(pdf));
        $.ajax({
            url: '../models/pdf.php',
            method: 'POST',
            data: pdf,
        })
        .done(function (respuesta) {
            console.log(respuesta);
            Swal.fire({
                icon: 'success',
                title: 'El PDF se ha generado'
            })
        })
        .fail(function (respuesta) {
            console.log("error");
            console.log(respuesta);
        })
    }
});