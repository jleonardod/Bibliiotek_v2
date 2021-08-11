<?php
include_once '../apis/apiLogin.php';

date_default_timezone_set('America/Bogota');

$idUsuario = $_POST["idUsuario"];
$fechaHora = date("Y-m-d H:i:s");

$api = new ApiLogin();

$api->postUsuario($idUsuario, $fechaHora);
?>