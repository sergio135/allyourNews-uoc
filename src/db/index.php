<?php

function obtener_campo_users($columna, $where, $valor){

  require 'conexion.php';
  $sql="SELECT $columna FROM users WHERE $where='$valor'";
  $query=mysqli_query($conexion, $sql);
  $a=mysqli_fetch_row($query);
  $dato_usuario=$a[0];

  return $dato_usuario;
}

function obtener_campo_rss($columna, $where, $id_rss){

  require 'conexion.php';
  $sql="SELECT $columna FROM rss WHERE $where='$id_rss'";
  $query=mysqli_query($conexion, $sql);
  $a=mysqli_fetch_row($query);
  $dato_rss=$a[0];

  return $dato_rss;
}

function obtener_campo_suscripciones($columna, $id_user){

  require 'conexion.php';
  $sql="SELECT $columna FROM suscripciones WHERE id_user=$id_user";
  $query=mysqli_query($conexion, $sql);
  $a=mysqli_fetch_row($query);
  $dato_suscripcion=$a[0];

  return $dato_suscripcion;
}

function registrar_usuario($username, $pass){
  require 'conexion.php';
  $sql="INSERT INTO users(username, pass) VALUES ('$username', '$pass')";
  mysqli_query($conexion, $sql);
}

function añadir_rss($url_rss){
  require 'conexion.php';
  $sql="INSERT INTO rss(url_rss) VALUES ('$url_rss')";
  mysqli_query($conexion, $sql);
}

function añadir_suscripcion($id_user, $id_rss){
  require 'conexion.php';
  $sql="INSERT INTO suscripciones(id_user, id_rss) VALUES ('$id_user', '$id_rss')";
  mysqli_query($conexion, $sql);
}

function borrar_usuario($id_user){
  require 'conexion.php';
  $sql="DELETE FROM users WHERE id_user=$id_user";
  mysqli_query($conexion, $sql);
  $sql="DELETE FROM suscripciones WHERE id_user=$id_user";
  mysqli_query($conexion, $sql);
}

function borrar_rss($id_rss){
  require 'conexion.php';
  $sql="DELETE FROM rss WHERE id_rss=$id_rss";
  mysqli_query($conexion, $sql);
}

function borrar_suscripcion($id_user, $id_rss){
  require 'conexion.php';
  $sql="DELETE FROM suscripciones WHERE id_user=$id_user AND id_rss=$id_rss";
  mysqli_query($conexion, $sql);
}
