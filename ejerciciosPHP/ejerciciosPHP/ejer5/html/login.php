<?php
    session_start();
    //$_SESSION['usuario'] = 'Sergio';
    if(isset($_POST['enviar'])){
        $archivo_usuarios = fopen("../user.txt",'r');
        $usuarios = fread($archivo_usuarios, filesize('../user.txt'));
        fclose($archivo_usuarios);
        $usuarios =preg_split("#\s|\n#", $usuarios);
        if(in_array($_POST['usuario'],$usuarios)){
          $i = array_search($_POST['usuario'], $usuarios);
          if(password_verify($_POST['pass'], $usuarios[$i+1])){
            session_start();
            if($_POST['usuario']=='admin')
                $_SESSION['usuario'] = 'admin';
            else
                $_SESSION['usuario'] = $_POST['usuario'];

            $_GLOBAL['error_usuario']=True;
          }
        }
        else{
            $_GLOBAL['error_usuario']=True;
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
            session_start();
            $_SESSION['usuario']= $_POST['usuario_nuevo'];
        }
    }

 ?>
 <?php
 if(!isset($_GLOBAL['activo'])){
   $_GLOBAL['activo'] = 'presentacion';
 }
 header('Location: '.$_GLOBAL['activo'].'.php');
 ?>
