<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
        session_unset();
        session_destroy();
    }
    if(!isset($_GLOBAL['activo'])){
      $_GLOBAL['activo'] = 'presentacion';
    }
    header('Location: '.$_GLOBAL['activo'].'.php');
?>
