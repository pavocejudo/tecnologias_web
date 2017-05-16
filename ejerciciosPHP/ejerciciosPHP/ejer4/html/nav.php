<nav>
  <ul id="indice">
    <li><a href="/ejerciciosPHP/ejer4/html/presentacion.php"  <?php if($_GLOBAL['activo']=='presentacion') echo 'class="activo"'; ?>>Presentación</a></li>
    <li><a href="/ejerciciosPHP/ejer4/html/profesional.php"  <?php if($_GLOBAL['activo']=='profesional') echo 'class="activo"'; ?>>CV profesional</a></li>
    <li><a href="/ejerciciosPHP/ejer4/html/aficiones.php" <?php if($_GLOBAL['activo']=='aficiones') echo 'class="activo"'; ?>>Aficiones</a></li>
    <li><a href="/ejerciciosPHP/ejer4/html/contacto.php"  <?php if($_GLOBAL['activo']=='contacto') echo 'class="activo"'; ?>>Contacto</a></li>
  </ul>
</nav>
    <div class="wrap">
