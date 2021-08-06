<?php

include_once '../../libraries/db.php';

class Cliente extends DB{

  function obtenerConteoClientes(){

    $query = $this->connect()->query("SELECT COUNT('idCliente') AS conteoClientes FROM clientes WHERE estado = 1");

    return $query;
  }

  function obtenerAfiliadosMes($inicioMes, $cierreMes){

    $query = $this->connect()->query("SELECT COUNT('idCliente') AS cantidadAfiliados FROM clientes WHERE fechaCreacion >= '$inicioMes' AND fechaCreacion <= '$cierreMes'");

    return $query;
  }
}
?>