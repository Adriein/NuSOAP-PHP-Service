<?php
require_once("../DAO/productosDAO.php");

class Controler{

  private $productosDAO;

  public function __construct(){
    $this->productosDAO = new ProductosDAO();

  }

  public function fillCategoriesSelect(){
    $resultado = $this->productosDAO->getAllCategories();
    return $resultado;
  }

  public function showProductsByCategory($idCategory){
    $resultado = $this->productosDAO->getProductos($idCategory);
    return $resultado;
  }
}
 ?>
