<?php

include_once '../../libraries/db.php';

class Libro extends DB{

  function obtenerConteoLibros(){

    $query = $this->connect()->query("SELECT COUNT('idLibro') AS conteoLibros FROM libros WHERE estado <> 6");

    return $query;
  }

  function obtenerAsignacionLibros($clasificacionCliente){

    $query = $this->connect()->query("SELECT COUNT(l.idLibro) AS cantidadAsignados FROM libros l INNER JOIN clientes c ON l.idCliente = c.idCliente WHERE c.tipoCliente = $clasificacionCliente");

    return $query;
  }
}
?>