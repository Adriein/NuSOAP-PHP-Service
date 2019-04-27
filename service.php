<?php
require "DAO/productosDAO";
require "lib/nusoap.php";

$server = new nusoap_server();
$server->configureWSDL("consulta","urn:consulta");

?>
