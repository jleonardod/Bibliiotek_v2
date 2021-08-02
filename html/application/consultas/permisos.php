<?php
include_once '../apis/apiLogin.php';

$idPerfil = $_POST["idPerfil"];

$api = new ApiLogin();

$api->getPermisos($idPerfil);
?>