<?php
include_once '../apis/apiUsuario.php';

$api = new ApiUsuario();

$api->getConteoUsuarios();
?>