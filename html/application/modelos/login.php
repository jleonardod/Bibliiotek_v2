<?php

include_once '../../libraries/db.php';

class Login extends DB{

  function obtenerLogin($nombreUsuario, $passwordUsuario){

    $query = $this->connect()->query("SELECT * FROM logins WHERE nombreUsuario = '$nombreUsuario' AND passwordUsuario = '$passwordUsuario'");

    return $query;
  }

  function obtenerPermisos($idPerfil){

    $query = $this->connect()->query("SELECT * FROM permisos_has_perfil WHERE idPerfil = $idPerfil");

    return $query;
  }
}
?>