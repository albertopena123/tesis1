
// detectorInput.js
function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview');
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]); // Convierte el archivo a una URL base64
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('dni');

    input.addEventListener('input', function(event) {
        var dni = event.target.value;
        if (dni.length === 8) {
             
            // URL base de la API
            const apiUrlBase = 'https://dniruc.apisperu.com/api/v1/dni/';

            // Construir la URL completa de la API con el valor del DNI
            var apiUrl = apiUrlBase + dni + '?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFwZW5hbUB1bmFtYWQuZWR1LnBlIn0.BsOzf5k5fsxCmDwO5sV-QfuKg0sFgiGFIImRKmWSBko';

            // Realizar la solicitud a la API utilizando fetch()
            fetch(apiUrl)
                .then(response => {
                    // Verificar si la respuesta de la API es exitosa (código 200)
                    if (!response.ok) {
                        throw new Error('No se pudo obtener la información');
                    }
                    // Convertir la respuesta a formato JSON
                    return response.json();
                })
                .then(data => {
                    // Acceder a los datos y guardarlos en variables
                    const dni = data.dni;
                    const nombres = data.nombres;
                    const apellidoPaterno = data.apellidoPaterno;
                    const apellidoMaterno = data.apellidoMaterno;
                    const codVerifica = data.codVerifica;
                    
                    // Ejemplo de uso de los datos guardados en variables
                    document.getElementById('nombre').value = data.nombres;
                    document.getElementById('apellidop').value = data.apellidoPaterno;
                    document.getElementById('apellidom').value = data.apellidoMaterno;
                })
                .catch(error => {
                    // Manejar errores
                    console.error('Error:', error);
                });
        
            } else {
                console.log('El input no tiene 8 caracteres.');
            }
            });

        // URL de la API
  



});
