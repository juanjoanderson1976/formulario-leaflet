<?php

// variables declaración


  error_reporting(0); // elimina errores del codigo php
  $nombre = $_POST["nombre"];
  $email = $_POST["email"];
  $asunto = $_POST["asunto"];
  $mensaje = $_POST["mensaje"];
  
  $dominio = $_SERVER["HTTP_HOST"];
  $to = "juanjoanderson@gmail.com";
  $subject = "Contacto desde el formulario de la web $dominio";
  $message = "
  <p>Datos desde la web de: <b>$dominio</b></p>
  <ul>
    <li>Nombre: <b>$nombre</b></li>
    <li>Email: <b>$email</b></li>
    <li>Asunto: $asunto</li>
    <li>Mensaje: $mensaje</li>
  </ul>
  ";

  $headers = "MIME-Version: 1.0\r\n" . "Content-Type: text/html; charset=utf-8\r\n" .
  "From: Envío Automatico No Reponder <no-reply@$dominio>";

 
  $send_mail = mail($to, $subject, $message, $headers);

  // esto se manda a la peticion fetch
  if($send_mail) {
    $res = [
     "err" => false,
     "mensaje" => "👋 $nombre, tus datos han sido enviados, ¡gracias!",
     "alerta" => "alert-success"
    ];
  } else {
   $res = [
    "err" => true,
    "mensaje" => "😕 $nombre, error al enviar tus datos, ¡intenta de nuevo!.",
    "alerta" => "alert-danger"
   ];
  }


  //header('Access-Control-Allow-Origin: http://localhost/formulario/contacto.php');
  header("Access-Control-Allow-Origin: *");
  header('Content-type:application/json');
  echo json_encode($res);
  exit;


