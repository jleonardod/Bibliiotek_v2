<?php
session_start();

session_destroy();

if(!isset($_SESSION["idLogin"])){
  echo "0";
}else{
  echo "1";
}

?>