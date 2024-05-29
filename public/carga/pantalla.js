window.addEventListener('load', function() {
  var overlay = document.getElementById('loading-overlay');
  overlay.style.backgroundColor = 'rgba(255, 255, 255, 0.7)'; // Hace el fondo semitransparente
  setTimeout(function() {
    overlay.style.display = 'none'; // Oculta el overlay después de 3 segundos
  }, 100);
});
