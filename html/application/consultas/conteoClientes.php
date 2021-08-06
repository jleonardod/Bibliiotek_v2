<?php
include_once '../apis/apiCliente.php';

$api = new ApiCliente();

$api->getConteoClientes();
?>