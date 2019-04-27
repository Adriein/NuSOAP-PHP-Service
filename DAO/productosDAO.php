<?php
require_once("../DBConnection.php");
require_once("../Model/categoria.php");
require_once("../Model/producto.php");
class ProductosDAO{

  public function getAllCategories(){
    $connection = new DBConnection();
    $query = "select * from categoria";
    $connection->executeQuery($query);

    foreach ($connection->getRows() as $categories) {
      $category = new Categoria($categories['identificador'], $categories['nombre']);
      $allCategories[] = $category;

    }

    $connection->disconect();
    return $allCategories;

  }

  public function getProductos($idCateogry){
    $connection = new DBConnection();
    $query = "select * from producto where categoria =".$idCateogry;
    $connection->executeQuery($query);

    foreach ($connection->getRows() as $producto) {
      $product = new Producto($producto['identificador'], $producto['nombre'], $producto['categoria']);
      $allProducts[] = $product;

    }

    $connection->disconect();
    return $allProducts;

  }
}
?>
