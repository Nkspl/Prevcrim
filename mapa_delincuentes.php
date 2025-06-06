<?php
// mapa_delincuentes.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<?php include 'inc/header.php'; ?>
<div class="wrapper">
  <div class="content">
    <h2>Mapa de Delincuentes</h2>

    <!-- Formulario de Búsqueda -->
    <div class="map-search">
      <label for="searchRut">RUT:</label>
      <input type="text" id="searchRut" placeholder="Ej: 12.345.678-5">
      <label for="searchNombre">Nombre:</label>
      <input type="text" id="searchNombre" placeholder="Apellido o Nombre">
      <label for="searchApodo">Apodo:</label>
      <input type="text" id="searchApodo" placeholder="Apodo">
      <button id="searchBtn">Buscar</button>
      <button id="resetBtn">Mostrar Todos</button>
    </div>

    <!-- Contenedor del mapa -->
    <div id="map" style="height:500px;"></div>
  </div>
  <?php include 'inc/footer.php'; ?>
</div>

<script>
let map;
let markers = [];

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: { lat: -33.4489, lng: -70.6693 }
  });
  loadMarkers(); 
}

function clearMarkers() {
  markers.forEach(m => m.setMap(null));
  markers = [];
}

function loadMarkers(filters = {}) {
  const qs = new URLSearchParams(filters).toString();
  fetch('api/get_delincuentes.php' + (qs ? '?' + qs : ''))
    .then(r => r.json())
    .then(data => {
      clearMarkers();
      data.forEach(d => {
        const pos = { lat: parseFloat(d.latitud), lng: parseFloat(d.longitud) };
        const marker = new google.maps.Marker({
          position: pos,
          map,
          title: `${d.apellidos_nombres} (${d.rut})\nApodo: ${d.apodo}\nÚltimo lugar: ${d.ultimo_lugar_visto}`
        });
        markers.push(marker);
      });
      if (markers.length) {
        const bounds = new google.maps.LatLngBounds();
        markers.forEach(m => bounds.extend(m.getPosition()));
        map.fitBounds(bounds);
      }
    });
}

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('searchBtn').addEventListener('click', () => {
    const rut    = document.getElementById('searchRut').value.trim();
    const nombre = document.getElementById('searchNombre').value.trim();
    const apodo  = document.getElementById('searchApodo').value.trim();
    loadMarkers({ rut, nombre, apodo });
  });
  document.getElementById('resetBtn').addEventListener('click', () => {
    document.getElementById('searchRut').value = '';
    document.getElementById('searchNombre').value = '';
    document.getElementById('searchApodo').value = '';
    loadMarkers();
  });
});
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASzCby4df8if-vnMHTMs-KVaAqoYjcA-g&callback=initMap">
</script>









