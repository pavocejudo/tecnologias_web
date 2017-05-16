 <?php $_GLOBAL['activo']='contacto';
 include 'cabecera.html' ;
include 'nav.php';?>
<h1>Contacto</h1>
<hr>
<div class="col-izq">
  <?php
  require_once('phpmailer/class.phpmailer.php');
  require_once('phpmailer/class.smtp.php');
    if(isset($_POST)){
      $to = 'sergio93@correo.ugr.es';
      $subject = 'Mensaje de contacto de la pagina web personal';
      $cabeceras = 'From: webmaster@example.com';
      $message = '';
      if(isset($_POST['nombre'],$_POST['email'],$_POST['mensaje'])){
        $message = $_POST['nombre'].'<br>'.$_POST['email'].'<br>'.$_POST['mensaje'];
        /*Configuracion basica para enviar correos*/
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'sergiobasket93@gmail.com';
        $mail->Password = 's1E1r1G1i1O1993';
        $mail->SetFrom($_POST['email'],$_POST['nombre']);
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->addAddress('sergio93@correo.ugr.es','Sergio');

        if($mail->send())
          echo '<div class="mensaje">Mensaje enviado correctamente<br><a href="contacto.php">Volver</a></div>';
        else
          echo '<div class="mensaje">No se pudo enviar, algo fue mal D:<br><a href="contacto.php">Volver</a></div>';
      }
    }
  ?>
  <form class="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <span class="apartadoFormulario">Nombre</span> <br> <input type="text" name="nombre" value=""><br>
      <span class="apartadoFormulario">Email</span> <br> <input type="email" name="email" value=""><br>
      <span class="apartadoFormulario">Mesaje</span> <br> <textarea name="mensaje"></textarea> <br>
      <hr>
      <input type="submit" name="enviar" value="Enviar">

  </form>
</div>
<div class="col-der redes-sociales">
  <ul>
    <li><a href="https://www.facebook.com/srmprof"><img src="https://www.facebook.com/rsrc.php/yl/r/H3nktOa7ZMg.ico"><span> srmprof</span></a></li>
    <li><a href="https://twitter.com/pavocejudo"><img src="https://abs.twimg.com/icons/apple-touch-icon-192x192.png"><span> pavocejudo</span></a></li>
    <li><a href="https://github.com/pavocejudo"><img src="https://github.com/fluidicon.png"><span> pavocejudo</span></a></li>
  </ul>
</div>
<?php include 'pie.html';?>
