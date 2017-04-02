<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Suscripciones</title>
    <style media="screen">
      .error{
        border-color: red;
      }
      .mensaje-error{
        background-color: red;
        color: white;
      }
    </style>
  </head>
  <body>
<?php
  $vector_errores = array();
    function comprobar($datos){
      $errores = array();
      if($datos['Nombre']=='')
        array_push($errores,'Nombre');
      if($datos['Apellidos']== "")
        array_push($errores,'Apellidos');
      if($datos['Direccion']=="")
        array_push($errores,'Direccion');
      if($datos['Fecha_de_nacimiento']!='')
        if(!preg_match("#([0-9]{1,2}[-|/]){2}[0-9]{1,2}#", $datos['Fecha_de_nacimiento'])){
          array_push($errores,'Fecha_de_nacimiento');
        }
      if($datos['Telefono']!='')
        if(!preg_match('#(\+[0-9]{2})?[0-9]{3}(\ |-)?[0-9]{3}(\ |-)?[0-9]{3}#', $datos['Telefono'])){ #Formato +34 958 123 456
          array_push($errores,'Telefono');
          }

      if($datos['Email']!=''){
        if(!preg_match('#\w+@\w+(\.\w+)?\.\w{2,}#', $datos['Email']))
          array_push($errores,'Email');
      }else
        array_push($errores,'Email');
      if($datos['Numero_CC']!=''){
        if(!preg_match('#(\d{4}(\ |-)?){3}\d{4}#', $datos['Numero_CC']))
          array_push($errores,'Numero_CC');
      }else
        array_push($errores,'Numero_CC');

      if(!isset($datos['Revista']))
        array_push($errores,'Revista');
      if(!isset($datos['Tipo']))
        array_push($errores,'Tipo');
      if(!isset($datos['Pago']))
        array_push($errores,'Pago');


      return $errores;
    }
    if(isset($_GET) and count($_GET)>0 ){
      echo "<p>Variables GET: </p>";
      echo "<ul>";
      foreach ($_GET as $c => $v){
        if (is_array($v)){
          echo "<li>$c= ";
          print_r($v);
          echo "</li>";
        } else{
          echo "<li>$c = $v</li>";
        }
      }
      echo "</ul>";
      $vector_errores = comprobar($_GET);
    }

    else if(isset($_POST) and count($_POST)>0){
      echo "<p>Variables POST: </p>";
      echo "<ul>";
      foreach ($_POST as $c => $v){
        if(is_array($v)){
          echo "<li>$c = ";
          print_r($v);
          echo "</li>";
        }else{
          echo "<li>$c = $v</li>";
        }
      }
      echo "</ul>";
     $vector_errores = comprobar($_POST);
    }

    if((isset($vector_errores) and count($vector_errores>0)) or (count($_GET)==0 and count($_POST)==0)){
?>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <fieldset>
        <legend>Información personal</legend>
        Nombre: <input type="text" name="Nombre"
          <?php if(in_array('Nombre',$vector_errores))
                    echo 'class="error"';
                else if(isset($_GET['Nombre']))
                    echo 'value="'.$_GET["Nombre"].'"';
                else if(isset($_POST['Nombre']))
                    echo 'value="'.$_POST["Nombre"].'"'; ?>><br>
        Apellidos: <input type="text" name="Apellidos" size="20"
        <?php if(in_array('Apellidos',$vector_errores))
                echo 'class="error"';
              else if(isset($_GET['Apellidos']))
                echo 'value="'.$_GET["Apellidos"].'"';
              else if(isset($_POST['Apellidos']))
                echo 'value="'.$_POST["Apellidos"].'"'; ?>><br>
        Dirección postal: <input type="text" name="Direccion" size="40"
          <?php if(in_array('Direccion',$vector_errores))
              echo 'class="error"';
            else if(isset($_GET['Direccion']))
              echo 'value="'.$_GET["Direccion"].'"';
            else if(isset($_POST['Direccion']))
              echo 'value="'.$_POST["Direccion"].'"'; ?>><br>
        Fecha de nacimiento: <input type="date" name="Fecha_de_nacimiento"
          <?php
            if(in_array('Fecha_de_nacimiento',$vector_errores))
              echo 'class="error"';
            else if(isset($_GET['Fecha_de_nacimiento']))
              echo 'value="'.$_GET["Fecha_de_nacimiento"].'"';
            else if(isset($_POST['Fecha_de_nacimiento']))
              echo 'value="'.$_POST["Fecha_de_nacimiento"].'"';
          ?>><br>
        Teléfono: <input type="tel" maxlength="12" name="Telefono"
          <?php if(in_array('Telefono',$vector_errores))
                  echo 'class="error"';
                else if(isset($_GET['Telefono']))
                  echo 'value="'.$_GET["Telefono"].'"';
                else if(isset($_POST['Telefono']))
                  echo 'value="'.$_POST["Telefono"].'"'; ?>><br>
        Email: <input type="email" name="Email"
          <?php if(in_array('Email',$vector_errores))
              echo 'class="error"';
            else if(isset($_GET['Email']))
              echo 'value="'.$_GET["Email"].'"';
            else if(isset($_POST['Email']))
              echo 'value="'.$_POST["Email"].'"'; ?>><br>
        Número de CC: <input type="text" name="Numero_CC" maxlength="19"
          <?php if(in_array('Numero_CC',$vector_errores))
                echo 'class="error"';
              else if(isset($_GET['Numero_CC']))
                echo 'value="'.$_GET["Numero_CC"].'"';
              else if(isset($_POST['Numero_CC']))
                echo 'value="'.$_POST["Numero_CC"].'"'; ?>>
      </fieldset>
      <fieldset>
        <legend>Información sobre la suscripción <?php if(in_array('Revista',$vector_errores) or in_array('Tipo',$vector_errores) or in_array('Pago',$vector_errores)) echo "<span class='mensaje-error'> --Debe seleccionar uno de cada categoría--</span>"; ?></legend>
        Revista seleccionada:<br>
          <input type="radio" name="Revista" value="Sabelotodo" <?php if(isset($_POST['Revista']) and 'Sabelotodo' == $_POST['Revista']) echo "checked"; ?> > Sabelotodo<br>
          <input type="radio" name="Revista" value="Solo se que no se nada" <?php if(isset($_POST['Revista']) and 'Solo se que no se nada'==$_POST['Revista']) echo "checked"; ?> > Sólo sé que no sé nada<br>
          <input type="radio" name="Revista" value="Muy interesado" <?php if(isset($_POST['Revista']) and 'Muy interesado'==$_POST['Revista']) echo "checked"; ?> > Muy interesado<br>
          <input type="radio" name="Revista" value="Ciencia con sabor" <?php if(isset($_POST['Revista']) and 'Ciencia con sabor'==$_POST['Revista']) echo "checked"; ?> > Ciencia con sabor<br>
        Tipo de suscripción:<br>
          <input type="radio" name="Tipo" value="Anual" <?php if(isset($_POST['Tipo']) and 'Anual' == $_POST['Tipo']) echo "checked"; ?>> Anual<br>
          <input type="radio" name="Tipo" value="Bianual" <?php if(isset($_POST['Tipo']) and 'Bianual' == $_POST['Tipo']) echo "checked"; ?>> Bianual<br>
        Modo de pago:<br>
        <input type="radio" name="Pago" value="Paypal" <?php if(isset($_POST['Pago']) and 'Paypal' == $_POST['Pago']) echo "checked"; ?>> Paypal<br>
        <input type="radio" name="Pago" value="VISA" <?php if(isset($_POST['Pago']) and 'VISA' == $_POST['Pago']) echo "checked"; ?>> VISA <br>
        <input type="radio" name="Pago" value="Reembolso" <?php if(isset($_POST['Pago']) and 'Reembolso' == $_POST['Pago']) echo "checked"; ?>> Reembolso <br>
      </fieldset>
      <fieldset>
        <legend>Otra información</legend>
        Otros temas de interés:<br>

        <input type="checkbox" name="temasInteres[]" value="divulgacion" <?php if(isset($_POST['temasInteres']) and in_array('divulgacion', $_POST['temasInteres'])) echo "checked"; ?>> Divulgación<br>
        <input type="checkbox" name="temasInteres[]" value="gastronomia" <?php if(isset($_POST['temasInteres']) and in_array('gastronomia', $_POST['temasInteres'])) echo "checked"; ?>> Gastronomía<br>
        <input type="checkbox" name="temasInteres[]" value="motor" <?php if(isset($_POST['temasInteres']) and in_array('motor', $_POST['temasInteres'])) echo "checked"; ?>> Motor<br>
        <input type="checkbox" name="temasInteres[]" value="viajes" <?php if(isset($_POST['temasInteres']) and in_array('viajes', $_POST['temasInteres'])) echo "checked"; ?>> Viajes<br>
        <hr>
        <input type="checkbox" name="aceptoPublicidad" checked="true"> Acepto el envío de publicidad por email<br>
      </fieldset>

      <input type="submit"value="Enviar">

    </form>

<?php } ?>
</body>
</html>
