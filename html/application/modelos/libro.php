<?php

include_once '../../libraries/db.php';

class Libro extends DB{

  function obtenerConteoLibros(){

    $query = $this->connect()->query("SELECT COUNT('idLibro') AS conteoLibros FROM libros WHERE estado <> 6");

    return $query;
  }
}
?>