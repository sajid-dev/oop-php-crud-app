<?php

/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/19/2017
 * Time: 10:00 PM
 */
class Database {

  private $host = 'localhost';
  private $username = 'root';
  private $password = '';
  private $database = 'php-crud-oop';
  public $conn = NULL;

  public function getConnection() {
    $this->conn = NULL;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
    } catch (PDOException $exception) {
      echo $exception->getMessage();
    }
   return $this->conn;
  }
}

?>