<?php
include_once '../apis/apiLogin.php';

$api = new ApiLogin();

$api->getConteoLogins();
?>