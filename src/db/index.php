<?php
//////////////////////////////////////
// Configuracion de la base de datos //
//////////////////////////////////////

// aun falta por completar esta parte

function obtener_campo_users($columna, $id_user){

  require 'conexion.php';
  $sql="SELECT $columna FROM users WHERE id_user=$id_user";
  $query=mysqli_query($conexion, $sql);
  $a=mysqli_fetch_row($query);
  $dato_usuario=$a[0];

  return $dato_usuario;
}

function obtener_campo_canales_rss($columna, $id_rss){

  require 'conexion.php';
  $sql="SELECT $columna FROM canales_rss WHERE id_rss=$id_rss";
  $query=mysqli_query($conexion, $sql);
  $a=mysqli_fetch_row($query);
  $dato_rss=$a[0];

  return $dato_rss;
}

function obtener_campo_suscripciones($columna, $id_user){

  require 'conexion.php';
  $sql="SELECT $columna FROM users_has_canales_rss WHERE users_id_user=$id_user";
  $query=mysqli_query($conexion, $sql);
  $a=mysqli_fetch_row($query);
  $dato_suscripcion=$a[0];

  return $dato_suscripcion;
}
?>
