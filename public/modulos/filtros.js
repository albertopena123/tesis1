document.addEventListener('DOMContentLoaded', function() {

    var newPassword = document.getElementById('hs-strong-password-with-indicator-and-hint');
    var newPassword2 = document.getElementById('newPassword2');

    newPassword2.addEventListener('input', function() {
        if (newPassword.value === newPassword2.value) {
            newPassword2.classList.remove('border-danger');
            newPassword2.classList.add('border-success');
        } else {
            newPassword2.classList.remove('border-success');
            newPassword2.classList.add('border-danger');
        }
    });

    var dniInput = document.getElementById('dni');
    var emailInput = document.getElementById('email');
    var socioInput = document.getElementById('socio');
    var errorDiv = document.querySelector('#dni + .invalid-feedback');
    // Verificar si los campos dni y email están vacíos o son null
    if (!dniInput || !emailInput) {
        console.error('Los campos dni y email no fueron encontrados en el DOM.');
        return; // Salir de la función si los campos no están disponibles
    }else {
        dniInput.addEventListener('input', function() {
            var dni = dniInput.value.trim();
    
            // Verificar si el dni tiene 8 dígitos y si el correo no está vacío
            if (dni.length === 8 && /^\d+$/.test(dni) ) {
                var url = '/verificardatos?dni=' + dni ;
    
                fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.registrado) {
                        socioInput.value = 'Usuario ya registrado';
                        errorDiv.style.display = 'block'; // Mostrar el mensaje de error
                    } else {
                        socioInput.value = 'Nuevo usuario';
                        errorDiv.style.display = 'none'; // Ocultar el mensaje de error
                    }                })
                .catch(error => {
                    console.error('Error al verificar datos:', error);
                });
            }
        });
    }
 
  
});
