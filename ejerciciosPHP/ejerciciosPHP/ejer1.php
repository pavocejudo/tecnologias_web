<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Generar tabla HTML</title>
    <style media="screen">
      table,th, td{
        text-align: left;
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
      }
    </style>
  </head>
  <body>
    <?php
      $navegadores = array(
        'Chrome'=>array('autor'=>'Google', 'licencia'=>'BSD','motor'=>'Blink'),
        'Internet Explorer'=>array('autor'=>'Microsoft', 'licencia'=>'privativo','motor'=>'Trident'),
        'Mozilla'=>array('autor'=>'Fundacion Mozilla', 'licencia'=>'GNU GPL','motor'=>'Gecko'),
        'Opera'=>array('autor'=>'Opera Software', 'licencia'=>'privativo','motor'=>'Blink'),
        'Safari'=>array('autor'=>'Apple', 'licencia'=>'privativo','motor'=>'Webkit')
      );

      echo "<table><tr><th>Navegador</th><th>Autor</th><th>Licencia</th><th>Motor</th></tr>";
      foreach($navegadores as $i => $valor){
          echo "<tr><td>$i</td> <td>{$navegadores[$i]['autor']}</td> <td>{$navegadores[$i]['licencia']}</td> <td>{$navegadores[$i]['motor']}</td></tr>";
      }
      echo "</table>";
    ?>
  </body>
</html>
