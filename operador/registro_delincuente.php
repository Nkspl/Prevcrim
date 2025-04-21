<?php
// operador/registro_delincuente.php
session_start();
if (!isset($_SESSION['user_id'])||$_SESSION['rol']!=='operador'){
  header("Location: ../index.php");exit();
}
require_once '../config.php';
?>
<?php include('../inc/header.php'); ?>
<div class="wrapper">
  <div class="content">
    <h2>Registro de Delincuentes</h2>
    <?php if(isset($_GET['msg'])) echo "<p class='msg'>".htmlspecialchars($_GET['msg'])."</p>"; ?>
    <form action="process_registro_delincuente.php" method="post">
      <div class="form-group">
        <label for="rut">RUT:</label>
        <input id="rut" name="rut" required>
      </div>
      <div class="form-group">
        <label for="nombre">Apellidos y Nombres:</label>
        <input id="nombre" name="nombre" required>
      </div>
      <div class="form-group">
        <label for="apodo">Apodo:</label>
        <input id="apodo" name="apodo">
      </div>
      <div class="form-group">
        <label for="domicilio">Domicilio:</label>
        <input id="domicilio" name="domicilio" required>
      </div>
      <div class="form-group">
        <label for="ultimo_lugar">Último Lugar Visto:</label>
        <input id="ultimo_lugar" name="ultimo_lugar" required>
      </div>
      <div class="form-group">
        <label for="fono">Fono Fijo:</label>
        <input id="fono" name="fono">
      </div>
      <div class="form-group">
        <label for="celular">Celular:</label>
        <input id="celular" name="celular">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
      </div>
      <div class="form-group">
        <label for="delitos">Delitos:</label>
        <textarea id="delitos" name="delitos"></textarea>
      </div>
      <div class="form-group">
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
          <option value="P">Preso</option>
          <option value="L">Libre</option>
          <option value="A">Orden de Arresto</option>
        </select>
      </div>
      <div class="form-group">
        <label for="latitud">Latitud:</label>
        <input id="latitud" name="latitud" placeholder="Ej: -33.4489" required>
      </div>
      <div class="form-group">
        <label for="longitud">Longitud:</label>
        <input id="longitud" name="longitud" placeholder="Ej: -70.6693" required>
      </div>
      <button type="submit">Registrar Delincuente</button>
    </form>
  </div>
  <?php include('../inc/footer.php'); ?>
</div>
