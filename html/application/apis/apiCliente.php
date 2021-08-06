<?php

include_once '../modelos/cliente.php';

class ApiCliente{

  function getConteoClientes(){
    $cliente = new Cliente();
    $clientes = array();
    $clientes["item"] = array();

    $res = $cliente->obtenerConteoClientes();

    if($res -> rowCount()){
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $item = array(
          'conteoClientes' => $row["conteoClientes"]
        );
        array_push($clientes["item"], $item);
      }
      echo json_encode($clientes);
    }else{
      echo json_encode(array('mensaje' => 'No hay elementos registrados'));
    }
  }

  function getMeses($fechaActual){
    $meses = array();
    $meses["item"] = array();

    for($i = 0; $i<12; $i++){
      $mesActual = strtotime($fechaActual);
      $mesActual = date("m", $mesActual);

      $dateObj = DateTime::createFromFormat('!m', $mesActual);
      $nombreMes = $dateObj->format('F');

      $item = array(
        'mes' => $nombreMes
      );
      array_push($meses["item"], $item);
      $fechaActual = date("Y-m-d", strtotime($fechaActual."-1 month"));
    }
    echo json_encode($meses);
  }

  function getAfiliadosAnio($fechaActual){
    $meses = array();
    $meses["item"] = array();

    for($i = 0; $i<12; $i++){
      $mesActual = strtotime($fechaActual);
      $mesActual = date("m", $mesActual);

      $cliente = new Cliente();
      $clientes = array();
      $clientes["item"] = array();

      $anioActual = strtotime($fechaActual);
      $anioActual = date("Y", $anioActual);

      $mesActual_1 = strtotime($fechaActual);
      $mesActual_1 = date("m", $mesActual_1);

      $inicioMes = $anioActual."-".$mesActual_1."-01";

      $cierreMes = date("Y-m-t", strtotime($fechaActual));

      $res = $cliente->obtenerAfiliadosMes($inicioMes, $cierreMes);

      if($res -> rowCount()){
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
          $cantidadAfiliados = $row["cantidadAfiliados"];
        }
      }

      $dateObj = DateTime::createFromFormat('!m', $mesActual);
      $nombreMes = $dateObj->format('F');

      $item = array(
        'mes' => $nombreMes,
        'afiliados' => $cantidadAfiliados
      );
      array_push($meses["item"], $item);
      $fechaActual = date("Y-m-d", strtotime($fechaActual."-1 month"));
    }
    echo json_encode($meses);
  }

  function getNumeroAfiliados($fechaActual){
    $cliente = new Cliente();
    $clientes = array();
    $clientes["item"] = array();

    $anioActual = strtotime($fechaActual);
    $anioActual = date("Y", $anioActual);

    $mesActual = strtotime($fechaActual);
    $mesActual = date("m", $mesActual);

    $inicioMes = $anioActual."-".$mesActual."-01";

    $cierreMes = date("Y-m-t", strtotime($fechaActual));

    $res = $cliente->obtenerAfiliadosMes($inicioMes, $cierreMes);

    if($res -> rowCount()){
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $cantidadAfiliados = $row["cantidadAfiliados"];
      }
    }

    return $cantidadAfiliados;
  }
}
?>