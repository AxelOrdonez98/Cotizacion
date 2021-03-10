$(document).ready(function() {
    get_cotizaciones();
});

const Notification = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 7000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
function get_cotizaciones() {
    cleanCanvas();
    $(".mainContainer").html("<table id='apisTable' class='display dataTable' style='width:100%'><thead><tr><th data-priority='1'>#</th><th data-priority='1'>Nombre</th><th data-priority='1'>Fecha</th><th data-priority='3'>Correo</th><th data-priority='3'>Dependecia</th><th data-priority='3'>Obra</th><th data-priority='3'>Direccion</th><th data-priority='3'>Ciudad</th><th data-priority='1'></th></thead></table>");
    $('#apisTable').DataTable({
        paging: true,
    "processing": true,
        responsive: true,
        select: 'single',
        'ajax': {
            'url':'../models/apis/get_quotes.php',
            'type': 'POST',
        },
        'columns': [
            { data: 'nCotizacion' },
            { data: 'nombre' },
            { data: 'fecha' },
            { data: 'correo' },
            { data: 'dependecia' },
            { data: 'obra' },
            { data: 'lugar' },
            { data: 'ciudad' },
            {
                "data": "opciones",
                "defaultContent": "<button class='button buttonDownload'></button>"
            }
        ],
        dom: 'Bfrtip',
        buttons: {
            dom: {
              button: {
                className: ''
              }
            },
            buttons: [
                {   
                    className: 'buttonAdd buttonAddConvocatoria',
                },
                {
                    extend: 'excel',
                    text: '',
                    className: 'buttonExcel',
                  },
            ]
          },
        language: {
            searchPlaceholder: "Busqueda",
            search: "",
            className: "searchBar",
        }
    });
    $('.dataTables_filter label input').addClass("searchBar");
}
function cleanCanvas () {
    $(".mainContainer").html("");
}

$(document).on("click", ".buttonDownload", function () {
    var tr = $(this).parent().parent();
    var table = $('#apisTable').DataTable();
    var rowData = table.row(tr).data();
    var id_quotation = rowData["nCotizacion"];
    var url = "../models/apis/get_quotes_download.php?id_quotation="+id_quotation+"";
    window.open(url);
});