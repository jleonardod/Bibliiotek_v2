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

  function crearLogLogin($idUsuario, $fechaHora){

    $query = $this->connect()->query("INSERT INTO log_logins (idUsuario, fechaHora) VALUES ($idUsuario, '$fechaHora')");
    $query = $this->connect()->query("SELECT * FROM log_logins ORDER BY idLogLogin DESC LIMIT 1");

    return $query;
  }

  function conteoLogins(){

    $query = $this->connect()->query("SELECT idUsuario, COUNT(idUsuario) AS total FROM log_logins GROUP BY idUsuario ORDER BY total DESC LIMIT 3");
    
    return $query;
  }

  function ultimaFechaLogin($idUsuario){

    $query = $this->connect()->query("SELECT fechaHora FROM log_logins WHERE idUsuario = $idUsuario ORDER BY idLogLogin DESC LIMIT 1");

    return $query;
  }
}
?>