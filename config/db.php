<?php
// connect database with PDO
class db{

  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "restful_php_api";
  private $conn;

  function connect(){
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->database.";charset=utf8", $this->username, $this->password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // echo "Successful";
    } catch(PDOException $e) {
      echo "Failed" . $e->getMessage();
    }
    return $this->conn;
  } 
}

?>