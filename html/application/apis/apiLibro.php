<?php

include_once '../modelos/libro.php';

class ApiLibro{

  function getConteoLibros(){
    $libro = new Libro();
    $libros = array();
    $libros["item"] = array();

    $res = $libro->obtenerConteoLibros();

    if($res -> rowCount()){
      while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $item = array(
          'conteoLibros' => $row["conteoLibros"]
        );
        array_push($libros["item"], $item);
      }
      echo json_encode($libros);
    }else{
      echo json_encode(array('mensaje' => 'No hay elementos registrados'));
    }
  }
}
?>