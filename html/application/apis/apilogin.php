<?php 

include_once '../modelos/login.php';

class ApiLogin{
  
  function getLogin($nombreUsuario, $passwordUsuario){
    $login = new Login();
    $logins = array();
    $logins["item"] = array();

    $res = $login->obtenerLogin($nombreUsuario, $passwordUsuario);

    if($res -> rowCount()){
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $item = array(
          'idLogin' => $row["idLogin"],
          'idUsuario' => $row["idUsuario"],
          'idPerfil' => $row["idPerfil"],
          'estado' => $row["estado"]
        );
        array_push($logins['item'], $item);
      }
      echo json_encode($logins);
    }else{
      echo json_encode(array('mensaje' => 'No hay elementos registrados'));
    }
  }

  function getPermisos($idPerfil){
    $login = new Login();
    $permisos = array();
    $permisos["item"] = array();

    $res = $login->obtenerPermisos($idPerfil);

    if($res -> rowCount()){
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $item = array(
          'idPermiso' => $row["idPermiso"]
        );
        array_push($permisos['item'], $item);
      }
      echo json_encode($permisos);
    }else{
      echo json_encode(array('mensaje' => 'No hay elementos registrados'));
    }
  }
}
?>