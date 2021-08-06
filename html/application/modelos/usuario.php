<?php

include_once '../../libraries/db.php';

class Usuario extends DB{

  function obtenerConteoUsuarios(){

    $query = $this->connect()->query("SELECT COUNT('idUsuario') AS conteoUsuarios FROM usuarios");

    return $query;
  }
}
?>