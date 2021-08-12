<?php

include_once '../modelos/usuario.php';

class ApiUsuario{

  function getConteoUsuarios(){
    $usuario = new Usuario();
    $usuarios = array();
    $usuarios["item"] = array();

    $res = $usuario->obtenerConteoUsuarios();

    if($res -> rowCount()){
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $item = array(
          'conteoUsuarios' => $row["conteoUsuarios"]
        );
        array_push($usuarios["item"], $item);
      }
      echo json_encode($usuarios);
    }else{
      echo json_encode(array('mensaje' => 'No hay elementos registrados'));
    }
  }

  function getUsuario($idUsuario){
    $usuario = new Usuario();
    $usuarios = array();
    $usuarios["item"] = array();

    $res = $usuario->obtenerUsuario($idUsuario);

    if($res -> rowCount()){
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $item = array(
          'idUsuario' => $row["idUsuario"],
          'nombre' => $row["nombre"],
          'apellido' => $row["apellido"],
          'email' => $row["email"],
          'telefono' => $row["telefono"],
          'edad' => $row["edad"],
          'fechaAfiliacion' => $row["fechaAfiliacion"]
        );
        array_push($usuarios["item"], $item);
      }
      echo json_encode($usuarios);
    }else{
      echo json_encode(array('mensaje' => 'No hay elementos registrados'));
    }
  }
}
?>