<?php
include_once '../apis/apiLogin.php';

$nombreUsuario = $_POST["nombreUsuario"];
$passwordUsuario = $_POST["passwordUsuario"];

$api = new ApiLogin();

$api->getLogin($nombreUsuario, $passwordUsuario);
?>