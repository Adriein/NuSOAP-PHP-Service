<?php
	require_once("lib/nusoap.php");
	$client = new soapclient("http://localhost/nusoap/servidor.php?wsdl");
	if(isset($_POST['submit']) == 'mostrar'){

		$result = $client->getProductos($_POST['categoria']);
		echo"<table border='1'>
			<tr><th>Categoria</th><th>Producto</th></tr>";
			foreach ($result as $producto){
				echo "<tr><td>".$producto->categoria."</td><td>".$producto->nombre."</td></tr>";
			}

		echo"</table>";

	}
	echo"<form action='cliente.php' method='post'>
		<select name='categoria'>";
			$result = $client->getAllCategories();
			foreach ($result as $categoria){
				echo "<option value=".$categoria->identificador.">".$categoria->nombre."</option>";
			}
	echo "</select>
		<input type='submit' name='submit' value='mostrar'>
	";

?>
