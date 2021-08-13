<?php
include_once '../apis/apilogin.php';

$idUsuario = $_POST["idUsuario"];

$api = new ApiLogin();

$api->getFechaLogin($idUsuario);
?>