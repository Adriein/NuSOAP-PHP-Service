<?php
 function getAllCategories(){
 	require_once("datos.php");
 	$misCategorias = array();
 	$con = mysqli_connect($host, $user, $pass, $db_name,3307);
 	$query = "select * from categoria";
 	$categorias = mysqli_query($con, $query);
 	while($categoria = mysqli_fetch_assoc($categorias)){
 		$misCategorias[] = $categoria;
 	}
 	mysqli_close($con);
 	return $misCategorias;
 }

 function getProductos($idCateogry){
	 require_once("datos.php");
  	$misProductos = array();
  	$con = mysqli_connect($host, $user, $pass, $db_name,3307);
  	$query = "select * from producto where categoria =".$idCateogry;
  	$productos = mysqli_query($con, $query);
  	while($producto = mysqli_fetch_assoc($productos)){
  		$misProductos[] = $producto;
  	}
  	mysqli_close($con);
  	return $misProductos;
 }

 require_once("lib/nusoap.php");
 $namespace = "http://localhost/nusoap/servidor.php";
 $server = new soap_server();
 $server->configureWSDL("SERVIDOR NuSOAP");
 $server->soap_defenconding = "UTF-8";
 $server->wsdl->schemaTargetNamespace = $namespace;

 $server->wsdl->addComplexType(
 	'Categoria',
 	'complexType',
 	'struct',
 	'all',
 	'',
 	array(
 		'identificador' => array('name'=>'identificador', 'type'=>'xsd:int'),
 		'nombre' => array('name'=>'nombre', 'type'=>'xsd:string'),
 		)
 	);

 $server->wsdl->addComplexType(
 	'MisCategorias',
 	'complexType',
 	'array',
 	'',
 	'SOAP-ENC:Array',
 	array(),
 	array(
 		array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:Categoria[]')),
 	'tns:Categoria'
 	);


 $server->register(
 	'getAllCategories',
 	array(),
 	array('return' => 'tns:MisCategorias'),
 	$namespace,
 	false,
 	'rpc',
 	'encoded',
 	'Método que devuelve todas las categorias');

	$server->wsdl->addComplexType(
	 'Producto',
	 'complexType',
	 'struct',
	 'all',
	 '',
	 array(
		 'identificador' => array('name'=>'identificador', 'type'=>'xsd:int'),
		 'nombre' => array('name'=>'nombre', 'type'=>'xsd:string'),
		 'categoria' => array('name'=>'categoria', 'type'=>'xsd:int'),
		 )
	 );

	$server->wsdl->addComplexType(
	 'MisProductos',
	 'complexType',
	 'array',
	 '',
	 'SOAP-ENC:Array',
	 array(),
	 array(
		 array('ref'=>'SOAP-ENC:arrayType', 'wsdl:arrayType'=>'tns:Producto[]')),
	 'tns:Producto'
	 );


	$server->register(
	 'getProductos',
	 array('identificador' => 'xsd:int'),
	 array('return' => 'tns:MisProductos'),
	 $namespace,
	 false,
	 'rpc',
	 'encoded',
	 'Método que devuelve los productos asociados a una categoria');

 $server->service(file_get_contents("php://input"));
?>
