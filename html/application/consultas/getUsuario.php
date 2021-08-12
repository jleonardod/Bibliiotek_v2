<?php
include_once '../apis/apiUsuario.php';

$idUsuario = $_POST["idUsuario"];

$api = new ApiUsuario();

$api->getUsuario($idUsuario);
?>