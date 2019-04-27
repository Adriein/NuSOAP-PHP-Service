<?php
require_once("../Controler/controler.php");

if(isset($_POST['submit']) == 'mostrar'){
  $controler = new Controler();
  $result = $controler->showProductsByCategory($_POST['categorySelected']);

  echo"<table>
    <tr>
      <th>Producto</th>
      <th>Categoria</th>
    </tr>";
    foreach ($result as $product) {
      echo"<tr>
        <td>".$product->getName()."</td>
        <td>".$product->getCategory()."<td>
      </tr>";
    }



  echo"</table>";
}
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="index.php" method="post">
      <select name="categorySelected">
        <option value=''></option>
        <?php
          $controler = new Controler();
          $resultado = $controler->fillCategoriesSelect();
            foreach ($resultado as $category){
              echo "<option value=".$category->getId().">".$category->getName()."</option>";
            }
        ?>
      </select>
      <input type="submit" name="submit" value="mostrar">

      <?php



       ?>
    </form>
  </body>
</html>
