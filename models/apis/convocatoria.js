$(document).on("click", ".verCoti", function () {
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
})

function get_cotizaciones() {
    cleanCanvas();
    $(".mainContainer").html("<table id='apisTable' class='display dataTable' style='width:100%'><thead><tr><th>#Cotizacion</th><th>Fecha</th><th>Correo</th><th>Depencia</th><th>Obra</th><th>Lugar</th><th>Ciudad</th><th>Nombre</th></thead></table>");
    $('#apisTable').DataTable({
        paging: true,
    "processing": true,
        responsive: true,
        select: 'single',
        'ajax': {
            'url':'../../model/colaborador/apisConvocatoria/get_convocatorias.php',
            'data': {'type': type},
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
                "defaultContent": "<button class='buttonEdit buttonEditConvocatoria'></button><button class='buttonDelete buttonDeleteConvocatoria'></button><button class='buttonPlazasC buttonShowPlazas'></button>"
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