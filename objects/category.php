<?php

/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/19/2017
 * Time: 10:26 PM
 */
class Category {


  private $conn;
  private $table_name = 'categories';

  public $id;
  public $name;

  public function __construct($db) {
    $this->conn = $db;
  }

  function read() {
    $sql = 'SELECT id,name FROM ' . $this->table_name . ' ORDER BY name';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function readName() {
    $sql = "SELECT name FROM " . $this->table_name . ' WHERE id=? LIMIT 0,1';
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name = $res['name'];
  }
}

?>