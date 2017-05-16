<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Obtener datos bibliográficos</title>
    <style media="screen">
      .libro{
        text-align: center;
        border: 2px solid red;
        margin: 0 auto;
      }

    </style>
  </head>
  <body>
    <?php
      if(isset($_GET['isbn']) and $_GET['isbn']!=''){
        if($_GET['web']=='worldcat'){
          $timeout = 5;
          $url = 'http://www.worldcat.org/search?qt=worldcat_org&q='.$_GET['isbn'].'&submit=Search';
          $ch = curl_init();
          /*Curl Options */
          curl_setopt($ch,CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
          curl_setopt($ch, CURLOPT_USERAGENT, 'ejer 3 php cUrl request');
          $html = curl_exec($ch);
          curl_close($ch);

          $dom = new DOMDocument('1.0', 'UTF-8');

          @$dom->loadHTML($html);  //@ para evitar warnings de parseo en loadHTML

          /* Obtener autor, titulo, editorial y año de publicación */
          $dictionary = $dom->getElementsByTagName('div');
          foreach ($dictionary as $word) {
            switch ($word->getAttribute('class')) {
              case 'name':
                $nombre = $word->nodeValue;
                break;
              case 'author':
                $autores = $word->nodeValue;
                break;
              case 'publisher':
                $datos_edicion = $word->nodeValue;
                break;
              default:
                break;
            }
            if(isset($nombre, $autores, $datos_edicion)) break;
          }
          $autores = str_replace('by ','',$autores); //Eliminar 'By ' del texto
          $datos_edicion = preg_split('#,#',preg_split('#:#',$datos_edicion)[2]);
          $editorial = $datos_edicion[0];
          $anio_publicacion = $datos_edicion[1];

        }
        else if($_GET['web']=='GoogleApi'){
          $timeout = 5;
          $url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:'.$_GET['isbn'];
          $ch = curl_init();
          /*Curl Options */
          curl_setopt($ch,CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
          curl_setopt($ch, CURLOPT_USERAGENT, 'ejer 3 php cUrl request');
          $json = curl_exec($ch);
          curl_close($ch);

          $datos_libro = json_decode($json);

          $autores = $datos_libro->items[0]->volumeInfo->authors;
          $nombre = $datos_libro->items[0]->volumeInfo->title;
          $editorial = $datos_libro->items[0]->volumeInfo->publisher;
          $anio_publicacion = $datos_libro->items[0]->volumeInfo->publishedDate;
        }
        if(isset($autores,$nombre,$editorial,$anio_publicacion)){
          echo '<div class="libro">';
          echo 'Titulo: '.$nombre.'<br>';
          if(is_array($autores)){ echo 'Autores: ';foreach($autores as $autor) echo $autor;}
          else echo 'Autor: '.$autores;
          echo '<br>Editorial: '.$editorial.'<br> Año de publicación: '.$anio_publicacion;
          echo '</div>';
        }
      }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
      <input type="radio" name="web" value="GoogleApi" checked>Google Api <br>
      <input type="radio" name="web" value="worldcat">WorldCat<br>
      Introduce un ISBN: <input type="text" name="isbn" placeholder="isbn">
      <input type="submit" name="enviar" value="Buscar">
    </form>
  </body>
</html>
