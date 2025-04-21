<?php
// mapa_delincuentes.php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php"); exit();
}
?>
<?php include('inc/header.php'); ?>
<div class="wrapper">
  <div class="content">
    <h2>Mapa de Delincuentes</h2>
    <div id="map" style="height:500px;width:100%;"></div>
  </div>
  <?php include('inc/footer.php'); ?>
</div>
<script>
  function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: { lat: -33.4489, lng: -70.6693 }
    });
    fetch('api/get_delincuentes.php')
      .then(r => r.json())
      .then(data => {
        data.forEach(d => {
          new google.maps.Marker({
            position: { lat: parseFloat(d.latitud), lng: parseFloat(d.longitud) },
            map,
            title: `${d.apellidos_nombres}\nÚltimo lugar: ${d.ultimo_lugar_visto}`
          });
        });
      });
  }
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASzCby4df8if-vnMHTMs-KVaAqoYjcA-g&callback=initMap">
</script>
