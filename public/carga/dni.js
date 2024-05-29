document.addEventListener('DOMContentLoaded', function() {
    // Obtenemos el campo del DNI y el campo del socio
    var dniInput = document.getElementById('dni');
    var socioInput = document.getElementById('socio');
    var id_user = document.getElementById('id');
    var apellidom = document.getElementById('apellidom');
    var apellidop = document.getElementById('apellidop');
    var nombresfinal = document.getElementById('nombresfinal');
    var alertadni = document.getElementById('alertadni');
    var errorDiv = document.querySelector('#dni + .invalid-feedback');
    var placanumero = document.getElementById('placanumero');
    var enviarcarnet = document.getElementById('enviarcarnet');

    function evaluarPlaca() {
        // Obtener el valor del campo de entrada
        var valor = placanumero.value;

        // Verificar si la longitud del valor es igual a 8
        if (valor.length === 8) {
            // Si es igual a 8, aplicar estilos de borde verde
            placanumero.style.borderColor = 'green';
        } else {
            // Si no es igual a 8, restablecer el color del borde
            placanumero.style.borderColor = '';
        }
    }

    placanumero.addEventListener('input', evaluarPlaca);

    // Agregamos un evento de entrada al campo del DNI para detectar cuando se ingresen 8 números
    dniInput.addEventListener('input', function() {
        var dni = dniInput.value.trim();
        var url = '/obtenerDatosSocio?dni=' + dni;

        // Si se han ingresado 8 números, realizamos la solicitud AJAX GET
        if (dni.length === 8 && /^\d+$/.test(dni)) {
            // Realizamos una solicitud AJAX GET al controlador
            fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Actualizamos el campo del socio con los datos obtenidos del controlador
                socioInput.value = data.nombre + ' '+ data.apellidop + ' '+ data.apellidom;
                id_user.value = data.user_socio;
                apellidom.value = data.apellidom;
                apellidop.value = data.apellidop;
                nombresfinal.value = data.nombre;

                if (data.user_id) {
                    alertadni.value = 'Usuario ya registrado';
                    errorDiv.style.display = 'block'; // Mostrar el mensaje de error
                    enviarcarnet.disabled = true; // Deshabilitar el botón
                } else {
                    alertadni.value = 'Nuevo usuario';
                    errorDiv.style.display = 'none'; // Ocultar el mensaje de error
                    enviarcarnet.disabled = false; // Habilitar el botón
                } 
            })
            .catch(error => {
                console.error('Error al obtener datos del socio:', error);
            });
        }
    });
});
