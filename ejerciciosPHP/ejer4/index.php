<?php
    if(!isset($_GLOBAL['activo'])){
      $_GLOBAL['activo'] = 'presentacion';
    }
    include './html/'.$_GLOBAL['activo'].'.php';

?>
