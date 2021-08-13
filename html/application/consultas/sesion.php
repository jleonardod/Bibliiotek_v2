<?php
session_start();

$idLogin = $_POST['idLogin'];
$idUsuario = $_POST['idUsuario'];
$idPerfil = $_POST['idPerfil'];
$estado = $_POST['estado'];
$permisos = $_POST['permisos'];

$_SESSION['idLogin'] = $idLogin;
$_SESSION['idUsuario'] = $idUsuario;
$_SESSION['idPerfil'] = $idPerfil;
$_SESSION['estado'] = $estado;
$_SESSION['permisos'] = $permisos;

echo "1";
?>