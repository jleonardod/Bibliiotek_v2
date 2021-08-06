<?php
include_once '../apis/apiCliente.php';

$fechaActual = Date("Y-m-d");

$api = new ApiCliente();

$api->getAfiliadosAnio($fechaActual);
?>