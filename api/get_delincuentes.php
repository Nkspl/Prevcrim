<?php
// api/get_delincuentes.php
require_once '../config.php';
header('Content-Type: application/json');
$stmt = $pdo->query(
  "SELECT id, apellidos_nombres, ultimo_lugar_visto, latitud, longitud
   FROM delincuente
   WHERE latitud IS NOT NULL AND longitud IS NOT NULL"
);
echo json_encode($stmt->fetchAll());
