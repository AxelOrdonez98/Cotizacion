var i = 0;
//crea
$(document).ready(function () {
    $(document).on("click", "#aggregateService", function () {
        Swal.fire({
            title: 'Nueva cotizacion',
            html:
            `<head>
                <link rel="stylesheet" href="../public/css/styleAgregarProducto.css">
            </head>
            <main>
                <label>Concepto:</label>
                <br>
                <textarea id="concept" placeholder=" Ingresa la descripcion del &nbsp;producto" maxlength="150"></textarea>
                <br><br>
                <label>Unidad:</label>
                <br>
                <input type="text" id="unit" placeholder=" Ingresa la unidad">
                <br><br>
                <label>Cantidad: </labe>
                <br>
                <input type="number" id="cant"></input>
                <br><br>
                <label>Ingresa el precio unitario: </label>
                <br>
                <input type="number" id="price"></input>
            </main>`,
            confirmButtonText: 'Crear',
            focusConfirm: true,
            preConfirm: () => {
                const concept = Swal.getPopup().querySelector('#concept').value
                const unit = Swal.getPopup().querySelector('#unit').value
                const cant = Swal.getPopup().querySelector('#cant').value
                const price = Swal.getPopup().querySelector('#price').value
                if (!concept || !unit || !cant || !price) {
                    Swal.showValidationMessage(`Por favor llene todos los campos`)
                }
                return { concept: concept, unit: unit, cant: cant, price: price }
            }
        }).then((result) => {
            var total;
            const concept = result.value.concept;
            const unit = result.value.unit;
            const cant = result.value.cant;
            const price = result.value.price;
            total = cant * price;
            var fila =
                '<tr id="row' + i + '" class="general" >' +
                '<td class="oculto concept" id="concept">' + concept + '</td>' +
                '<td class="unit" id="unit">' + unit + '</td>' +
                '<td class="cant" id="cant">' + cant + '</td>' +
                '<td class="price" id="price">' + price + '</td>' +
                '<td class="sumaParaTotal" id="sumaParaTotal">' + total + '</td>' +
                '<td class="tdDeBorrar"><div class="iconDelete"><img src="../public/img/eliminar.png" class="remove" id="' + i + '"></div></td></tr>'
            i++;
            $('#mainTable .rowSubtotal').before(fila);
            mostrarTotal();
        })
    });
    $(document).on('click', '.remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
        mostrarTotal();
    });

    //Editar
    $(document).on('click', 'td:not(".tdDeBorrar")', function () {
        var editTr = $(this).parent()[0];
        var description = $(editTr).find(".concept").html();
        var cant = $(editTr).find(".unit").html();
        var uni = $(editTr).find(".cant").html();
        var precioUnitario = $(editTr).find(".price").html();
        var id = $(editTr).attr("id");
        console.log(id);
        Swal.fire({
            title: 'Editar ',
            html:
            `<head>
                <link rel="stylesheet" href="../public/css/styleAgregarProducto.css">
            </head>
            <main>
                <label>Concepto:</label>
                <br>
                <textarea data-id="` + id + `" id="concept" placeholder="Ingresa la descripcion del producto" maxlength="150">` + description + `</textarea>
                <br><br>
                <input type="text" id="ponerId" value="` + id + `" style="display:none">
                <label>Unidad:</label>
                <br>
                <input type="text" id="unit" placeholder="Ingresa la unidad" value="` + cant + `">
                <br><br>
                <label>Cantidad: </labe>
                <br>
                <input type="number" id="cant" value="`+ uni + `"></input>
                <br><br>
                <label>Ingresa el precio unitario: </label>
                <br>
                <input type="number" id="price" value="`+ precioUnitario + `"></input>
            </main>`,
            confirmButtonText: 'Guardar',
            focusConfirm: true,
            preConfirm: () => {
                const ponerId = Swal.getPopup().querySelector('#ponerId').value;
                const concept = Swal.getPopup().querySelector('#concept').value;
                const unit = Swal.getPopup().querySelector('#unit').value;
                const cant = Swal.getPopup().querySelector('#cant').value;
                const price = Swal.getPopup().querySelector('#price').value;
                if (!concept || !unit || !cant || !price) {
                    Swal.showValidationMessage(`Por favor llene todos los campos`);
                }
                return { id: ponerId, concept: concept, unit: unit, cant: cant, price: price }
            }
        }).then((result) => {
            var total;
            const idModi = result.value.id;
            console.log(idModi);
            const concept = result.value.concept;
            const unit = result.value.unit;
            const cant = result.value.cant;
            const price = result.value.price;
            total = cant * price;
            $("#" + idModi + "").find("#concept").html(concept);
            console.log(concept);
            $("#" + idModi + "").find("#unit").html(unit);
            $("#" + idModi + "").find("#cant").html(cant);
            $("#" + idModi + "").find("#price").html(price);
        });
    });
//muestra totales
    function mostrarTotal() {
        var subTotal = 0;
        var iva = 0;
        var totalTotal = 0;
        var ivaDecimales = 0;
        var totalDecimales = 0;
        $('.sumaParaTotal').each(function () {
            var total = $(this).html();
            total = parseFloat(total);
            subTotal += total;
        });
        iva = subTotal * .16;
        totalTotal = iva + subTotal;

        ivaDecimales = iva.toFixed(4);
        totalDecimales = totalTotal.toFixed(4);
        subTotal = subTotal.toFixed(4);

        $("#subTotal").html(subTotal);
        $("#iva").html(ivaDecimales);
        $("#total").html(totalDecimales);
    }
})