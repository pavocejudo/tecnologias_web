<?php
    session_start();
    //$_SESSION['usuario'] = 'Sergio';
    /*if(!isset($_SESSION)){
        if(isset($_POST['enviar'])){
            echo 'Enviar';
            $archivo_usuarios = fopen("../user.txt",'r');
            $usuarios = fread($archivo_usuarios, filesize('../user.txt'));
            fclose($archivo_usuarios);
            $usuarios =preg_split("#\s|\n#", $usuarios);
            print_r($usuarios);
            if(in_array($_POST['usuario'],$usuarios)){
              $i = array_search($_POST['usuario'], $usuarios);
              if(password_verify($_POST['pass'], $usuarios[$i+1])){
                session_start();
                $_SESSION['usuario'] = $_POST['usuario'];
                echo $_POST['usuario'];
              }
            }
        }
        else if(isset($_POST['nuevo_user'])){
            echo 'nuevo user';
            $nombre_archivo = '../user.txt';
            $user_file = fopen($nombre_archivo,'a');
            if(is_writable($nombre_archivo)){
                if(!$user_file){
                    echo "No se pudo abrir el fichero\n";
                    exit;
                }
                $nuevo_registro = $_POST['usuario_nuevo'].' '. password_hash($_POST['nueva_pass'],PASSWORD_DEFAULT)."\n";
                if(!fwrite($user_file,$nuevo_registro)){
                    echo "No se pudo registrar\n";
                    exit;
                }
                $_SESSION['usuario']= $_POST['usuario_nuevo'];
            }
        }
    }*/
 ?>
<nav>
  <ul id="indice">
    <li><a href="/ejerciciosPHP/ejer5/html/presentacion.php"
      <?php if($_GLOBAL['activo']=='presentacion') echo 'class="activo"'; ?>>Presentación</a></li>
    <li><a href="/ejerciciosPHP/ejer5/html/profesional.php"
      <?php if($_GLOBAL['activo']=='profesional') echo 'class="activo"'; ?>>CV profesional</a></li>
    <li><a href="/ejerciciosPHP/ejer5/html/aficiones.php"
      <?php if($_GLOBAL['activo']=='aficiones') echo 'class="activo"'; ?>>Aficiones</a></li>
    <li><a href="/ejerciciosPHP/ejer5/html/contacto.php"
      <?php if($_GLOBAL['activo']=='contacto') echo 'class="activo"'; ?>>Contacto</a></li>
    <?php if(isset($_SESSION['usuario']) and $_SESSION['usuario']=='admin'){ ?><li><a href="/ejerciciosPHP/ejer5/html/administrar.php"
        <?php if($_GLOBAL['activo']=='contacto') echo 'class="activo"'; ?>>Administración</a></li> <?php } ?>
  </ul>
  <?php
    if(isset($_SESSION['usuario'])){
      echo '<div class="usuario_registrado">Bienvenido '.$_SESSION['usuario'].'. <a href="editar.php">Editar</a>. <a href="logout.php">Salir</a></div>';

    }
    else{
      echo 'Formulario';
  ?>
  <form class="registro" method="post" action="login.php">
    <input type="text" name="usuario" placeholder="Usuario" <?php if(isset($_GLOBAL['usuario'])) if($_GLOBAL['error_usuario']) echo 'class="error"';?>>
    <input type="password" name="pass" placeholder="Contraseña" <?php if(isset($_GLOBAL['usuario']))if($_GLOBAL['error_usuario']) echo 'class="error"';?>>
    <input type="submit" name="enviar" value="Enviar">
  </form>
  <form class="registro" method="post" action = "login.php">
      <input type="text" name="usuario_nuevo" placeholder="nuevo usuario">
      <input type="password" name="nueva_pass" placeholder="nueva contraseña">
      <input type="submit" name="nuevo_user" value="Nuevo usuario">
  </form>
  <?php } ?>
</nav>
    <div class="wrap">
