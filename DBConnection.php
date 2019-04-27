<?php
class DBConnection{

  private static $host = '127.0.0.1:3307';
  //private static $host = '127.0.0.1';
  private static $user = 'root';
  private static $pass = '';
  private static $dbName = 'tienda';
  private static $port = '3307';

  private $connection;
  private $resultado;
  private $numRows;

  public function __construct(){
    //Conexion para cuando tienes 2 servicios mysql uno en el xampp y el otro en local
    $this->connection = new mysqli(self::$host.' : '.self::$port, self::$user, self::$pass, self::$dbName);
    //Conexion cuando tienes un solo servicio mysql
    //$this->connection = new mysqli(self::$host, self::$user, self::$pass, self::$dbName);
  }

  public function disconect(){
    $this->connection->close();

  }

  public function executeQuery($sqlSentence){
    $this->resultado = $this->connection->query($sqlSentence);
    $this->numRows = $this->resultado->num_rows;
  }

  public function getNumRows(){
    return $this->numRows;
  }

  public function getRows(){
    $row = array();

    for ($i=0; $i < $this->numRows; $i++) {
      $row[] = $this->resultado->fetch_assoc();

    }

    return $row;
  }
}
?>
