<?php
session_start();
if((!isset($_SESSION["idLogin"])) || (!isset($_SESSION["idUsuario"])) || (!isset($_SESSION["idPerfil"])) || (!isset($_SESSION["estado"])) || (!isset($_SESSION["permisos"]))){
  echo "0";
}else{
  echo "1";
}
?>