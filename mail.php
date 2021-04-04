<?php
// Varios destinatarios
// $para  = 'jorge@gpoinnovate.com' . ', '; // atención a la coma
//




$para = $_POST['EMAIL'];

// título
$título = 'Mensaje Contacto - Negocios y Alianzas';

// mensaje
$mensaje = '
<html>
<head>
  <title>Mensaje de contacto para '.$_POST['NAME'].'</title>
</head>
<body>

  <table>
    <tr>
      <th>Nombre: </th>
      <td>'.$_POST['NAME'].'</td>
    </tr>
    <tr>
      <th>Email: </th>
      <td>'.$_POST['EMAIL'].'</td>
    </tr>
    <tr>
      <th>Telefono: </th>
      <td>'.$_POST['PHONE'].'</td>
    </tr>
    <tr>
      <th>Asunto: </th>
      <td>'.$_POST['OPTION'].'</td>
    </tr>
    <tr>
      <th>Mensaje: </th>
      <td>'.$_POST['MENSAJE'].'</td>
    </tr>
  </table>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: '.$_POST['NAME'].' <'.$_POST['EMAIL'].'>' . "\r\n";
$cabeceras .= 'From: Información <atencionalcliente@negociosyalianzas.com>' . "\r\n";
$cabeceras .= 'Cc: atencionalcliente@negociosyalianzas.com' . "\r\n";
$cabeceras .= 'Bcc: info@innovate.gt' . "\r\n";

// Enviarlo
// $bool= mail($para, $título, $mensaje, $cabeceras);
// // for ($i=0; $i <10000000 ; $i++);
// echo ($bool)?1:0;

// Enviarlo
$str=$_POST['g-recaptcha-response'];
      $google_url="https://www.google.com/recaptcha/api/siteverify";
      $secret='6LeebVQUAAAAAPS2nCUI2qsg-Q9Gbe-MaEwgtDg6';
      $ip=$_SERVER['REMOTE_ADDR'];
      $url=$google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_TIMEOUT, 10);
      $res = curl_exec($curl);
      curl_close($curl);
      $res= json_decode($res, true);
      if($res['success'])
      {
      $bool= mail($para, $título, $mensaje, $cabeceras);
      $bool=1;
      }
  else
  {
  $bool=0;
// for ($i=0; $i <10000000 ; $i++);
}
echo $bool;









?>
