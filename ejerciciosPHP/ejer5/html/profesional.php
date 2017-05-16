<?php $_GLOBAL['activo']='profesional';
include 'cabecera.html' ;
include 'nav.php';
?>
  <h1>Curriculum Vitae</h1>
  <hr>
  <ul id="curriculum">
    <li id="formacion">
      <a href="#formacion">Formación</a>
      <ul id="formacion" class="desplegable">
        <li>1999-2009: Estudios de primaria y secundaria en Sagrado Corazón de Jesús</li>
        <li>2009-2011 :Estudios de Bachillerato en IES Trevenque</li>
        <li>2012-2013: Primer año del doble grado en Ingeniería Informática y Matemáticas en la UGR</li>
        <li>2013-actualidad: Grado en Ingeniería Informática en la UGR</li>
      </ul>
    </li>
    <li id="Cursos_impartidos">
      <a href="#Cursos_impartidos">Cursos impartidos</a>
      <ul id="cursos" class="desplegable">
        <li>Diseño y publicación de páginas web. Duración: 600 horas</li>
        <li>Drupal Camp 2015</li>
        <li>Google Hash Code 2017</li>
        <li>PyDay 2016</li>
      </ul>
    </li>
    <li id="Destrezas">
      <a href="#Destrezas">Destrezas</a>
      <ul id="destrezas" class="desplegable">
        <li>Conocimientos en ofimática nivel avanzado</li>
        <li>Nivel B2 de Inglés</li>
        <li>Conocimientos de programación en lenguajes como C++, C, CSS, HTML, Java, JavaScript, PHP, Python, SQL.</li>
      </ul>
    </li>
  </ul>
<?php include 'pie.html';?>
