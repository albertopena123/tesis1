function detectarCambio() {
    console.log("Se ha detectado un cambio en el campo de contraseña.");
  }
  
  // Agregar un event listener al campo de contraseña para detectar cambios
  document.getElementById('passwordreal').addEventListener('input', detectarCambio);