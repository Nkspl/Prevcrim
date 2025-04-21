<?php
// reportes.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once 'config.php';
$stmt = $pdo->query("SELECT rut, apellidos_nombres, estado FROM delincuente ORDER BY apellidos_nombres ASC");
$delincuentes = $stmt->fetchAll();
?>
<?php include('inc/header.php'); ?>
<div class="wrapper">
  <div class="content">
    <h2>Listado de Delincuentes (Alfabético)</h2>
    <table>
      <thead>
        <tr><th>RUT</th><th>Nombre</th><th>Estado</th></tr>
      </thead>
      <tbody>
        <?php foreach ($delincuentes as $d): ?>
        <tr>
          <td><?php echo htmlspecialchars($d['rut']); ?></td>
          <td><?php echo htmlspecialchars($d['apellidos_nombres']); ?></td>
          <td><?php echo htmlspecialchars($d['estado']); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <h3>Búsqueda</h3>
    <form method="get" action="buscar.php">
      <input type="text" name="q" placeholder="Buscar..." required>
      <button type="submit">Buscar</button>
    </form>
  </div>
  <?php include('inc/footer.php'); ?>
</div>
