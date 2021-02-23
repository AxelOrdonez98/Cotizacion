$(document).on("click", ".ingresar", function () {

    var userEmail = $("#email").val();
    var userPassword = $("#password").val();

    $.ajax({
        url: 'models/loginValidate.php',
        type: 'POST',
        data: { userEmail: userEmail, userPassword: userPassword },
    })
        .done(function (respuesta) {
            console.log(respuesta);
            if (respuesta == true) {
                window.location = "views/priceCreationIndex.php";
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Revisa tus credenciales',
                })
            }
        })
        .fail(function () {
            console.log("error");
        })

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
});